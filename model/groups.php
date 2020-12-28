<?php
    require_once("base.php");

    class Groups extends Base {

        public function createGroup( $group, $store, $user ) {

            $description = $this->sanitizeTextArea( $group["description"] );

            $group = $this->sanitize( $group );

            if(
                !empty($group["group_name"]) &&
                !empty($description) &&
                !empty($group["game_name"]) &&
                !empty($group["group_date"]) &&
                !empty($group["total_players"]) &&
                !empty($group["group_duration"]) &&
                mb_strlen($group["group_name"]) > 2 &&
                mb_strlen($group["group_name"]) <= 64 &&
                mb_strlen($description) > 10 &&
                mb_strlen($description) <= 65535 &&
                mb_strlen($group["game_name"]) > 2 &&
                mb_strlen($group["game_name"]) <= 64 &&
                mb_strlen($group["total_players"]) <= 2 &&
                mb_strlen($group["group_duration"]) <= 3 &&
                $group["group_date"] >= date("Y-m-d hh:mm:ss") &&
                filter_var($group["total_players"], FILTER_VALIDATE_INT) &&
                filter_var($group["group_duration"], FILTER_VALIDATE_INT)
            ) {

                $query = $this->db->prepare("
                    INSERT INTO groups
                    (group_name, description, game_name, group_date, total_players, group_duration, store_id, user_id)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?)
                ");

                return $query->execute([
                    $group["group_name"],
                    $description,
                    $group["game_name"],
                    $group["group_date"],
                    $group["total_players"],
                    $group["group_duration"],
                    $store,
                    $user
                ]);
            }

            return false;
        }

        public function editGroup( $newgroup, $group ) {

            $description = $this->sanitizeTextArea( $newgroup["description"] );

            $newgroup = $this->sanitize( $newgroup );

            if(
                !empty($newgroup["group_name"]) &&
                !empty($description) &&
                !empty($newgroup["game_name"]) &&
                !empty($newgroup["group_date"] ) &&
                !empty($newgroup["total_players"]) &&
                !empty($newgroup["group_duration"]) &&
                mb_strlen($newgroup["group_name"]) > 2 &&
                mb_strlen($newgroup["group_name"]) <= 64 &&
                mb_strlen($description) >= 10 &&
                mb_strlen($description) <= 65535 &&
                mb_strlen($newgroup["game_name"]) > 2 &&
                mb_strlen($newgroup["game_name"]) <= 64 &&
                mb_strlen($newgroup["total_players"]) <= 2 &&
                mb_strlen($newgroup["group_duration"]) <= 3 &&
                $newgroup["group_date"] >= date("Y-m-d hh:mm:ss") &&
                filter_var($newgroup["total_players"], FILTER_VALIDATE_INT) &&
                filter_var($newgroup["group_duration"], FILTER_VALIDATE_INT)
            ) {

                $query = $this->db->prepare("
                    UPDATE groups
                    SET group_name = ?,
                        description = ?,
                        game_name = ?,
                        group_date = ?,
                        total_players = ?,
                        group_duration = ?
                    WHERE group_id = ?
                ");

                return $query->execute([
                    $newgroup["group_name"],
                    $description,
                    $newgroup["game_name"],
                    $newgroup["group_date"],
                    $newgroup["total_players"],
                    $newgroup["group_duration"],
                    $group
                ]);
            }

            return false;
        }

        public function delete( $id ) {

            $query = $this->db->prepare("
                DELETE FROM groups
                WHERE group_id = ?
            ");
            
            return $query->execute([$id]);
        }

        public function getAllGroups() {

            $query = $this->db->prepare("
                SELECT g.group_id, 
                       g.group_name, 
                       g.game_name, 
                       g.created_at, 
                       u.name AS creator_name, 
                       u.user_id AS creator_id,
                       s.store_id,
                       s.name AS store_name
                FROM groups g
                LEFT JOIN users u USING(user_id)
                LEFT JOIN stores s USING(store_id)
                ORDER BY g.created_at DESC
            ");

            $query->execute();

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

        public function searchGroups($search) {

            if(
                mb_strlen($search) > 0 &&
                mb_strlen($search) <= 20
            ) {
                $query = $this->db->prepare("
                    SELECT g.group_id, 
                        g.group_name, 
                        g.game_name, 
                        g.created_at, 
                        u.name AS creator_name, 
                        u.user_id AS creator_id, 
                        s.city
                    FROM groups g
                    LEFT JOIN users u USING(user_id)
                    LEFT JOIN stores s USING(store_id)
                    WHERE g.group_name LIKE CONCAT('%',?,'%') OR 
                        g.game_name LIKE CONCAT('%',?,'%') OR 
                        s.city LIKE CONCAT('%',?,'%')
                    ORDER BY g.created_at DESC
                ");

                $query->execute([
                    $search,
                    $search,
                    $search
                ]);

                return $query->fetchAll( PDO::FETCH_ASSOC );
            }

            return false;

        }

        public function getGroup($id) {

            $query = $this->db->prepare("
                SELECT 
                    g.group_id, 
                    g.group_name, 
                    g.description, 
                    g.game_name, 
                    g.group_date, 
                    g.created_at, 
                    g.total_players, 
                    g.group_duration, 
                    u.name AS creator_name,
                    u.user_id AS creator_id, 
                    s.name AS store_name,
                    s.store_id
                FROM groups g
                LEFT JOIN users u USING(user_id)
                LEFT JOIN stores s USING(store_id)
                WHERE g.group_id = ?
            ");
    
            $query->execute([ $id ]);
    
            return $query->fetch( PDO::FETCH_ASSOC );
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

        public function getStoreGroups($id) {

            $query = $this->db->prepare("
                SELECT  
                    g.group_id, 
                    g.group_name, 
                    g.game_name, 
                    g.created_at,
                    u.user_id,
                    u.name AS creator_name
                FROM groups g
                INNER JOIN users u USING (user_id)
                WHERE store_id = ?
            ");

            $query->execute([ $id ]);

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

        public function getStoreCreatedGroups($id) {

            $query = $this->db->prepare("
                SELECT 
                    group_id, 
                    group_name, 
                    game_name, 
                    created_at
                FROM groups 
                WHERE user_id = 0 
                      AND store_id = ?
            ");

            $query->execute([ $id ]);

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }
    }
?>