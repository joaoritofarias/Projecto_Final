<?php
    require("base.php");

    class Stores extends Base {

        public function create( $store ) {

            $store = $this->sanitize( $store );

            if(
                !empty($store["name"]) &&
                !empty($store["password"]) &&
                !empty($store["address"]) &&
                !empty($store["city"]) &&
                !empty($store["country"]) &&
                mb_strlen($store["name"]) > 2 &&
                mb_strlen($store["name"]) <= 64 &&
                mb_strlen($store["password"]) >= 8 &&
                mb_strlen($store["password"]) <= 1000 &&
                mb_strlen($store["address"]) <= 255 &&
                mb_strlen($store["city"]) <= 64 &&
                mb_strlen($store["country"]) <= 32 &&
                filter_var($store["email"], FILTER_VALIDATE_EMAIL) &&
                $store["password"] === $store["rep_password"]
            ) {

                $api_key = bin2hex( random_bytes(32) );

                $query = $this->db->prepare("
                    INSERT INTO stores
                    (name, email, password, address, city, country, api_key)
                    VALUES(?, ?, ?, ?, ?, ?, ?)
                ");

                return $query->execute([
                    $store["name"],
                    $store["email"],
                    password_hash($store["password"], PASSWORD_DEFAULT),
                    $store["address"],
                    $store["city"],
                    $store["country"],
                    $api_key
                ]);
            }

            return false;
        }

        public function login( $store ) {

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

        public function getStoreAndGroups($id) {

            $query = $this->db->prepare("
                SELECT s.name, s.address, s.city, s.country, g.group_id, g.group_name, g.game_name, g.created_at
                FROM stores s
                INNER JOIN groups g USING(store_id)
                WHERE s.store_id = ?
            ");

            $query->execute([ $id ]);

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

    }

?>