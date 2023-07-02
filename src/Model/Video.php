<?php

namespace src\Model;

use Config\AbstractModel;

class Video extends AbstractModel
{
    public function getMaxId(): ?int
    {
        $query = "SELECT MAX(id) as maxId FROM video";
        $result = $this->execRequete($query);

        return ($result->fetchAll())[0]["maxId"];
    }

    public function getLimitedVideos(int $limit, int $maxId)
    {
        $query = "select * from video where id <= :id order by id desc limit {$limit}";
        $result = $this->execRequete($query, [":id" => $maxId]);

        return $result->fetchAll();
    }   
}