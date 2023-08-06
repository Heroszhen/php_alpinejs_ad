<?php

namespace src\Controller;

use Config\AbstractController;
use src\Service\UtilService;
use src\Model\User;
use vendor\framework\Request;
use vendor\JWT\JWT;
use src\Service\JWTService;

class UserController extends AbstractController
{
    public function displayProfil()
    {
        return $this->render("user/index.php");
    }

    public function getUser()
    {
        $response = [
            "status" => 0,
            "data" => null,
        ];

        $request = new Request();
        if ($request->isXmlHttpRequest()) {
            $auth = $request->getAuthorization();
            $jwtService = new JWTService();
            $token = $jwtService->extractToken($auth);
            $user = $jwtService->getUserByToken($token);
            if ($user !== null) {
                unset($user["password"], $user["roles"]);
                $response = [
                    "status" => 1,
                    "data" =>  UtilService::purifyOneFetchAll($user),
                ];
            }
        }

        $this->json($response);
    }

    public function editUser()
    {
        $response = [
            "status" => 0,
            "data" => null,
        ];

        $request = new Request();
        if ($request->isXmlHttpRequest()) {
            $auth = $request->getAuthorization();
            $jwtService = new JWTService();
            $token = $jwtService->extractToken($auth);
            $user = $jwtService->getUserByToken($token);
            if ($user !== null) {
                $response["status"] = 1;
                $model = $this->getModel(User::class);
                $form = $request->content;
                $found = $model->findByEmail($form["email"]);
                if (count($found) > 0 && $found[0]["id"] !== $user["id"]) {
                    $response["status"] = 2;
                } else {
                    $model->update($user['id'], [
                        ":lastname" => $form["lastname"],
                        ":firstname" => $form["firstname"],
                        ":email" => $form["email"],
                        ":photo" => $form["photo"]
                    ]);
                }  
            }
        }

        $this->json($response);
    }

    /**
     * check token for site : jolies-filles.yangzhen.tech
     */
    public function checkToken_mk(): void
    {
        $response = [
            "status" => 0,
            "data" => null,
        ];

        $request = new Request();
        if ($request->isXmlHttpRequest()) {
            $auth = $request->getAuthorization();
            $jwtService = new JWTService();
            $token = $jwtService->extractToken($auth);
            $user = $jwtService->getUserByToken($token);
            if (null !== $user) {
                $response["status"] = 1;
            }
        }

        $this->json($response);
    }
}
