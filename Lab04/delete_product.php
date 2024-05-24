<?php
// check if value was posted
if($_POST){

    // include database and object file
    include_once 'config/database.php';
    include_once 'objects/product.php';
    include_once 'objects/history.php';


    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare product object
    $product = new Product($db);

    // set product id to be deleted
    $product->id = $_POST['object_id'];

    // delete the product
    if($product->delete()){
        echo "Object was deleted.";

        // prepare history object
        $history = new History($db);
        $history->id = $product->id;  // Use the product ID
        $history->action = "Delete product";

        if($history->create()){
            echo "<div class='alert alert-success'>History was recorded.</div>";
        } else {
            echo "<div class='alert alert-danger'>Unable to record history.</div>";
        }
    }

    // if unable to delete the product
    else{
        echo "Unable to delete object.";
    }
}
?>