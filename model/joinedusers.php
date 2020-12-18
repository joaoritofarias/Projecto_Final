<?php
    require("base.php");

    class Joinedusers extends Base {

        public function joinUser( $joinedUser, $user ) {

            if(
                !empty($joinedUser["group"]) &&
                mb_strlen($joinedUser["group"]) <= 10 &&
                filter_var($joinedUser["group"], FILTER_VALIDATE_INT)

            ) {

                $joined_at = date('Y-m-d H:i:s'); ;

                $query = $this->db->prepare("
                    INSERT INTO joined_users
                    (user_id, group_id, joined_at)
                    VALUES(?, ?, ?)
                ");

                return $query->execute([
                    $user,
                    $joinedUser["group"],
                    $joined_at
                ]);
            }

            return false;
        }






    }



?>