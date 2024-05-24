<?php
// core.php holds pagination variables
include_once 'config/core.php';

// include database and object files
include_once 'config/database.php';
include_once 'objects/history.php';
$page_title = "Read History";
include_once "layout_header.php";

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
$history = new History($db);

$all_history = $history->read();
$total_rows=$history->countAll();

// display the products if there are any
if($total_rows>0){

    echo "<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <th>ID</th>
        <th>Action</th>
        <th>Time</th>
    </tr>";

    while ($row = $all_history->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        echo "<tr>
        <td>{$id}</td>
        <td>{$action}</td>
        <td>{$time}</td>
        </tr>";

    }

    echo "</table>";

// paging buttons
    include_once 'paging.php';
}

// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No products found.</div>";
}
include_once "layout_footer.php";
?>