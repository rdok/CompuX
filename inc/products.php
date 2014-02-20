<?php

/* Contains model code */

/*

        // if there is a real product that corresponds to the ID
        // specified in the query string, use that for $;roduct
        if (isset($products[$product_id])) {
            $product = $products[$product_id];
        }

*/

/*
 * Returns the four most recent products, using the order of the elements in the array
 * @return   array           a list of the last four products in the array;
                             the most recent product is the last one in the array
 */
function get_products_recent() {
   require(ROOT_PATH . "inc/db.php");

   try {
       $results = $db->query("SELECT name, price, img, sku, paypal 
            FROM products
            ORDER BY sku DESC
            LIMIT 4");

   } catch (Exception $e) {
       echo "Data could not be retrieved from the database.";
       exit;
   } // end catch

   $recent = $results->fetchAll(PDO::FETCH_ASSOC);
   $recent = array_reverse($recent);

    return $recent;
}

/*
 * Counts the total number of products
 * @return   int             the total number of products
 */
function get_products_count() {
    require(ROOT_PATH . "inc/db.php");

    try {
        $results = $db->query("
            SELECT COUNT(sku)
            FROM products");
    } catch (Exception $e) {
        echo "Data could not be retreived from the database.: <br>";
        exit;
    } // end catch

    return intval($results->fetchColumn(0)); // we need only one column from a row
} // end function get_products_count

// This function receives a number as an argument.
// It returns the newest flavors, the most recent
// flavor first. (The number of flavors returned
// corresponds to the number in the argument.)
function get_recent_flavors($number) {

    $recent = array();
    $all = get_all_flavors();

    $total_flavors = count($all);
    $position = 0;
    
    foreach($all as $flavor) {
        $position = $position + 1;
        if ($total_flavors - $position < $number) {
            $recent[] = $flavor;
        }
    }
    
    return array_reverse($recent);
    
}

/*
 * Loops through all the products, looking for a search term in the product names
 * @param    string    $s    the search term
 * @return   array           a list of the products that contain the search term in their name
 */
function get_products_search($s) {
    require(ROOT_PATH . "inc/db.php");

    try {
        $results = $db->prepare("
            SELECT name, price, img, sku, paypal
            FROM products
            WHERE name LIKE ?
            ORDER BY sku");
        $results->bindValue(1, "%" . $s . "%");
        $results->execute();
    } catch (Exception $e) {
        echo "Data could not be retrieved from the dattabase.";
        exit;
    }

    $matches = $results->fetchAll(PDO::FETCH_ASSOC);
    return $matches;
} // end function get_products_search

/*
 * Returns a specified subset of products, based on the values received,
 * using the order of the elements in the array .
 * @param    int             the position of the first product in the requested subset 
 * @param    int             the position of the last product in the requested subset 
 * @return   array           the list of products that correspond to the start and end positions
 */
function get_products_subset($startPos, $endPos) {
    require(ROOT_PATH . "inc/db.php");

    $offset = $startPos - 1;
    $rows = $endPos - $startPos + 1;

    try {
        $results = $db->prepare("
            SELECT name, price, img, sku, paypal
            FROM products
            ORDER BY sku
            LIMIT ?, ?"); // first index offset(exclusive), second up to
        $results->bindParam(1,$offset,PDO::PARAM_INT);
        $results->bindParam(2,$rows,PDO::PARAM_INT);
        $results->execute();

    } catch (Exception $e) {
        echo "Data could not be retreived from the database.";
        exit;
    } // end catch

    $subset = $results->fetchAll(PDO::FETCH_ASSOC);
    return $subset;
} // end get_products_subset function

// This function receives a number as an argument.
// It returns the most popular flavors based on
// the number of likes, the most popular flavor
// first. (The number of flavors returned corresponds
// to the number in the argument.)
function get_flavors_by_likes($number) {

    $all = get_all_flavors();

    $total_flavors = count($all);
    $position = 0;

    $popular = $all;
    usort($popular, function($a, $b) {
        return $b['likes'] - $a['likes'];
    });

    return array_slice($popular, 0, $number);

}

/*
 * Returns the full list of products. This function contains the full list of products,
 * and the other model functions first call this function.
 * @return   array           the full list of products
 */
function get_products_all() {
    /*
    $products = array();
    $products[101] = array(
    	"name" => "Acer Predator G3620-UR308",
    	"img" => "img/computers/computer-101.jpg",
    	"price" => 1590,
    	"paypal" => "GPTQE5WT7NCTQ",
        "color_case" => array("Red","Blue","Pink")
    );
    $products[102] = array(
    	"name" => "HP Envy h8-1455",
        "img" => "img/computers/computer-102.jpg",
        "price" => 1099,
        "paypal" => "EQP6X7RTGXCAY",
        "color_case" => array("Red","Blue","Pink")
    );
    $products[103] = array(
        "name" => "CybertronPC Quattro GM3142A",
        "img" => "img/computers/computer-103.jpg",    
        "price" => 1681.98,
        "paypal" => "54DHHETPSL7MY",
        "color_case" => array("Red","Blue","Pink")
    );
    $products[104] = array(
        "name" => "Lenovo IdeaCentre K430",
        "img" => "img/computers/computer-104.jpg",    
        "price" => 2000,
        "paypal" => "LUJ7UBKNASL9U",
        "color_case" => array("Red","Blue","Pink")
    );
    $products[105] = array(
        "name" => "ASUS CM Series CM6870",
        "img" => "img/computers/computer-105.jpg",    
        "price" => 1259,
        "paypal" => "RYREAN36J9V62",
        "color_case" => array("Red","Blue","Pink")
    );
    $products[106] = array(
        "name" => "ASUS Essentio CM6870-US-2AA",
        "img" => "img/computers/computer-106.jpg",    
        "price" => 1099,
        "paypal" => "XRL3K2WZADAC2",
        "color_case" => array("Red","Blue","Pink")
    );
    $products[107] = array(
        "name" => "Lenovo IdeaCentre K430",
        "img" => "img/computers/computer-107.jpg",    
        "price" => 2000,
        "paypal" => "L8MYASDVT5GGJ",
        "color_case" => array("Red","Blue","Pink")
    );
    $products[108] = array(
        "name" => "Lenovo ThinkCentre Edge 92z 3414",
        "img" => "img/computers/computer-108.jpg",    
        "price" => 864,
        "paypal" => "WY4LFMPTRABWC",
        "color_case" => array("Red","Blue","Pink")
    );

    // when creating a new product, create it first in PayPal and
    // then copy the product ID from PayPal to use here     

    // automated duplication to copy the product_id/sku from the array key
    // and duplicate it into the product details inside the array
    foreach ($products as $product_id => $product) {
       $products[$product_id]["sku"] = $product_id;
    } // end foreach
*/
    /*  PDO function:
    *   @param mysql:host=localhost;dbname=compux_db identifies database
    *   1st part of string: type of database
    *   2nd depending on type of db, on this case host=...
    *   3rd name of database
    *   4th if sql uses default port, this is not need. else you need to specify it like:
    *   ';port=8889'
    *   @param admn_db the user name
    *   @param QQ09AgIEAjIDA6yOkuYN the password of the 'admn_db'
    */

    require(ROOT_PATH . "inc/db.php");
    
    // it's a good idea to set a try cratch for each point of interactino
    try { // query
        $results = $db->query("SELECT name, price, img, sku, paypal FROM products ORDER BY sku ASC");
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database.";
        exit;   
    }

    $products = $results->fetchAll(PDO::FETCH_ASSOC);

return $products;
} // end get_products_all function

/**
*   Retuns an array of product information for the product
*   that matches the sku; 
*   Returns a boolean false if on product matches the sku
*   @param  int     $sku the sku
*   @param  mixed   array list of produc information for the one matching product 
*                   bool false if on product matches
*/
function get_product_single($sku) {
    require(ROOT_PATH . "inc/db.php");

    try {
        $results = $db->prepare("SELECT name, price, img, sku, paypal FROM products WHERE sku = ?");
        $results->bindParam(1, $sku); // replaces sku with a variable that protects from sql injection
        $results->execute(); // execute query
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database.";
        exit;
    }

    $product = $results->fetch(PDO::FETCH_ASSOC); // returns the first result

    if($product === false) {
        return $product;
    } // end if

    $product["color_case"] = array();

    try {
        $results = $db->prepare("
            SELECT color 
            FROM products_color ps 
            INNER JOIN colors s ON ps.color_id = s.id
            WHERE product_sku = ?
            ORDER BY `order`");
        $results->bindParam(1,$sku);
        $results->execute();
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database: " . $e;
    } // end try

    while($row = $results->fetch(PDO::FETCH_ASSOC)) {
        $product["color_case"][] = $row["color"];
    } // end while

    return $product;
} // end get_product_single function

?>