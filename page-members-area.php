<?php get_header(); ?>

<div class="row">

	<div <?php post_class('nine columns'); ?> role="main">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h2><?php the_title(); ?></h2>	
		<?php
			global $user_login;
			$current_user = new WP_User(wp_get_current_user()->id);
			$user_roles = $current_user->roles; 
			foreach ($user_roles as $role) {
				if  ($role == 'trustee' || $role == 'member' || $role == 'editor' || $role == 'administrator' ) {
					global $current_user;
					if ( isset($current_user) ) {
						echo '<p><strong>Welcome, ' . $current_user->user_firstname . ', to the Members\' Area of Conway Hall Ethical Society!</p>';
					}
			?>
			<?php the_content(); ?>
			<?php
				} else {
			?>
				<h4>Please enter your details in order to access this part of the site:</h4>
			<?php
					wp_login_form( $args ); 	
				}
			}	
		?>
	
	<?php endwhile; ?>
	
	<?php endif; ?>
	
	</div>	
	
	<div class="three columns side" role="complementary">
		
		<div class="row">
			<div class="twelve columns">
				<ul>
				<?php
					$current_user = new WP_User(wp_get_current_user()->id);
					$user_roles = $current_user->roles; 
					foreach ($user_roles as $role) {
						if  ($role == 'trustee' || $role == 'member' || $role == 'editor' || $role == 'administrator' ) {
					?>
					<?php
					// Find connected pages
					$connected = new WP_Query( array(
						'connected_type' => 'pdf_to_page',
						'connected_items' => get_queried_object(),
						'nopaging' => true,
					) );
					
					// Display connected pages
					if ( $connected->have_posts() ) :
					?>
					<li class="widget">
					<h5 class="widget">Members Area:</h3>
					<ul class="menu related">
					<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
					    <li><a href="<?php global $post; $text = get_post_meta( $post->ID, '_cmb_pdf', true ); echo $text; ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
					</ul>
					</li>
					<?php 
					// Prevent weirdness
					wp_reset_postdata();
					
					endif;
					?>		
					<?php
						}
					}	
				?>			
					<?php dynamic_sidebar( 'homepage' ); ?>
				</ul>
			</div>
		</div>		

	</div>

</div>

<?php get_footer(); ?>