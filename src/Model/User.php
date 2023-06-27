<?php

namespace src\Model;

use Config\AbstractModel;

class User extends AbstractModel
{

    public function findByEmail(string $email): array
    {
        $req = "select * from user where email = :email";
        $result = $this->execRequete($req, [":email" => $email]);
        
        return $result->fetchAll();
    }

    public function adjustUser(array $user):array 
    {
        unset($user["password"]);
        $user["roles"] = json_decode($user["roles"], true);

        return $user;
    }

    public function adjustUsers(array $users):array 
    {
        foreach($users as $key => $user){
            $users[$key] = $this->adjustUser($user);
        }

        return $users;
    }
}