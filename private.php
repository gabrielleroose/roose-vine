<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/groose/css/styles.css"> -->

    <style>
        <?php include 'css/styles.css' ?><?php include 'css/grid.css' ?>
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
    $attributes_query = "SELECT * FROM dish_attributes";
    $attributes_result = $conn->query($attributes_query);
    ?>

    <h2>Add a New Dish</h2>
    <form action="" method="POST">
        <label for="dish_name">Dish Name:</label>
        <input type="text" name="dish_name" id="dish_name" required>

        <label for="price">Dish Price:</label>
        <input type="number" name="price" id="price" required>

        <label for="description">Dish Description:</label>
        <input type="text" name="description" id="discription" required>

        <label>Dish Attributes:</label>
        <div class="checkbox-group">
            <?php while ($row = $attributes_result->fetch_assoc()): ?>
                <input type="checkbox" name="attributes[]" value="<?= $row['attribute_id'] ?>">
                <?= htmlspecialchars($row['attribute_name']) ?><br>
            <?php endwhile; ?>
        </div>

        <button type="submit">Add Dish</button>

    </form>



</body>

</html>