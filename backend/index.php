<?php 
  header("Content-Type: application/json");
  //Permitindo requisições do front 
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: Content-Type, Authorization");

  require_once "controllers/AuthController.php";
  require_once "controllers/WeightController.php";
  require_once "middleware/auth.php";

  //Pegando Rota
  $uri = $_SERVER['REQUEST_URI'];
  $method = $_SERVER['REQUEST_METHOD'];

  //Pegando Body
  $data = json_decode(file_get_contents("php://input"), true);
  
  //Rotas
  if (strpos($uri, "/login") !== false) {
    login($data);
  }

  if (strpos($uri, "/register") !== false) {
    register($data);
  }

  if (strpos($uri, "/weights") !== false) {
    $user_id = auth();

    if ($method == "POST") {
        addWeight($data, $user_id);
    } else {
        getWeights($user_id);
    }
  }
  
  ?>