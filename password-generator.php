<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width" />
<title>Secure Password Generator</title>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
<script src="/wp-content/themes/conwayhall/passwordgenerator/js/bookmark_bubble.js"></script>
<script src="/wp-content/themes/conwayhall/passwordgenerator/js/chroma-hash.js"></script>
<script src="/wp-content/themes/conwayhall/passwordgenerator/js/oplop.js"></script>
</head>
<body>
<div class="wrap">
	
	<h2>Secure Password Generator</h2>
	<p>Enter an account name and master password, then click 'Generate Password'. If you enter the same details (account name &amp; master password), the password you get back will be the same.</p>
    <table class="form-table">
	    <tr>
		    <th scope="row">Step 1:<br />Account Nickname:<br /><small>E.g., <em>Amazon, AMZN, or bookstore</em></small></th>
		    <td><input type="text" id="nickname" class="regular-text" placeholder="Nickname goes here" /></td>
	    </tr>
	    <tr>
		    <th scope="row">Step 2:<br />Master Password:<br /><small>Your 'secret' password.</small></th>
		    <td><input type="password" id="masterPassword" class="regular-text" placeholder="Master password goes here" /></td>
	    </tr>
	    <tr>
		    <th scope="row">Step 3:</th>
		    <td><button class="button">Generate Password</button></td>
	    </tr>
	    <tr>
		    <th scope="row">Step 4:<br />Your <em>unique</em> Account Password:</th>
		    <td><input type="text" id="accountPassword" class="regular-text" placeholder="Complete the 2 above steps then click the button to get your password" /></td>
	    </tr>
    </table>
</div>
<script>
$(function() {
	var urlParams = {};
	(function() {
		var e,
			a = /\+/g,
			r = /([^&;=]+)=?([^&;]*)/g,
			d = function (s) { return decodeURIComponent(s.replace(a, ' ')); },
			q = window.location.search.substring(1);
		while (e = r.exec(q))
		urlParams[d(e[1])] = d(e[2]);
	})();
	if (urlParams.synd || urlParams.container) {
		$('input,label').removeClass('normal');
		$('input,label,#info').addClass('gadget');
	}
	if (window.google && google.bookmarkbubble) {
		var bubble = new google.bookmarkbubble.Bubble();
		var parameter = 'bmb=1';
		bubble.hasHashParameter = function() {
			return window.location.hash.indexOf(parameter) != -1;
		};
		bubble.setHashParameter = function() {
			if (!this.hasHashParameter()) {
				window.location.hash += parameter;
			}
		};
		bubble.showIfAllowed();
	}
	$('input').each(function(index) {
		this.setAttribute('autocorrect', 'off');
		this.setAttribute('autocapitalize', 'off');
	});
	$('input:password').chromaHash({bars: 4, minimum: 6});
	$('.button').on('click', function(e) {
		e.preventDefault();
		if ($('#nickname').val() && $('#masterPassword').val())
		$('#accountPassword').val(oplop.accountPassword($('#nickname').val(), $('#masterPassword').val()));
		$('#accountPassword').select();
	});
});
</script>
</body>
</html>
