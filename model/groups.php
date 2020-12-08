<?php
    require("base.php");

    class Groups extends Base
    {
        public function get() {

            $query = $this->db->prepare("
                SELECT group_id, group_name, game_name, created_at, u.name AS creator_name
                FROM groups g
                INNER JOIN users u ON(g.user_id = u.user_id)
            ");

            $query->execute();

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

    }
?>