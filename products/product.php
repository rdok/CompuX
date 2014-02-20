<?php 
require_once("../inc/config.php");
require_once(ROOT_PATH . 'inc/products.php');

	// if an ID is specified in the query string, use it
if (isset($_GET["id"])) {
	$product_id = intval($_GET["id"]); // sanityze: removes any non integer vars
	$product = get_product_single($product_id);
}

// a $product will only be set if an ID is specified  and not false in the queryy
// string and it corresponds to a real proeduct. If not prodcut is
// set, then redirect to the Computer listing page; otherwise, continue
// ond and siplay the Computer Details
if (empty($product)) { // boolean false.
	header("Location: " . BASE_URL . "products/");
	exit();
}


$section = "products";
$pageTitle = $product["name"];
include(ROOT_PATH . 'inc/header.php'); 

?>

<div class="section page">

	<div class="wrapper">

		<div class="breadcrumb"><a href="<?php echo BASE_URL; ?>products/">Computers</a> &gt; <?php echo $product["name"]; ?></div>

		<div class="product-picture">
			<span>
				<img src="<?php echo BASE_URL . $product["img"]; ?>" alt="<?php echo $product["name"]; ?>">
			</span>
		</div>

		<div class="product-details">

			<h1><span class="price">$<?php echo $product["price"]; ?></span> <?php echo $product["name"]; ?></h1>

			<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="<?php echo $product["paypal"]; ?>">
				<input type="hidden" name="item_name" value="<?php echo $product["name"]; ?>">
				<table>
					<tr>
						<th>
							<input type="hidden" name="on0" value="Size">
							<label for="os0">Case Color</label>
						</th>
						<td>
							<select name="os0" id="os0">
								<?php 
								foreach($product["color_case"] as $color) { ?>
								<option value="<?php echo $color; ?>"><?php echo $color; ?> </option>
								<?php } ?>
							</select>
						</td>
					</tr>
				</table>
				<input type="submit" value="Add to Cart" name="submit">
			</form>

			<p class="note-designer">* All products are for demonstrative purposes.</p>

		</div>

	</div>

</div>

<?php include(ROOT_PATH . "inc/footer.php"); ?>