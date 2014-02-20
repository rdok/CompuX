<?php 
	require_once("../inc/config.php");

	// controller code
	$search_term = "";
	if(isset($_GET["s"])){
		$search_term = trim($_GET["s"]);
		if($search_term != "") { // if it's not blank
			require_once(ROOT_PATH . "inc/products.php");
			$products_found = get_products_search($search_term);
		} // end inner if
	} // end outer if

	$pageTitle = "Search";
	$section = "search"; // underline
	include(ROOT_PATH . "inc/header.php");// absolue server path
?>

	<div class="section products search page">

		<div class="wrapper">

			<h1>Search</h1>

			<form method="get" action="./">
				<input type="text" name="s" value="<?php if(isset($search_term)) {echo htmlspecialchars($search_term); } ?>">
				<input type="submit" value="Go">
			</form>

			<?php // view code for search results
				if($search_term != "") { // if search requested
					if(!empty($products_found)){ // if it's not empy
						echo '<ul class="products">';
						foreach ($products_found as $product) {
							//echo get_list_view_html($product);
 							include(ROOT_PATH . "inc/partials/product-list-view.html.php");

						}
						echo '</ul>';
					} else { // no result were found
						echo "<p>No products were found matching that search term.";
					} // end else
				} // end outer if
			?>
		</div>

	</div>

<?php include(ROOT_PATH . "inc/footer.php");