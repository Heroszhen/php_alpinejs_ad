<?php

namespace Config;

use src\Model;

abstract class AbstractController
{
    protected function render($file, $args = [])
    {
        //foreach($args as $key=>$value)${$key} = $value;
        extract($args);
        require_once dirname(__DIR__)."/View/".$file;
    }

    protected function toRedirect($url)
    {
        header("Location: /{$url}");
    }

    protected function json(array $response)
    {
        echo json_encode($response);
        exit;
    }

    protected function getModel($class)
    {
        $model = new $class;

        return $model;
    }
}