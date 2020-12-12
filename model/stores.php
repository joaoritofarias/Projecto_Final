<?php
    require("base.php");

    class Stores extends Base {
        
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