<?php
namespace Config;

use Config\Router;
use Config\Database\ConnectMysql;
use PDO;
use vendor\framework\Request;
use vendor\framework\CrossOrigin;

class Kernel{

    public function run(): void
    {
        $cross = new CrossOrigin();
        $cross->checkOrigin();

        $this->setEnv();

        $router = new Router();
        $router->setRoutes();
        $router->getRouter();
    }

    public function getPDO(): ?PDO
    {
        return ConnectMysql::getPDO();
    }

    private function setEnv(): void
    {
        $envs = ["env.local.php", "env.php"];
        foreach ($envs as $env) {
            if (file_exists(dirname(__DIR__, 1) . "/{$env}")) {
                $tab = include_once dirname(__DIR__, 1)."/{$env}";
                foreach($tab as $key => $value){
                    $_ENV[$key] = $value;
                }
                break;
            }
        }
    }
}