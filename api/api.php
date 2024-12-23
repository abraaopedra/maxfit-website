<?php
    header("Content-Type: application/json");

    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $requestUri = explode('/', trim($_SERVER['REQUEST_URI'], "/")); 
    $resource = isset($requestUri[1]) ? $requestUri[1] : null;
    $resourceSpecific = isset($requestUri[2]) ? $requestUri[2] : null;

    if($requestUri[0] == "api"){ // aqui e o ponto de entrada, muda para o que quiseres ou retira este if se nao quiseres a primeira rota ser /api
        // a template dos endpoints e /api/$resource/$resourceSpecific (/api/users/create f.e.)
        switch($resource){
            case "users":
                switch($resourceSpecific){
                    case "create":
                        if($requestMethod == "POST"){ // verifica sempre o metodo por seguranca

                            // codigo especifico do business layer para criar um user
                        }
                        break;
                    default:
                        http_response_code(404);
                        echo json_encode(["status" => "error", "message" => "Endpoint not found"]);
                }
                break;
            default:
                http_response_code(404);
                echo json_encode(["status" => "error", "message" => "Endpoint not found"]);
        }
    }else{
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Endpoint not found"]);
    }
?>