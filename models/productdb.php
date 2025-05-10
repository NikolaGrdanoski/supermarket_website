<?php

    class ProductDB {
        public function create($name, $description, $price, $image, $categoryID, $userID) {
            $query = "INSERT INTO products (name, description, price, image, categoryID, userID) 
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
            $query = "SELECT * FROM products";
            $statement = Database::get_db()->prepare($query);
            $statement->execute();
            $products = $statement->fetchAll();
            $statement->closeCursor();
            return $products;
        }

        public function find_by_name($name) {
            $query = "SELECT products.*, categories.name FROM products JOIN categories ON products.categoryID = categories.categoryID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':name', '%' . $name . '%');
            $statement->execute();
            $names = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $names;
        }

        public function find_by_id($productID) {
            $query = "SELECT * FROM products WHERE productID = :productID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':productID', $productID);
            $statement->execute();
            $product = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $product;
        }

        public function find_by_category($categoryID) {
            $query = "SELECT * FROM products WHERE categoryID = :categoryID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->execute();
            $products = $statement->fetchAll();
            $statement->closeCursor();
            return $products;
        }

        public function update($productID, $name, $description, $price, $categoryID, $image) {
            $query = "UPDATE products  SET name = :name, description = :description, price = :price, categoryID = :categoryID, image = :image WHERE productID = :productID";
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
            $query = "DELETE FROM products WHERE productID = :productID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':productID', $productID);
            $statement->execute();
            $statement->closeCursor();
        }
    }