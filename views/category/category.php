<?php
    require_once './models/productdb.php';

    $productDB = new ProductDB();
    $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
    
    $products = $productDB->find_by_category($categoryID);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <title>Category Products</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <main class="container mt-5 pt-5">
            <h2>Category products</h2><hr>  
            <?php if (!empty($products)): ?>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?php echo htmlspecialchars($product['name']); ?>
                                            </h5>
                                            <p class="card-text">
                                                <?php
                                                    $short_description = substr($product['description'], 0, 100);
                                                    echo htmlspecialchars($short_description);

                                                    if (strlen($product['description']) > 100) {
                                                        echo '...';
                                                    }
                                                ?>
                                            </p>
                                            <p class="card-text">
                                                <strong>
                                                    Price: <?php echo "<span class='badge bg-info'>" . number_format($product['price'], 2) . " MKD</span>"; ?>
                                                </strong>
                                            </p>
                                            <a href="index.php?action=show_product&productID=<?php echo $product['productID']; ?>" class="btn btn-info">View</a>

                                            <?php if ($is_logged_in && $user_role == 'Customer'): ?>
                                                <form action="index.php?action=add_to_cart" method="post" class="d-inline">
                                                    <input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">
                                                    <input type="hidden" name="productID" value="<?php echo $product['productID'] ?>">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn btn-primary">Add to cart</button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning mt-5" role="alert">
                    No products found in this category.
                </div>
            <?php endif; ?>
            <br>
        </main>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>