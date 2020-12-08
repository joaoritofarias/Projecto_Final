<?php
require("base.php");

class Users extends Base
{
    public function create( $user ) {

        $user = $this->sanitize( $user );

        if(
            !empty($user["name"]) &&
            !empty($user["password"]) &&
            !empty($user["city"]) &&
            !empty($user["country"]) &&
            mb_strlen($user["name"]) > 2 &&
            mb_strlen($user["name"]) <= 64 &&
            mb_strlen($user["password"]) >= 8 &&
            mb_strlen($user["password"]) <= 1000 &&
            mb_strlen($user["city"]) <= 64 &&
            mb_strlen($user["country"]) <= 32 &&
            filter_var($user["email"], FILTER_VALIDATE_EMAIL) &&
            $user["password"] === $user["rep_password"]
        ) {

            $query = $this->db->prepare("
                INSERT INTO users
                (name, email, password, city, country)
                VALUES(?, ?, ?, ?, ?)
            ");

            return $query->execute([
                $user["name"],
                $user["email"],
                password_hash($user["password"], PASSWORD_DEFAULT),
                $user["city"],
                $user["country"]
            ]);
        }

        return false;
    }

}