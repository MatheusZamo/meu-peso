<?php 
    require_once __DIR__ . '/../config/database.php';

    function addWeight($data, $user_id) {
        global $conn;

        $weight = $data['weight'];
        $date = $data['date'];

        $conn->query("INSERT INTO weights (user_id, weight, date) VALUES ($user_id, $weight, '$date')");

        echo json_encode(["ok" => true]);
    }

    function getWeights($user_id) {
        global $conn;

        $res = $conn->query("SELECT * FROM weights WHERE user_id=$user_id ORDER BY date ASC");

        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
    }
?>