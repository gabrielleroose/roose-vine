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
    $servername = getenv("MYSQLHOST");
    $username = getenv("MYSQLUSER");
    $password = getenv("MYSQLPASSWORD");
    $dbname = getenv("MYSQLDATABASE") ?: getenv("MYSQL_DATABASE");

    $conn = new mysqli($servername, $username, $password, $dbname);
    $attributes_query = "SELECT * FROM dish_attributes";
    $attributes_result = $conn->query($attributes_query);
    $errors = [];
    $success_message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dish_name = trim($_POST["dish_name"]);
        $price = trim($_POST["price"]);
        $attributes = $_POST["attributes"] ?? [];
        $description = trim($_POST["description"]);
        if (empty($dish_name) || !preg_match("/^[a-zA-Z\s]+$/", $dish_name)){
            $errors[] = "Dish name should only contain letters.";
        }
        if (empty($price) || !is_numeric($price) || $price <= 0){
            $errors[] = "Please enter a valid dish price.";
        }
        if (empty($description)){
            $errors[] = "Dish description should not be empty.";
        }
        $dish_name = htmlspecialchars(strip_tags($dish_name));
        $description = str_replace(['"', "'"], '', $description);
        $description = htmlspecialchars(strip_tags($description));
        $price = floatval($price);

        if (empty($errors)){
            $stmt = $conn->prepare("INSERT INTO menu_item (item_name, price, description, category_id, restaurant_id) VALUES (?, ?, ?, 1, 1)");
            $stmt->bind_param("sds", $dish_name, $price, $description);

            if ($stmt->execute()) {
                $item_id = $stmt->insert_id;

                
                foreach ($attributes as $attr_id) {
                    $attr_stmt = $conn->prepare("INSERT INTO menu_item_attribute (item_id, attribute_id) VALUES (?, ?)");
                    $attr_stmt->bind_param("ii", $item_id, $attr_id);
                    $attr_stmt->execute();
                }

                $success_message = "Dish successfully added!";
            } else {
                $errors[] = "Database insert failed: " . $conn->error;
            }



        }
    }

    ?>

    <h2 class="form_heading">Add a New Dish</h2>

    <form action="" method="POST">
        <label for="dish_name">Dish Name:</label>
        <input type="text" name="dish_name" id="dish_name">

        <label for="price">Dish Price:</label>
        <input type="text" name="price" id="price">

        <label for="description">Dish Description:</label>
        <input type="text" name="description" id="discription">

        <label>Dish Attributes:</label>
        <div class="checkbox-group">
            <?php while ($row = $attributes_result->fetch_assoc()): ?>
                <input type="checkbox" name="attributes[]" value="<?= $row['attribute_id'] ?>">
                <?= htmlspecialchars($row['attribute_name']) ?><br>
            <?php endwhile; ?>
        </div>

        <button type="submit">Add Dish</button>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <ul>
                    <?php foreach ($errors as $e): ?>
                        <li><?= $e ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php elseif ($success_message): ?>
            <div class="success"><?= $success_message ?></div>
        <?php endif; ?>

    </form>

</body>

</html>