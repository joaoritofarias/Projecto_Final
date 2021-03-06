<?php
    require_once("base.php");

    class Stores extends Base {

        public function create($store) {

            $store = $this->sanitize($store);

            if(
                !empty($store["name"]) &&
                !empty($store["password"]) &&
                !empty($store["address"]) &&
                !empty($store["city"]) &&
                mb_strlen($store["name"]) > 2 &&
                mb_strlen($store["name"]) <= 64 &&
                mb_strlen($store["password"]) >= 8 &&
                mb_strlen($store["password"]) <= 1000 &&
                mb_strlen($store["address"]) <= 255 &&
                mb_strlen($store["city"]) <= 64 &&
                filter_var($store["email"], FILTER_VALIDATE_EMAIL) &&
                $store["password"] === $store["rep_password"]
            ) {


                $query = $this->db->prepare("
                    INSERT INTO stores
                    (name, email, password, address, city)
                    VALUES(?, ?, ?, ?, ?)
                ");

                return $query->execute([
                    $store["name"],
                    $store["email"],
                    password_hash($store["password"], PASSWORD_DEFAULT),
                    $store["address"],
                    $store["city"],
                ]);
            }

            return false;
        }

        public function login($store) {

            $store = $this->sanitize($store);
    
            if(
                filter_var($store["email"], FILTER_VALIDATE_EMAIL) &&
                mb_strlen($store["password"]) >= 8 &&
                mb_strlen($store["password"]) <= 1000
            ) {
                $query = $this->db->prepare("
                    SELECT store_id, password
                    FROM stores
                    WHERE email = ?
                ");
    
                $query->execute([ $store["email"] ]);
    
                $existingStore = $query->fetch( PDO::FETCH_ASSOC );
    
                if( !empty($existingStore) && password_verify($store["password"], $existingStore["password"]) ){
                    return $existingStore;
                }
            }
    
            return false;
        }

        public function getStore($id) {

            if(
                !empty($id) &&
                filter_var($id, FILTER_VALIDATE_INT)
            ) {
                $query = $this->db->prepare("
                    SELECT store_id, name, email, address, city
                    FROM stores
                    WHERE store_id = ?
                ");

                $query->execute([ $id ]);

                return $query->fetch( PDO::FETCH_ASSOC );
            }

            return false;
        }

        public function getStores() {

            $query = $this->db->prepare("
                SELECT store_id, name, email, address, city
                FROM stores
                ORDER BY name ASC
            ");

            $query->execute();

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

        public function checkStoreExists ($name, $email, $address) {

            $query = $this->db->prepare("
                SELECT store_id
                FROM stores
                WHERE name = ? OR email = ? OR address = ?
            ");

            $query->execute([ 
                $name,
                $email, 
                $address 
            ]);

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }
        
        public function getStoreCities() {

            $query = $this->db->prepare("
                SELECT city 
                FROM stores
                GROUP BY city
                ORDER BY city DESC
            ");

            $query->execute();

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

        public function getStoresFromCity($city) {

            $query = $this->db->prepare("
                SELECT store_id, name 
                FROM stores
                WHERE city LIKE CONCAT('%',?,'%')
                ORDER BY city DESC
            ");

            $query->execute([ $city ]);

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

        public function updateProfile($newProfile, $id) {

            $newProfile = $this->sanitize( $newProfile );

            if(
                !empty($newProfile["name"]) &&
                !empty($newProfile["address"]) &&
                !empty($newProfile["city"]) &&
                !empty($id) &&
                filter_var($id, FILTER_VALIDATE_INT) &&
                mb_strlen($newProfile["name"]) > 2 &&
                mb_strlen($newProfile["name"]) <= 64 &&
                mb_strlen($newProfile["address"]) <= 255 &&
                mb_strlen($newProfile["city"]) <= 64 &&
                filter_var($newProfile["email"], FILTER_VALIDATE_EMAIL)
            ) {

                $query = $this->db->prepare("
                    UPDATE stores
                    SET name = ?,
                        email = ?,
                        address = ?,
                        city = ?
                    WHERE store_id = ?
                ");

                return $query->execute([ 
                    $newProfile["name"],
                    $newProfile["email"],
                    $newProfile["address"],
                    $newProfile["city"],
                    $id
                ]);
            }


        }

        public function changePassword($id,$data){

            $data = $this->sanitize($data);
    
            if(
                mb_strlen($data["oldpassword"]) >= 8 &&
                mb_strlen($data["oldpassword"]) <= 1000 &&
                mb_strlen($data["newpassword"]) >= 8 &&
                mb_strlen($data["newpassword"]) <= 1000 &&
                $data["newpassword"] === $data["rep_newpassword"]
            ) {
                $query = $this->db->prepare("
                    SELECT password
                    FROM stores
                    WHERE store_id = ?
                ");
    
                $query->execute([ $id ]);
    
                $existingStore = $query->fetch( PDO::FETCH_ASSOC );
    
                if( !empty($existingStore) && password_verify($data["oldpassword"], $existingStore["password"]) ){

                    $query = $this->db->prepare("
                        UPDATE stores
                        SET password = ? 
                        WHERE store_id = ?
                    ");
        
                    return $query->execute([ 
                        password_hash($data["newpassword"], PASSWORD_DEFAULT),
                        $id
                    ]);
                }
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
                    WHERE store_id = ?
                ");
                
                $query->execute([$id]);

                $query = $this->db->prepare("
                    DELETE FROM joined_users
                    WHERE group_id IN (
                        SELECT group_id
                        FROM groups
                        WHERE store_id = ? 
                            AND user_id = 0
                    )
                "); 
                
                $query->execute([$id]);

                $query = $this->db->prepare("
                    DELETE FROM groups
                    WHERE store_id = ?
                "); 
                
                $query->execute([$id]);

                $query = $this->db->prepare("
                    DELETE FROM stores
                    WHERE store_id = ?
                ");

                return $query->execute([$id]);
            }

            return false;
        }

    }

?>