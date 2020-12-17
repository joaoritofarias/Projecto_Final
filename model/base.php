<?php

    class Base {
        public $db;

        public function __construct() {
            $this->db = new PDO("mysql:host=localhost;dbname=playgroups;charset=utf8mb4", "root", "");
        }

        public function sanitize( $array ) {
            foreach($array as $key => $value) {
                $array[ $key ] = trim(strip_tags($value));
            }
            return $array;
        }

        public function validateDate($date, $format = 'Y-m-d H:i:s'){
            $d = DateTime::createFromFormat($format, $date);
            
            return $d && $d->format($format) == $date;
        }

    }

?>