<?php

namespace src\Controller\Admin;

use Config\AbstractController;
use vendor\framework\Request;
use src\Model\Photo;

class AdminPhotoController extends AbstractController{

    public function displayPhotos()
    {
        $this->render("admin/admin_photos.php");
    }

    public function getAllPhotos()
    {
        $response = [
            "status" => -1,
            "data" => null
        ];

        $request = new Request();
        if($request->isXmlHttpRequest()) {
            $response["status"] = 1;
            $response["data"] = $this->getModel(Photo::class)->findAll();
        }

        $this->json($response);
    }

    public function addPhoto()
    {
        $response = [
            "status" => -1,
            "data" => null
        ];

        $request = new Request();
        if($request->isXmlHttpRequest()) {
            $response["status"] = 1;
            $form = $request->content;
            $model = $this->getModel(Photo::class);
            $id = $model->insert([
                ":url" => $form["url"],
                ":user_id" => 1
            ]);
            $response["data"] = $model->findById($id);
        }

        $this->json($response);
    }

    public function deletePhoto($id) {
        $response = [
            "status" => -1,
            "data" => null
        ];

        $request = new Request();
        if($request->isXmlHttpRequest()) {
            $response["status"] = 1;
            $model = $this->getModel(Photo::class);
            $id = $model->delete($id);
        }

        $this->json($response);
    }
}