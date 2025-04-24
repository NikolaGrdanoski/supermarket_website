<?php

    class UserDB {
        public function create($username, $password, $email, $name, $surname, $phone, $country, $role) {
            $query = "INSERT INTO users (username, password, email, name, surname, phone,  country, role) 
            VALUES (:username, :password, :email, :name, :surname, :phone, :country, :role)";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':surname', $surname);
            $statement->bindValue(':phone', $phone);
            $statement->bindValue(':country', $country);
            $statement->bindValue(':role', $role);
            $result = $statement->execute();
            $statement->closeCursor();

            return $result;
        }

        public function find_by_id($userID) {
            $query = "SELECT * FROM users WHERE userID = :userID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $user = $statement->fetch();
            $statement->closeCursor();
            return $user;
        }

        public function find_by_username($username) {
            $query = "SELECT * FROM users WHERE username = :username";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':username', $username);
            $statement->execute();
            $user = $statement->fetch();
            $statement->closeCursor();
            return $user;
        }

        public function find_by_name($name) {
            $query = "SELECT * FROM users WHERE name = :name";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':name', $name);
            $statement->execute();
            $users = $statement->fetchAll();
            $statement->closeCursor();
            return $users;
        }

        public function update($userID, $username = '', $password = '') {
            if (empty($username) && !empty($password)) {
                $query = "UPDATE users  SET password = :password WHERE userID = :userID";
                $statement = Database::get_db()->prepare($query);
                $statement->bindValue(':userID', $userID);
                $statement->bindValue(':password', $password);
            }
            elseif (!empty($username) && empty($password)) {
                $query = "UPDATE users  SET username = :username WHERE userID = :userID";
                $statement = Database::get_db()->prepare($query);
                $statement->bindValue(':userID', $userID);
                $statement->bindValue(':username', $username);
            }
            elseif (!empty($username) && !empty($password)) {
                $query = "UPDATE users SET username = :username, password = :password WHERE userID = :userID";
                $statement = Database::get_db()->prepare($query);
                $statement->bindValue(':userID', $userID);
                $statement->bindValue(':username', $username);
                $statement->bindValue(':password', $password);
            }
            $statement->execute();
            $statement->closeCursor();
        }

        public function delete($userID) {
            $query = "DELETE FROM users WHERE userID = :userID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $statement->closeCursor();
        }
    }