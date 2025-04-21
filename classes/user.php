<?php

enum Role {
    case Buyer;
    case Admin;
}

class User {
    private int $userID;
    private string $username;
    private string $password;
    private string $email;
    private string $name;
    private string $surname;
    private string $phone;
    private string $country;
    private Role $role;

    private function __construct($username, $email, $password, $name, $surname, $phone, $country, $role = Role::Customer) {
        $this->username = $username;
        $this->email = $email;
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $hashedPassword;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->country = $country;
        $this->role = $role;
    }

    public function get_userID(): int { return $this->userID; }

    public function set_userID($userID): void { $this->userID = $userID; }

    public function get_username(): string { return $this->username; }

    public function set_username($username): void { $this->username = $username; }

    public function set_password($password): void { 
        $new_hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $new_hashed_password; 
    }

    public function get_password(): string { return $this->password; }

    public function get_email(): string { return $this->email; }

    public function set_email($email): void { $this->email = $email; }

    public function get_name(): string { return $this->name; }

    public function set_name($name): void { $this->name = $name; }

    public function get_surname(): string { return $this->surname; }

    public function set_surname($surname): void { $this->surname = $surname; }

    public function get_phone(): string { return $this->phone; }

    public function set_phone($phone): void { $this->phone = $phone; }

    public function get_country(): string { return $this->country; }

    public function set_country($country): void { $this->country = $country; }
}