<?php

    class PurchaseDB {
        public function create_purchase($userID, $total_cost) {
            $query = "INSERT INTO purchase (userID, total) VALUES (:userID, :total)";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->bindValue(':total', $total_cost);
            $statement->execute();
            $purchaseID = Database::get_db()->lastInsertId();
            $statement->closeCursor();

            return $purchaseID;
        }

        public function get_purchase_by_id($purchaseID) {
            $query = "SELECT * FROM purchase WHERE purchaseID = :purchaseID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':purchaseID', $purchaseID);
            $statement->execute();
            $purchases = $statement->fetch();
            $statement->closeCursor();
            return $purchases;
        }

        public function get_purchase_by_user($userID) {
            $query = "SELECT * FROM purchase WHERE userID = :userID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $purchases = $statement->fetchAll();
            $statement->closeCursor();
            return  $purchases;
        }

        public function count_user_purchase($userID) {
            $query = "SELECT COUNT(*) AS purchase_count FROM purchase WHERE userID = :userID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $result = $statement->fetch();
            $statement->closeCursor();

            return $result['purchase_count'];
        }

        public function remove_purchase($purchaseID) {
            $query = "DELETE FROM purchase WHERE purchaseID = :purchaseID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':purchaseID', $purchaseID);
            $statement->execute();
            $statement->closeCursor();
        }
    }