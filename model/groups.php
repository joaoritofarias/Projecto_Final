<?php
    require("base.php");

    class Groups extends Base {

        public function createGroup( $group, $store, $user ) {

            $date = $this->validateDate( $group["group_date"] );

            if(
                !empty($group["group_name"]) &&
                !empty($group["description"]) &&
                !empty($group["game_name"]) &&
                !empty($group["group_date"]) &&
                !empty($group["total_players"]) &&
                !empty($group["group_duration"]) &&
                mb_strlen($group["group_name"]) > 2 &&
                mb_strlen($group["group_name"]) <= 64 &&
                mb_strlen($group["description"]) > 10 &&
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
                    $group["description"],
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

        public function getGroups() {

            $query = $this->db->prepare("
                SELECT g.group_id, g.group_name, g.game_name, g.created_at, u.name AS creator_name, u.user_id AS creator_id
                FROM groups g
                LEFT JOIN users u USING(user_id)
                ORDER BY g.created_at DESC LIMIT 10;
            ");

            $query->execute();

            return $query->fetchAll( PDO::FETCH_ASSOC );
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
    }
?>