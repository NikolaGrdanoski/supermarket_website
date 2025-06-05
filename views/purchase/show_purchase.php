<?php
    require_once './models/purchasedb.php';
    require_once './models/productdb.php';

    $purchaseID = $_GET['purchaseID'] ?? null;
    $purchaseDB = new PurchaseDB();
    $purchase = $purchaseDB->get_purchase_by_id($purchaseID);    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./views/main.css">
        <title>Purchase Details</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <br>
        <main>
            <div class="container mt-5">
                <h1>Purchase Details</h1>
                <?php if ($purchase): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Purchase #<?php echo $purchaseID; ?></h5>
                            <p class="card-text"><strong>Total Cost:</strong> $<?php echo number_format($purchase['total'], 2); ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning" role="alert">
                        Purchase not found.
                    </div>
                <?php endif; ?>
                <a href="index.php?action=view_user_purchases" class="btn btn-secondary mt-3">Back to purchases</a>
            </div>
        </main>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>
