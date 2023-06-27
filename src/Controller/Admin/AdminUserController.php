<?php

namespace src\Controller\Admin;

use Config\AbstractController;
use src\Model\User;
use vendor\framework\Request;
use vendor\framework\PasswordAuthenticatedUser;

class AdminUserController extends AbstractController{

    public function index()
    {
        $this->render("admin/admin_users.php");
    }

    public function getAllUsers()
    {
        $response = [
            "status" => 1,
            "data" => []
        ];
        
        $model = $this->getModel(User::class);
        $allUsers = $model->findAll();
        $response["data"] = $model->adjustUsers($allUsers);

        $this->json($response);
    }

    public function editUser()
    {
        $response = [
            "status" => 1,
            "data" => null
        ];

        $request = new Request();
        $form = $request->content; 
        $params = [
            ":email" => $form["email"],
            ":firstname" => $form["firstname"],
            ":lastname" => $form["lastname"],
            ":photo" => $form["photo"],
            ":roles" => json_encode($form["roles"])
        ];
        $model = $this->getModel(User::class);
        $foundUsers = $model->findByEmail($form["email"]);
        if($form["id"] === null){
            if(count($foundUsers) > 0){
                $response = [
                    "status" => 2,
                    "data" => null,
                    "message" => "Il existe un utilisateur avec ce mail"
                ];
                $this->json($response);

                return;
            }

            $pau = new PasswordAuthenticatedUser($_ENV["jwt_key"]);
            $params[":password"] = $pau->hash("aaaaaaaa");
            $id = $model->insert($params);
        } else {
            if(count($foundUsers) > 0 && $foundUsers[0]["id"] !== $form["id"]){
                $response = [
                    "status" => 2,
                    "data" => null,
                    "message" => "Il existe un utilisateur avec ce mail"
                ];
                $this->json($response);

                return;
            }
            $id = $form["id"];
            $model->update($id, $params);
        }
        $user = $model->findById($id);
        $response["data"] = $model->adjustUser($user);

        $this->json($response);
    }

    public function deleteUser(int $id)
    {
        $response = [
            "status" => 1,
            "data" => null
        ];
        
        $this->getModel(User::class)->delete($id);

        $this->json($response);
    }

}