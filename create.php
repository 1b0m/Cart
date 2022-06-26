<?php
$name = "";
$amount = "";

$ErrorMessage = "";
$SuccessMessage = "";

$servername = "localhost";
$username = "root";
$password ="";
$database = "shopping-cart";

          // Creates A connection to database
          $connection = new mysqli($servername, $username, $password, $database);

          // Check connection
          if ($connection->connect_error) {
              die("Connection failed: " . $connection->connect_error);
          }

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $amount = $_POST["amount"];

    do {
        if ( empty($name) || empty($amount) ) {
            $ErrorMessage = "All fields are required";
            break;
        }


        // Add new item into database
        $sql = "INSERT INTO items (name, amount) " .
                "VALUES ('$name', '$amount')";
                $result = $connection->query($sql);
    
        if (!$result){
            $ErrorMessage = "Invalid query: " . $connection->error;
            break;
        }
        
        $name = "";
        $amount = "";

        $SuccessMessage = "Client added correctly";

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
