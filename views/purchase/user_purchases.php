<?php
    require_once './models/purchasedb.php';

    $userID = $_SESSION['userID']; 
    $purchaseDB = new PurchaseDB();
    $purchases = $purchaseDB->get_purchase_by_user($userID);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./views/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>Your purchases</title>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <br>
        <main>
            <div class="container mt-5">
                <h1>Your purchases</h1><hr>
                <?php if (!empty($purchases)): ?>
                    <table class="table table-purchased table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Purchase ID</th>
                                <th scope="col">Total Cost</th>
                                <th scope="col-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($purchases as $purchase): ?>
                                <tr>
                                    <td><?php echo $purchase['purchaseID']; ?></td>
                                    <td><?php echo number_format($purchase['total'], 2); ?> MKD</td>
                                    <td>
                                        <a href="index.php?action=view_purchase&purchaseID=<?php echo htmlspecialchars($purchase['purchaseID']); ?>" class="btn btn-primary btn-sm">View</a>
                                        <form action="index.php?action=remove_purchase" method="post" class="d-inline">
                                            <input type="hidden" name="purchaseID" value="<?php echo htmlspecialchars($purchase['purchaseID']); ?>">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-info" role="alert">
                        No purchases found.
                    </div>
                <?php endif; ?>
            </div>
        </main>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>
