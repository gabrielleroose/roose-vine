<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
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


    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $conn->prepare("SELECT item_name, price, description FROM menu_item WHERE item_id = ?");

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $item_id = intval($_POST['item_id']);
    
        $delete_stmt = $conn->prepare("DELETE FROM menu_item WHERE item_id = ?");
        $delete_stmt->bind_param("i", $item_id);
        $delete_stmt->execute();
    
        header("Location: public.php");
        exit;
    }


    ?>



<div class="container mt-4">
    <h2>Delete Menu Item</h2>

    <?php
if (!empty($error)) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
}
?>

    <form method="POST" class="w-50">
        <input type="hidden" name="item_id" value="<?= htmlspecialchars($id) ?>">
        
        <div class="mb-3">
            <label class="form-label">Item Name</label>
            <p class="form-control-plaintext" > <?= htmlspecialchars($item['item_name']) ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <p class="form-control-plaintext" > <?= htmlspecialchars($item['price']) ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <p class="form-control-plaintext" ><?= htmlspecialchars($item['description']) ?></p>
        </div>

        <button type="submit" class="btn btn-danger mb-3">Confirm Delete</button>
        <a href="public.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

    
</body>


</html>

