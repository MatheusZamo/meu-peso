<?php 
    require_once __DIR__ . '/../config/database.php';

    function register($data) {
        global $conn;

        $name = $data['name'];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Criado"]);
        } else {
            echo json_encode(["error" => "Erro ao cadastrar"]);
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
            echo json_encode([
                "id" => $user['id'],
                "name" => $user['name'],
                "email" => $user['email']
            ]);
        } else {
            http_response_code(401);
            echo json_encode(["error" => "Inválido"]);
        }
    }
?>