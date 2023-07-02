<?php

namespace src\Controller;

use Config\AbstractController;
use src\Model\Photo;

class HomeController extends AbstractController{

    public function index()
    {
        
        return $this->render("home/index.php",[]);
    }

    public function getPhotos(int $id)
    {
        $response = [
            "status" => 1,
            "data" => []
        ];

        $limit = 14;
        $model = $this->getModel(Photo::class);
        if($id === 0){
            $maxId = $model->getMaxId();
            
        } else {
            $maxId = $id;
        }
        $response["data"] = $model->getLimitedPhotos($limit, $maxId);

        $this->json($response);
    }

    public function maintenance()
    {
        return $this->render("home/maintenance.php",[]);
    }
}