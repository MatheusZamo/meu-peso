<?php 
    require_once __DIR__ . '/../config/database.php';

    function register($data) {
        global $conn;

        $name = $data['name'];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql)) {
            echo json_encode(["message" => "Criado"]);
        } else {
            echo json_encode(["error" => "Erro"]);
        }
    }

    function login($data) {
        global $conn;

        $email = $data['email'];
        $password = $data['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email= ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            echo json_encode(["id" => $user['id']]);
        } else {
            http_response_code(401);
            echo json_encode(["error" => "Inválido"]);
        }
    }
?>