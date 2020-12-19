<?php
    require_once("base.php");

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

        public function getJoinedUsers($id) {

            $query = $this->db->prepare("
                SELECT j.user_id, j.joined_at, u.name AS username
                FROM joined_users j
                INNER JOIN users u USING(user_id)
                WHERE group_id = ?
            ");

            $query->execute([ $id ]);

            return $query->fetchAll( PDO::FETCH_ASSOC );
        }

        public function deleteJoinedUser($id) {

            $query = $this->db->prepare("
                DELETE FROM joined_users
                WHERE user_id = ?
            ");

            return $query->execute([ $id ]);
  
        }

    }
?>