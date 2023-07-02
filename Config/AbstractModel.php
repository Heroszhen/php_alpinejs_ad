<?php
namespace Config;

use Config\Kernel;

abstract class AbstractModel{
    
    protected $pdo;

    public function __construct() {
        $this->pdo = (new Kernel)->getPDO();
    }

    protected function execRequete($req, $params = [])
	{
		// Sanitize
		if (!empty($params)){
			foreach($params as $key => $value){
				$params[$key] = trim($value);
			}
		}
		
		//global $pdo; // globalisation de $pdo
		$r = $this->pdo->prepare($req);
		$r->execute($params);
		if(!empty($r->errorInfo()[2])){
			die('Erreur rencontrée lors de la requête : '.$r->errorInfo()[2]);
		}

		return $r;
	}

	public function findAll(): array
	{
		$classname = $this->getClassname();
		$query = "select * from {$classname}";
		$result = $this->execRequete($query);

		return $result->fetchAll();
	}

	public function findById(int $id): ?array
	{
		$classname = $this->getClassname();
		$request = $this->execRequete(
			"select * from {$classname} where id = :id",
			[":id" => $id]
		);

		return ($request->fetchAll())[0];
	}

	public function insert(array $params): int
	{
		$tabKeys = array_keys($params);
		$strKeys2 = implode(',', $tabKeys);
		foreach($tabKeys as $key => $value){
			$tabKeys[$key] = str_replace(":", "", $tabKeys[$key]);
		}
		$strKeys = implode(',', $tabKeys);
		$classname = $this->getClassname();
		$query = "insert into {$classname} ({$strKeys}) values ({$strKeys2})";
		$this->execRequete($query, $params);

		return $this->pdo->lastInsertId();
	}

	public function update(int $id, array $params)
	{
		$classname = $this->getClassname();
		$query = "update {$classname} set ";

		$index = 0;
		foreach($params as $key => $value){
			$newKey = str_replace(":", "", $key);
			$query .= "{$newKey} = {$key}";
			if($index < count($params) - 1){
				$query .= ",";
			}
			$index++;
		}
		$query .= " where id = :id";
		$params[":id"] = $id;
		$this->execRequete($query, $params);
	}

	public function delete(int $id)
	{
		$classname = $this->getClassname();
		$query = "DELETE FROM {$classname} where id = :id";
		$this->execRequete($query, [":id" => $id]);
	}

	private function getClassname():string 
	{
		$namespace = get_class($this);
		$tab = explode("\\", $namespace);

		return strtolower(end($tab));
	}
}