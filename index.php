<?php

require_once("inc/config.php");
include(ROOT_PATH . "inc/products.php");
$recent = get_products_recent();

$pageTitle = "CompuX";
$section = "home";
include(ROOT_PATH . 'inc/header.php'); ?>
    <div class="section banner">
        <div class="wrapper">
            <img class="hero" src="<?php echo BASE_URL; ?>img/Backup-IBM-Server-icon.png" alt="CompuX latest info:">
            <div class="button">
                <a href="<?php echo BASE_URL; ?>products.php">
                    <h2>Best computers Ever!</h2>
                    <p>Check Them Out</p>
                </a>
            </div>
        </div>
    </div>

    <div class="section products latest">
        <div class="wrapper">
            <h2>Latest computers</h2>
            <ul class="products">
                <?php
                foreach (array_reverse($recent) as $product) {
                    include(ROOT_PATH . "inc/partials/product-list-view.html.php");
                } // end foreach
                ?>
            </ul>
        </div>
    </div>
<?php include(ROOT_PATH . 'inc/footer.php') ?>
