<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        <?php include 'css/styles.css'; ?><?php include 'css/grid.css'; ?>
    </style>
</head>

<body>


    <?php include 'includes/navbar.php'; ?>

    <?php
    $servername = "db.luddy.indiana.edu";
    $username = "i494f25_groose";
    $password = "prose3351skite";
    $dbname = "i494f25_groose";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql_table = "Select mi.item_name as name,mi.price,mi.description, mc.category_name As category, r.name as Restaurant from menu_item mi
    JOIN menu_category mc ON mi.category_id = mc.category_id
    JOIN restaurant r ON mi.restaurant_id = r.restaurant_id";
    $results = $conn->query($sql_table);

    ?>


    <table class="dish-table">
        <thead>
            <tr>
                <th>Dish Name</th>
                <th>Dish Price</th>
                <th>Dish Category</th>
                <th>Dish Description</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if ($results->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['restaurant']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No menu items found.</td></tr>";
            }


            ?>

        </tbody>
    </table>

    <h2>Food Gallery</h2>
    <div class="food-gallery">
        <img src="img/enchiladas.jpg" alt="image of enchiladas on a plate">
        <img src="img/cheeseburger.jpg" alt="image of a cheeseburger and fries on a plate">
        <img src="img/chicken-sandwhich.jpg" alt="close up image of a chicken sandwich">
        <img src="img/pasta-salad.jpg" alt="bowl of pasta salad">
    </div>

</body>

</html>