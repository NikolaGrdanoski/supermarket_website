<?php

    class CategoryDB {
        public function create($name, $description) {
            $query = "INSERT INTO category (name, description)
            VALUES (:name, :description)";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':description', $description);
            $statement->execute();
            $statement->closeCursor();
        }

        public function find_all() {
            $query = "SELECT * FROM category";
            $statement = Database::get_db()->prepare($query);
            $statement->execute();
            $category = $statement->fetchAll();
            $statement->closeCursor();
            return $category;
        }

        public function find_by_id($categoryID) {
            $query = "SELECT * FROM category WHERE categoryID = :categoryID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->execute();
            $category = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $category;
        }

        public function find_by_name($name) {
            $query = "SELECT * FROM category WHERE name = :name";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':name', $name);
            $statement->execute();
            $names = $statement->fetchAll();
            $statement->closeCursor();
            return $names;
        }

        public function update($categoryID, $name, $description) {
            $query = "UPDATE category SET name = :name, description = :description WHERE categoryID = :categoryID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':description', $description);
            $statement->execute();
            $statement->closeCursor();
        }

        public function delete($categoryID) {
            $query = "DELETE FROM category WHERE categoryID = :categoryID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->execute();
            $statement->closeCursor();
        }
    }