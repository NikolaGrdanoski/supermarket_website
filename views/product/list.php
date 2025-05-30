<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <title>Product List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <main>
            <div class="container-lg">
                <div class="row">
                    <h1>Product List</h1>
                    <hr>
                    <?php if (empty($products)): ?>
                        <p>No products found.</p>
                    <?php else: ?>
                        <div class="col-md-6">
                            <div class="card smooth-transition">
                                <div class="card-body">
                                    <?php foreach($products as $product): ?>
                                        <p>
                                            <img src="<?php echo strip_tags($product['image']); ?>" alt="<?php echo strip_tags($product['name']); ?>" style="widp: 100px; height: auto;">
                                        </p>
                                        <h3 class="card-title">Name: <?php echo strip_tags($product['name']); ?></d>
                                        <p class="description">Description: <?php echo strip_tags($product['description']); ?></p>
                                        <p class="card-text">Category: <?php echo strip_tags($product['category_name']); ?></p> 
                                        <p class="card-text">Price: <?php echo number_format($product['price'], 2); ?>$</p>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </body>
</html>