<?php
    require("base.php");

    class Groups extends Base
    {
        public function getGroups() {

            $query = $this->db->prepare("
                SELECT g.group_id, g.group_name, g.game_name, g.created_at, u.name AS creator_name
                FROM groups g
                INNER JOIN users u ON(g.user_id = u.user_id)
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
                    g.group_date_time, 
                    g.created_at, 
                    g.total_players, 
                    g.players_needed, 
                    u.name AS creator_name,
                    u.user_id AS creator_id, 
                    s.name AS store_name,
                    s.store_id
                FROM groups g
                INNER JOIN users u ON(g.user_id = u.user_id)
                INNER JOIN stores s ON(g.store_id = s.store_id)
                WHERE group_id = ?
            ");
    
            $query->execute([ $id ]);
    
            return $query->fetch( PDO::FETCH_ASSOC );
        }

    }
?>