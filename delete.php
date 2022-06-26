<?php
if ( isset($_GET["id"]) ) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password ="";
    $database = "shopping-cart";

    // Creates A connection to database
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM items WHERE id=$id";
    $connection->query($sql);
}

header("location: /shoppingcart/index.php");
exit;
?>
