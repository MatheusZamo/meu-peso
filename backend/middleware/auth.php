<?php 
    function auth() {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            die(json_encode(["error" => "Sem auth"]));
        }

        return intval($headers['Authorization']);
    }
?>