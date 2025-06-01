<?php
    require_once './models/purchase_db.php';
    require_once './models/cart_db.php';
    require_once './send_mail.php';

    class PurchaseController {
        public function view_purchase($purchaseID) {
            $purchaseDB = new PurchaseDB();
            $purchase = $purchaseDB->get_purchase_by_id($purchaseID);
            include './views/purchase/show_purchase.php';
        }

        public function view_user_purchases($userID) {
            $purchaseDB = new PurchaseDB();
            $purchases = $purchaseDB->get_purchases_by_user($userID);
            include './views/purchase/user_purchases.php';
        }

        public function remove_purchase($purchaseID) {
            $purchaseDB = new PurchaseDB();
            $purchaseDB->remove_purchase($purchaseID);
            header("Location: index.php?action=view_user_purchases&userID=" . $_SESSION['userID']);
            exit();
        }

        public function checkout() {
            $userID = $_SESSION['userID']; 
            $cartDB = new CartDB();
            $purchaseDB = new PurchaseDB();
    
            $total_cost = $cartDB->calculate_cart_total($userID);
    
            if ($total_cost > 0) {
                
                $purchaseID = $purchaseDB->create_purchase($userID, $total_cost);
                $cartDB->clear_cart($userID);
                
                $userDB = new UserDB();
                $user = $userDB->find_by_id($userID);
                $user_email = $user['email'];
                $user_name = $user['name'];
            } else {
                echo "Error: Cart is empty or an error occurred.";
            }
        }
    }