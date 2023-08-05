<?php

namespace src\Controller\Admin;

use Config\AbstractController;
use vendor\framework\Request;
use src\Model\Video;
use src\Service\UtilService;

class AdminVideoController extends AbstractController{

    public function displayVideos()
    {
        $this->render("admin/admin_videos.php");
    }

    public function getAllVideos()
    {
        $response = [
            "status" => -1,
            "data" => null
        ];

        $request = new Request();
        if($request->isXmlHttpRequest()) {
            $response["status"] = 1;
            $allVideos = $this->getModel(Video::class)->findAll();
            $response["data"] = UtilService::purifyFetchAll($allVideos);
        }

        $this->json($response);
    }

    public function addVideo()
    {
        $response = [
            "status" => -1,
            "data" => null
        ];

        $request = new Request();
        if($request->isXmlHttpRequest()) {
            $response["status"] = 1;
            $form = $request->content;
            $model = $this->getModel(Video::class);
            $id = $model->insert([
                ":url" => $form["url"],
                ":user_id" => 1,
                ":thumbnail" => $form["thumbnail"],
                ":type" => $form["type"],
                ":title" => $form["title"]
            ]);
            $response["data"] = UtilService::purifyOneFetchAll($model->findById($id));
        }

        $this->json($response);
    }

    public function updateVideo(int $id)
    {
        $response = [
            "status" => -1,
            "data" => null
        ];

        $request = new Request();
        if($request->isXmlHttpRequest()) {
            $response["status"] = 1;
            $form = $request->content;
            $model = $this->getModel(Video::class);
            $model->update(
                $id,
                [
                    ":url" => $form["url"],
                    ":thumbnail" => $form["thumbnail"],
                    ":type" => $form["type"],
                    ":title" => $form["title"]
                ]
            );
            $response["data"] = UtilService::purifyOneFetchAll($model->findById($id));
        }

        $this->json($response);
    }

    public function deleteVideo($id) {
        $response = [
            "status" => -1,
            "data" => null
        ];
        
        $request = new Request();
        if($request->isXmlHttpRequest()) {
            $response["status"] = 1;
            $model = $this->getModel(Video::class);
            $id = $model->delete($id);
        }
       
        $this->json($response);
    }
}