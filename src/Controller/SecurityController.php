<?php

namespace src\Controller;

use Config\AbstractController;
use src\Model\User;
use vendor\framework\PasswordAuthenticatedUser;
use vendor\framework\Request;
use vendor\JWT\JWT;
use src\Service\JWTService;

class SecurityController extends AbstractController
{
    public function login()
    {
        return $this->render("security/login.php");
    }

    public function traitLogin()
    {
        $response = [
            "status" => 0,
            "data" => null,
            "message" => ""
        ];

        $request = new Request();
        if($request->isXmlHttpRequest()){
            $form = $request->content;
            $user = new User();
            $found = $user->findByEmail($form["email"]);
            if(count($found) > 0){
                $hash = $found[0]["password"];
                $pau = new PasswordAuthenticatedUser($_ENV['jwt_key']);
                if($pau->verify($form["password"], $hash)){
                    $jwt = new JWT($_ENV['jwt_key']);
                    $token = $jwt->createToken([
                        "email" => $form["email"],
                        "date" => (new \DateTime())->format("Y-m-d H:i:s")
                    ]);
                    $response["data"] = ['token' => $token, "route" => "/"];
                    $response["status"] = 1;
                }
            }
        }

        $this->json($response);
    }

    public function getProfilesAfterLogin()
    {
        $response = [
            "status" => 0,
            "data" => null,
        ];

        $request = new Request();
        if($request->isXmlHttpRequest()) {
            $model = $this->getModel(User::class);
            $auth = $request->getAuthorization();
            $jwtService = new JWTService();
            $token = $jwtService->extractToken($auth);
            $user = $jwtService->getUserByToken($token);
            if($user !== null){
                $response = [
                    "status" => 1,
                    "data" => [
                        "email" => $user["email"],
                        "firstname" => $user["firstname"],
                        "roles" => $user["roles"],
                        "photo" => $user["photo"],
                    ],
                ];
            }
        }

        $this->json($response);
    }

    public function logup()
    {
        return $this->render("security/logup.php");
    }

    public function traitLogup()
    {
        $response = [
            "status" => 0,
            "data" => null
        ];

        $request = new Request();
        if ($request->isXmlHttpRequest()) {
            $form = $request->content;
            $model = $this->getModel(User::class);
            $found = $model->findByEmail($form["email"]);
            if (count($found) === 0) {
                $response["status"] = 1;
                $pau = new PasswordAuthenticatedUser($_ENV['jwt_key']);
                $model->insert([
                    ":email" => $form["email"],
                    ":password" => $pau->hash($form["password"]),
                    ":lastname" => $form["lastname"],
                    ":firstname" => $form["firstname"],
                    ":roles" => json_encode(["role_user"])
                ]);
            } else {
                $response["status"] = 2;
            } 
        }

        $this->json($response);
    }
}