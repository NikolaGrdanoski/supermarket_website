<?php
    require_once './models/productdb.php';

    $productDB = new ProductDB();

    $productID = $_GET['productID'] ?? null;
    $product = $productDB->find_by_id($productID);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>        
        <title><?php echo htmlspecialchars($product['name']); ?></title>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <br><br>
        <main class="container mt-5">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <?php if (!empty($product)): ?>
                        <div class="row">
                            <div class="col-md-6">
                                <img src="./<?php echo htmlspecialchars($product['image']); ?>" class="img-fluid product-image" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </div>
                            <div class="col-md-5">
                                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                                <p class="h5"><?php echo "<div class='card-text'>" . htmlspecialchars($product['description']) . "</div>"; ?></p>
                                <p class="h4">Price: <?php echo "" . number_format($product['price'], 2) . " MKD</span>"; ?></p>
                                <div class="mt-1">
                                    <?php if ($is_logged_in): ?>
                                        <?php if ($user_role == 'Customer'): ?>
                                            <form action="index.php?action=add_to_cart" method="post" class="d-inline">
                                                <input type="hidden" name="productID" value="<?php echo htmlspecialchars($product['productID']); ?>">
                                                <input type="number" name="quantity" min="1" class="form-control" placeholder="Quantity"><hr>
                                                <button type="submit" class="btn btn-primary btn">Add to Cart</button>
                                            </form>
                                        <?php endif; ?>
                                        <?php if ($is_logged_in && $user_role == 'Admin'): ?>
                                            <a href="index.php?action=edit_product&productID=<?php echo htmlspecialchars($product['productID']); ?>" class="btn btn-warning btn-lg me-2">Edit</a>
                                            <a href="index.php?action=delete_product&productID=<?php echo htmlspecialchars($product['productID']); ?>" class="btn btn-danger btn-lg">Delete</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>                      
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            Product not found.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>
