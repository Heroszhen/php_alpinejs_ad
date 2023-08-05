<?php

namespace src\Controller;

use Config\AbstractController;
use src\Model\Photo;
use src\Model\Video;
use src\Service\UtilService;
use src\Model\User;

class HomeController extends AbstractController
{
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

    public function videosPage()
    {
        return $this->render("home/videos.php",[]);
    }

    public function getVideos(int $id)
    {
        $response = [
            "status" => 1,
            "data" => []
        ];

        $limit = 9;
        $model = $this->getModel(Video::class);
        if($id === 0){
            $maxId = $model->getMaxId();
            
        } else {
            $maxId = $id;
        }
        $response["data"] = UtilService::purifyFetchAll($model->getLimitedVideos($limit, $maxId));

        $this->json($response);
    }
}