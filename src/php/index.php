<!-- product_details.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit</title>
</head>
<body>
    <h1>Produits disponibles</h1>
    <div class="product-details">
    <?php
// Update database connection details
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'cy-play';

// Connect to the database
$mysqli = new mysqli($host, $user, $password, $dbname);

// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

// Query to fetch one image from each product
$sql = "SELECT product.id, product.name, MIN(productimages.image_url) AS image_url FROM product
        LEFT JOIN productimages ON product.id = productimages.product_id
        GROUP BY product.id, product.name";

// Execute query
$result = $mysqli->query($sql);

// Display images with links
// Display images with links
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    // Use the image URL directly from the database
    $image_url = $row['image_url'];
    echo "<a href='product_details.php?id=".$row['id']."'><img src='".$image_url."' alt='".$row['name']."' width='200px'></a>";
}

} else {
  echo "No products found.";
}


// Close connection
$mysqli->close();
?>



    </div>
</body>
</html>
