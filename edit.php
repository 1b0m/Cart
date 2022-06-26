<?php
$servername = "localhost";
$username = "root";
$password ="";
$database = "shopping-cart";

// Creates A connection to database
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$name = "";
$amount = "";

$ErrorMessage = "";
$SuccessMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
    // Shows data of item

    if ( !isset($_GET["id"]) ) {
        header("location: /shoppingcart/index.php");
        exit;
    }

    $id = $_GET["id"];

    // Reads row of selected item from data base
    $sql = "SELECT * FROM items WHERE id=$id"; 
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /shoppingcart/index.php");
        exit;
    }

    $name = $row["name"];
    $amount = $row["amount"];
}

else {
    // Updates data of item

    $id = $_POST["id"];
    $name = $_POST["name"];
    $amount = $_POST["amount"];

    do {
        if ( empty($id) || empty($name) || empty($amount) ) {
            $ErrorMessage = "All fields are required";
            break;
        }
        $sql = "UPDATE items " .
            "SET name = '$name', amount = '$amount' " .
            "WHERE id = $id";
        $result = $connection->query($sql);
        if (!$result){
            $ErrorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $SuccessMessage = "Client added correctly";
        header("location: /shoppingcart/index.php");
        exit;
    } while (false);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js "></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Item</h2>

        <?php
        if ( !empty($ErrorMessage) ) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$ErrorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm col-form-label">Amount</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="amount" value="<?php echo $amount; ?>">
                </div>
            </div>


            <?php
            if ( !empty($SuccessMessage) ) {
                echo"
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$SuccessMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grind">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            <div class="col-sm-3 d-grind">
                <a class="btn btn-outline-primary" href="/shoppingcart/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
</body>
</html>
