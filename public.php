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
        <?php include 'css/home.css' ?> 

    </style>  
    
</head>
<body>
<?php include 'includes/navbar.php'; ?>

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
        <td>Cheeseburger</td>
        <td>$8.99</td>
        <td>American</td>
        <td>Beef & Cheese Burger</td>
     </tr>

     <tr>
        <td>Cheeseburger</td>
        <td>$8.99</td>
        <td>American</td>
        <td>Beef & Cheese Burger</td>
     </tr>

  </table>

  <h2>Food Gallery</h2>
  <div class="food-gallery">
    <img src="img/enchiladas.jpg" alt="image of enchiladas on a plate">
    <img src="img/enchiladas.jpg" alt="image of enchiladas on a plate">
    <img src="img/enchiladas.jpg" alt="image of enchiladas on a plate">
    <img src="img/enchiladas.jpg" alt="image of enchiladas on a plate">

  </div>
    
</body>
</html>