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

    $sql_table = "Select mi.item_id, mi.item_name as name,mi.price,mi.description, mc.category_name as category, r.name as restaurant from menu_item mi
    JOIN menu_category mc ON mi.category_id = mc.category_id
    JOIN restaurant r ON mi.restaurant_id = r.restaurant_id";
    $results = $conn->query($sql_table);

    ?>

    <?php
    if (isset($_GET['updated']) && $_GET['updated'] == 1) {
        echo '<div class="alert alert-success">Menu item updated successfully!</div>';
    }
    ?>

    <table class="dish-table">
        <thead>
            <tr>
                <th>Dish Name</th>
                <th>Dish Price</th>
                <th>Dish Category</th>
                <th>Dish Description</th>
                <th>Restaurant</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if ($results->num_rows > 0) {
                while ($row = $results->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['restaurant']) . "</td>";
                    echo "<td>" . "<a href='edit.php?id=" . urlencode($row['item_id']) . "' class='btn btn-primary btn-sm'>Edit</a>" . "</td>";
                    echo "<td>" . "<a href='delete.php?id=" . urlencode($row['item_id']) . "' class='btn btn-danger btn-sm'>Delete</a>" . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No menu items found.</td></tr>";
            }


            ?>

        </tbody>
    </table>

    <h2 class="food-title">Food Gallery</h2>
    <div class="food-gallery">
        <img src="img/bruchetta.png" alt="image Italian bruchetta">
        <img src="img/garlic-bread.png" alt="close up image of garlic bread in a bowl">
        <img src="img/caprese.png" alt="image of caprese on a plate">
        <img src="img/chicken-parm.png" alt="image of chicken parmesean on a plate">
    </div>

</body>

</html>