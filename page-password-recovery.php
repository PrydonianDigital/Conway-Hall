<?php
/*
Template Name: Password Reset
*/
get_header(); ?>

<div class="row">
 <?php
        global $wpdb;

        $error = '';
        $success = '';

        // check if we're in reset form
        if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] )
        {
            $email = $wpdb->escape(trim($_POST['email']));

            if( empty( $email ) ) {
                $error = 'Enter a username or e-mail address..';
            } else if( ! is_email( $email )) {
                $error = 'Invalid username or e-mail address.';
            } else if( ! email_exists( $email ) ) {
                $error = 'There is no user registered with that email address.';
            } else {

                $random_password = wp_generate_password( 12, false );
                $user = get_user_by( 'email', $email );

                $update_user = wp_update_user( array (
                        'ID' => $user->ID,
                        'user_pass' => $random_password
                    )
                );

                // if  update user return true then lets send user an email containing the new password
                if( $update_user ) {
                    $to = $email;
                    $subject = 'Your new password';
                    $sender = get_option('name');

                    $message = 'Your new password is: '.$random_password;

                    $headers[] = 'MIME-Version: 1.0' . "\r\n";
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers[] = "X-Mailer: PHP \r\n";
                    $headers[] = 'From: '.$sender.' <'.$email.'>' . "\r\n";

                    $mail = wp_mail( $to, $subject, $message, $headers );
                    if( $mail )
                    $success = 'Check your email address for your new password.';

?>
<script>
//change the url to the page in your site you want to see after password reset is done:
document.location="http://conwayhall.org.uk";
</script>
<?php

                } else {
                    $error = 'Oops something went wrong updating your account.';
                }

            }

        }
    ?>


	<div <?php post_class('nine columns'); ?> role="main">

		<form method="post">
	        <fieldset>
	            <p>Please enter your email address. You will receive a temporary password via email.</p>
	            <p><label for="user_login">E-mail:</label>
	                <input type="text" name="email" id="user_login"  value="" />
	                <input type="hidden" name="action" value="reset" />
	                <input type="submit" value="Get New Password" class="button" id="submit" />
	            </p>
	        </fieldset>
	    </form>

	</div>

	<div class="three columns side" role="complementary">

		<div class="row">
			<div class="twelve columns">
				<ul>
				<?php
					$current_user = new WP_User(wp_get_current_user()->ID);
					$user_roles = $current_user->roles;
					foreach ($user_roles as $role) {
						if  ($role == 'trustee' || $role == 'member' || $role == 'nonukmember'|| $role == 'nonukinstitution' || $role == 'editor' || $role == 'administrator' ) {
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
					    <li><a href="<?php global $post; $text = get_post_meta( $post->ID, '_cmb_pdf', true ); echo $text; ?>" download><?php the_title(); ?></a></li>
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