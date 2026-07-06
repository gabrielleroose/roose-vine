<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
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
$error = '';
?>


    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $servername = getenv("MYSQLHOST");
    $username = getenv("MYSQLUSER");
    $password = getenv("MYSQLPASSWORD");
    $dbname = getenv("MYSQLDATABASE") ?: getenv("MYSQL_DATABASE");

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql_table = "Select mi.item_id, mi.item_name as name,mi.price,mi.description, mc.category_name as category, r.name as restaurant from menu_item mi
    JOIN menu_category mc ON mi.category_id = mc.category_id
    JOIN restaurant r ON mi.restaurant_id = r.restaurant_id";
    $results = $conn->query($sql_table);

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $conn->prepare("SELECT item_name, price, description FROM menu_item WHERE item_id = ?");

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $item_id = intval($_POST['item_id']);
        $item_name = trim($_POST['item_name']);
        $price = trim($_POST['price']);
        $description = trim($_POST['description']);
    
        if (empty($item_name) || $price === '') {
            $error = "Item name and price are required.";
        } else {
            $price = floatval($price); 
            if ($price <= 0) {
                $error = "Please enter a valid positive number for price.";
            } else {
                $update_stmt = $conn->prepare("UPDATE menu_item SET item_name = ?, price = ?, description = ? WHERE item_id = ?");
                $update_stmt->bind_param("sdsi", $item_name, $price, $description, $item_id);
                $update_stmt->execute();
        
                header("Location: public.php");
                exit;
    }
}
    }

    ?>



<div class="container mt-4">
    <h2>Edit Menu Item</h2>

    <?php
if (!empty($error)) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
}
?>

    <form method="POST" class="w-50">
        <input type="hidden" name="item_id" value="<?= htmlspecialchars($id) ?>">
        
        <div class="mb-3">
            <label class="form-label">Item Name</label>
            <input type="text" name="item_name" class="form-control" value="<?= htmlspecialchars($item['item_name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($item['price']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($item['description']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-success mb-3">Save Changes</button>
        <a href="public.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

    
</body>


</html>

