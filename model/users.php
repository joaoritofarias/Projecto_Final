<?php
    require_once("base.php");

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

                $query = $this->db->prepare("
                    INSERT INTO users
                    (name, email, password)
                    VALUES(?, ?, ?)
                ");

                return $query->execute([
                    $user["name"],
                    $user["email"],
                    password_hash($user["password"], PASSWORD_DEFAULT)
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
                    SELECT user_id, password, is_admin
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

            if(
                !empty($id) &&
                filter_var($id, FILTER_VALIDATE_INT)
            ) {
                $query = $this->db->prepare("
                    SELECT user_id, name, bio, email, created_at, is_private, is_admin
                    FROM users
                    WHERE user_id = ?
                ");

                $query->execute([ $id ]);

                return $query->fetch( PDO::FETCH_ASSOC );
            }

            return false;
        }

        public function getUsers() {

            $query = $this->db->prepare("
                SELECT user_id, name, email, created_at, is_private
                FROM users
                WHERE is_admin = 0
                ORDER BY name ASC
            ");

            $query->execute();

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

        public function checkUserExists ($name,$email) {

            $query = $this->db->prepare("
                SELECT user_id
                FROM users
                WHERE name = ? OR email = ?
            ");

            $query->execute([ 
                $name,
                $email 
            ]);

            return $query->fetch( PDO::FETCH_ASSOC );
        }

        public function changePassword($id,$data){

            $data = $this->sanitize($data);
    
            if(
                mb_strlen($data["oldpassword"]) >= 8 &&
                mb_strlen($data["oldpassword"]) <= 1000 &&
                mb_strlen($data["newpassword"]) >= 8 &&
                mb_strlen($data["newpassword"]) <= 1000 &&
                $data["newpassword"] === $data["rep_newpassword"] &&
                $data["newpassword"] !== $data["oldpassword"]
            ) {
                $query = $this->db->prepare("
                    SELECT password
                    FROM users
                    WHERE user_id = ?
                ");
    
                $query->execute([ $id ]);
    
                $existingUser = $query->fetch( PDO::FETCH_ASSOC );
    
                if( !empty($existingUser) && password_verify($data["oldpassword"], $existingUser["password"]) ){

                    $query = $this->db->prepare("
                        UPDATE users
                        SET password = ? 
                        WHERE user_id = ?
                    ");
        
                    return $query->execute([ 
                        password_hash($data["newpassword"], PASSWORD_DEFAULT),
                        $id
                    ]);
                }
            }
    
            return false;
        }

        public function updatePrivacy($privacy, $id) {

            $query = $this->db->prepare("
                UPDATE users
                SET is_private = ? 
                WHERE user_id = ?
            ");

            return $query->execute([ 
                $privacy,
                $id
            ]);
        }

        public function updateProfile($newProfile, $id) {

            $bio = $this->sanitizeTextArea( $newProfile["bio"] );

            $newProfile = $this->sanitize( $newProfile );

            if(
                !empty($newProfile["name"]) &&
                !empty($bio) &&
                !empty($newProfile["email"]) &&
                !empty($id) &&
                filter_var($id, FILTER_VALIDATE_INT) &&
                mb_strlen($newProfile["name"]) > 2 &&
                mb_strlen($newProfile["name"]) <= 64 &&
                mb_strlen($bio) <= 65535 &&
                filter_var($newProfile["email"], FILTER_VALIDATE_EMAIL)
            ) {

                $query = $this->db->prepare("
                    UPDATE users
                    SET name = ?,
                        email = ?,
                        bio = ?
                    WHERE user_id = ?
                ");

                return $query->execute([ 
                    $newProfile["name"],
                    $newProfile["email"],
                    $bio,
                    $id
                ]);
            }

            return false;
        }

        public function delete( $id ) {

            $id = $this->sanitize( $id );

            if(
                !empty($id) &&
                filter_var($id, FILTER_VALIDATE_INT)
            ) {

                $query = $this->db->prepare("
                    DELETE FROM joined_users
                    WHERE user_id = ?
                ");
                
                $query->execute([$id]);

                $query = $this->db->prepare("
                    DELETE FROM joined_users
                    WHERE group_id IN (
                        SELECT group_id
                        FROM groups
                        WHERE user_id = ?
                    )
                "); 
                
                $query->execute([$id]);

                $query = $this->db->prepare("
                    DELETE FROM groups
                    WHERE user_id = ?
                "); 
                
                $query->execute([$id]);

                $query = $this->db->prepare("
                    DELETE FROM users
                    WHERE user_id = ?
                "); 
                
                return $query->execute([$id]);
            }

            return false;
        }

    }
?>