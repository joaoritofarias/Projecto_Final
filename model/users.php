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

        public function getUser($id) {

            $query = $this->db->prepare("
                SELECT user_id, name, bio, email, created_at, is_private
                FROM users
                WHERE user_id = ?
            ");

            $query->execute([ $id ]);

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

        public function getUserCreated($id) {

            $query = $this->db->prepare("
                SELECT 
                    group_id, 
                    group_name, 
                    game_name, 
                    created_at, 
                    store_id, 
                    s.name AS store_name
                FROM groups 
                INNER JOIN stores s USING (store_id)
                WHERE user_id = ?
            ");

            $query->execute([ $id ]);

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

        public function getUserGroups($id) {

            $query = $this->db->prepare("
                SELECT 
                    g.group_id, 
                    g.group_name, 
                    g.game_name, 
                    g.created_at, 
                    g.store_id, 
                    j.joined_at,
                    s.name AS store_name
                FROM groups g
                INNER JOIN joined_users j USING (group_id)
                INNER JOIN stores s USING (store_id)
                WHERE j.user_id = ?
            ");

            $query->execute([ $id ]);

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

        public function getUserCreatedStoreGroups($id, $store_id) {

            $query = $this->db->prepare("
                SELECT 
                    group_id, 
                    group_name, 
                    game_name, 
                    created_at, 
                    store_id
                FROM groups 
                WHERE user_id = ?
                  AND store_id = ?
            ");

            $query->execute([ 
                    $id,
                    $store_id 
                ]);

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

    }
?>