<?php
    require("base.php");

    class Users extends Base {

        public function create( $user ) {

            $user = $this->sanitize( $user );

            if(
                !empty($user["name"]) &&
                !empty($user["password"]) &&
                mb_strlen($user["name"]) > 2 &&
                mb_strlen($user["name"]) <= 64 &&
                mb_strlen($user["password"]) >= 8 &&
                mb_strlen($user["password"]) <= 1000 &&
                filter_var($user["email"], FILTER_VALIDATE_EMAIL) &&
                $user["password"] === $user["rep_password"]
            ) {

                $api_key = bin2hex( random_bytes(32) );

                $query = $this->db->prepare("
                    INSERT INTO users
                    (name, email, password, api_key)
                    VALUES(?, ?, ?, ?)
                ");

                return $query->execute([
                    $user["name"],
                    $user["email"],
                    password_hash($user["password"], PASSWORD_DEFAULT),
                    $api_key
                ]);
            }

            return false;
        }

        public function login( $user ) {

            $user = $this->sanitize($user);
    
            if(
                filter_var($user["email"], FILTER_VALIDATE_EMAIL) &&
                mb_strlen($user["password"]) >= 8 &&
                mb_strlen($user["password"]) <= 1000
            ) {
                $query = $this->db->prepare("
                    SELECT user_id, password
                    FROM users
                    WHERE email = ?
                ");
    
                $query->execute([ $user["email"] ]);
    
                $existingUser = $query->fetch( PDO::FETCH_ASSOC );
    
                if( !empty($existingUser) && password_verify($user["password"], $existingUser["password"]) ){
                    return $existingUser;
                }
            }
    
            return false;
        }

        public function getUserAndGroups($id) {

            $query = $this->db->prepare("
                SELECT u.name, u.email, u.city, u.country, g.group_id, g.group_name, g.game_name, g.created_at
                FROM users u
                INNER JOIN groups g USING (user_id)
                WHERE u.user_id = ?
            ");

            $query->execute([ $id ]);

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

    }
?>