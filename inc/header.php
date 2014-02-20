<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css" type="text/css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700" type="text/css">
	<link rel="shortcut icon" href="<?php echo BASE_URL; ?>favicon.ico">
</head>
<body>

	<div class="header">

		<div class="wrapper">

			<h1 class="branding-title"><a href="<?php echo BASE_URL; ?>">Computers</a></h1>

			<ul class="nav">
				<li class="computers <?php if (isset($section) && $section == "products") { echo "on"; } ?>"><a href="<?php echo BASE_URL; ?>products/">Computers</a></li>
				<li class="contact <?php if (isset($section) && $section == "contact") { echo "on"; } ?>"><a href="<?php echo BASE_URL; ?>contact/">Contact</a></li>
				<li class="contact <?php if (isset($section) && $section == "search") { echo "on"; } ?>"><a href="<?php echo BASE_URL; ?>search/">Search</a></li>

				<li class="cart"><a target="paypal" href="https://www.paypal.com/cgi-bin/webscr?cmd=_cart&amp;business=G5A385GSPJY5C&amp;display=1">>Shopping Cart</a></li>
			</ul>
		</div>
	</div>

	<div id="content">