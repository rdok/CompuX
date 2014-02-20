<?php 
require_once("../inc/config.php");
require_once(ROOT_PATH . 'inc/products.php');

	// retrieve current page number from query string; set to 1 if blank
	if (!isset($_GET["pg"])) { 
		$current_page = 1;
	} else {
		$current_page = $_GET["pg"];
	}
	// convert any other variable than int type to int (e.g.: string -> 0), Rremoves decimal
	$current_page = intval($current_page);

	// determine right page number
	$total_products = get_products_count();
	$products_per_page = 4;
	$total_pages = ceil($total_products / $products_per_page);

	// is user input a page number larger than available then redirect to last page of products
	if($current_page > $total_pages) {
		header("Location: ./?pg=" . $total_pages);
	} // end if

	// if page number less than 1( or strings converted to 0)then redirect to first page
	if($current_page < 1) {
		header("Location: ./");
	}

	// determine the start and end product for the current page;
	$start = (($current_page - 1) * $products_per_page) + 1; // first product page
	$end = $products_per_page * $current_page;

	if ($end > $total_products) { // make sure the last page is full.
		$end = $total_products;
	} // end if
	$products = get_products_subset($start, $end);

	?><?php
	$pageTitle = "All Computers";
	$section = "products";
	// PAUSED HERE
	include(ROOT_PATH . 'inc/header.php'); 
	?>

	<div class="section products page">

		<div class="wrapper">

			<h1>Full Catalog of Computers</h1>

			<?php include(ROOT_PATH . "inc/partials/list-navigation.html.php"); ?>

			<ul class="products">
				<?php 
					foreach($products as $product) {
						include(ROOT_PATH . "inc/partials/product-list-view.html.php"); 
					} // end foreach
				?>
			</ul>

		</div>

	</div>

	<?php include(ROOT_PATH . 'inc/footer.php') ?>