<?php

    class PurchaseDB {
        public function create_purchase($userID, $total_cost) {
            $query = "INSERT INTO purchases (userID, total_cost) VALUES (:userID, :total_cost)";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->bindValue(':total_cost', $total_cost);
            $statement->execute();
            $purchaseID = Database::get_db()->lastInsertId();
            $statement->closeCursor();

            return $purchaseID;
        }

        public function get_purchase_by_id($purchaseID) {
            $query = "SELECT * FROM purchases WHERE purchaseID = :purchaseID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':purchaseID', $purchaseID);
            $statement->execute();
            $purchase = $statement->fetch();
            $statement->closeCursor();
            return $purchase;
        }

        public function get_purchase_by_user($userID) {
            $query = "SELECT * FROM purchases WHERE userID = :userID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $purchases = $statement->fetchAll();
            $statement->closeCursor();
            return $purchases;
        }

        public function count_user_purchase($userID) {
            $query = "SELECT COUNT(*) AS purchase_count FROM purchases WHERE userID = :userID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $result = $statement->fetch();
            $statement->closeCursor();

            return $result['purchase_count'];
        }

        public function remove_purchase($purchaseID) {
            $query = "DELETE FROM purchases WHERE purchaseID = :purchaseID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':purchaseID', $purchaseID);
            $statement->execute();
            $statement->closeCursor();
        }
    }