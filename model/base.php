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

        public function sanitizeTextArea( $array ) {
            foreach($array as $key => $value) {
                $array[ $key ] = trim( strip_tags($value["<pre><p><br><hr><hgroup><h1><h2><h3><h4><h5><h6><ul>
                                                          <ol><li><dl><dt><dd><strong><em><b><i><u><img><a><abbr>
                                                          <address><blockquote><area><audio><video><form><fieldset>
                                                          <label><caption><table><tbody><td><tfoot><th><thead><tr>
                                                          <iframe>]"]) 
                                    );
            }
            return $array;
        }
    }

?>