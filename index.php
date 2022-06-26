<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping cart</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
      <h2>List of Items </h2>
      <a class="btn btn-primary" href="/shoppingcart/create.php" role="button">New Item</a>
      <br>
      <table class="table">
        <thead>
          <tr> 
            <th>No.</th>
            <th>Item</th>
            <th>Amount</th>
            <th>Created At</th>
            <th>Action</th>
          <tr>
        </thead>
        <tbody>
          <?php
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

          // Reads from database (table)
          $sql = "SELECT * FROM items";
          $result = $connection->query($sql);


          if (!$result) {
            die("Invalid query: " . $connection->error);
          }

          // read data of each row
          while($row = $result->fetch_assoc()) {
            echo"          
            <tr>
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[amount]</td>
                <td>$row[created_at]</td>
                <td>
                  <a class='btn btn-primary btn-sm' href='/shoppingcart/edit.php?id=$row[id]'>Edit</a>
                  <a class='btn btn-danger btn-sm' href='/shoppingcart/delete.php?id=$row[id]'>Delete</a>
                </td>
            <tr>
            ";
          }
          ?>

      </tbody>
    </table>
  </div>
</body>
</html>
