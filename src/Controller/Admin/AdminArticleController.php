<?php

namespace src\Controller\Admin;

use Config\AbstractController;
use vendor\framework\Request;
use src\Model\Article;

class AdminArticleController extends AbstractController{
    public function displayArticles()
    {
        $this->render("admin/admin_articles.php");
    }
}
