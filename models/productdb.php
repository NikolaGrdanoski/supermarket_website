<?php

    class ProductDB {
        public function create($name, $description, $price, $image, $categoryID, $userID) {
            $query = "INSERT INTO product (name, description, price, image, categoryID, userID) 
            VALUES (:name, :description, :price, :image, :categoryID, :userID)";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':image', $image);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $statement->closeCursor();
        }

        public function find_all() {
            $query = "SELECT * FROM product";
            $statement = Database::get_db()->prepare($query);
            $statement->execute();
            $product = $statement->fetchAll();
            $statement->closeCursor();
            return $product;
        }

        public function find_by_name($name) {
            $query = "SELECT product.*, category.name FROM product JOIN category ON product.categoryID = category.categoryID WHERE LOWER(product.name) LIKE LOWER(:name)";;
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':name', '%' . $name . '%');
            $statement->execute();
            $names = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $names;
        }

        public function find_by_id($productID) {
            $query = "SELECT * FROM product WHERE productID = :productID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':productID', $productID);
            $statement->execute();
            $product = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $product;
        }

        public function find_by_category($categoryID) {
            $query = "SELECT * FROM product WHERE categoryID = :categoryID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->execute();
            $product = $statement->fetchAll();
            $statement->closeCursor();
            return $product;
        }

        public function update($productID, $name, $description, $price, $categoryID, $image) {
            $query = "UPDATE product  SET name = :name, description = :description, price = :price, categoryID = :categoryID, image = :image WHERE productID = :productID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':productID', $productID);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->bindValue(':image', $image);
            $statement->execute();
            $statement->closeCursor();
        }

        public function delete($productID) {
            $query = "DELETE FROM product WHERE productID = :productID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':productID', $productID);
            $statement->execute();
            $statement->closeCursor();
        }
    }