<?php

namespace src\Model;

use Config\AbstractModel;

class Photo extends AbstractModel
{

    public function getMaxId(): ?int
    {
        $query = "SELECT MAX(id) as maxId FROM photo";
        $result = $this->execRequete($query);

        return ($result->fetchAll())[0]["maxId"];
    }

    public function getLimitedPhotos(int $limit, int $maxId)
    {
        $query = "select * from photo where id <= :id order by id desc limit {$limit}";
        $result = $this->execRequete($query, [":id" => $maxId]);

        return $result->fetchAll();
    }
    
}