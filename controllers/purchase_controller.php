<?php
    require_once './models/purchasedb.php';
    require_once './models/cartdb.php';
    require_once './mail_service.php';

    class PurchaseController {
        public function view_purchaseID($purchaseID) {
            $purchaseDB = new PurchaseDB();
            $purchase = $purchaseDB->get_purchase_by_id($purchaseID);
            include './views/purchase/show_purchase.php';
        }

        public function view_user_purchases($userID) {
            $purchaseDB = new PurchaseDB();
            $purchases = $purchaseDB->get_purchase_by_user($userID);
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

                if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                    $success = send_purchase_confirmation_email($user_email, $user_name, $purchaseID, $total_cost);
                    if ($success) {
                        header("Location: index.php?action=view_purchase&purchaseID=" . $purchaseID);
                        exit();
                        } else {
                        echo 'Error sending confirmation email.';
                    }
                } else {
                    echo 'Invalid email address.';
                }
            } else {
                echo "Error: Cart is empty or an error occurred.";
            }
        }
    }