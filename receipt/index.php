<?php	
	require_once("../inc/config.php");
	
	$pageTitle = "Thank you for your order!";
	$section = "none";
	include(ROOT_PATH . 'inc/products.php');
	include(ROOT_PATH . 'inc/header.php'); 
 
 
?>	
	<div class="section page">
		<div class="wrapper">
			<h1>Thank you for your!</h1>
			<p>
				Thank you for your payment. Your transaction has been completed, and a receipt for your purchase has been emailed to you. You may log into your account at <a href="www.paypal.com/">www.paypal.com/</a> to view details of this transaction.
			</p>
            <p>Need another computer alread? Visit the <a href="<?php echo BASE_URL; ?> products.php">Products Listing</a></p>
		</div>
	</div>
    
<?php
	include(ROOT_PATH . "inc/footer.php");
?>	