<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        <?php include 'css/styles.css' ?> 
        <?php include 'css/grid.css' ?> 

    </style>  
    
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<?php
// Connect to database
$servername = "db.luddy.indiana.edu";
$username = "i494f25_groose"; 
$password = "prose3351skite";
$dbname = "i494f25_groose";   

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<table class="dish-table">
     <tr>
     <th>Dish Name</th>
     <th>Dish Price</th>
     <th>Dish Category</th>
     <th>Dish Description</th>
     </tr>
     
     <tr>
       <td>Enchiladas</td>
       <td>$10.99</td>
       <td>Mexican</td>
       <td>Chicken & Cheese Enchiladas</td>
     </tr>

     <tr>
        <td>Cheeseburger</td>
        <td>$8.99</td>
        <td>American</td>
        <td>Beef & Cheese Burger</td>
     </tr>

     <tr>
        <td>Chicken Sandwhich</td>
        <td>$11.99</td>
        <td>American</td>
        <td>Fried Chicken Sandwhich w/ Cheese</td>
     </tr>

     <tr>
        <td>Pasta Salad</td>
        <td>$9.99</td>
        <td>Italian</td>
        <td>Pasta Salad with tomatoes & salami</td>
     </tr>

  </table>

  <h2>Food Gallery</h2>
  <div class="food-gallery">
    <img src="img/enchiladas.jpg" alt="image of enchiladas on a plate">
    <img src="img/cheeseburger.jpg" alt="image of a cheesrburger and fries on a plate">
    <img src="img/chicken-sandwhich.jpg" alt="close up image of a chicken sandwhich">
    <img src="img/pasta-salad.jpg" alt="bowl of pasta salad">

  </div>
    
</body>
</html>