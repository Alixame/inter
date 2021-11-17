<?php 

namespace Vendor\DB;

class Sql {

	const HOSTNAME = "127.0.0.1";
	const USERNAME = "root";
	const PASSWORD = "";
	const DBNAME = "db_automacao";

	//const HOSTNAME = "engenhariamjs.com";
	//const USERNAME = "enge2484_miqueias";
	//const PASSWORD = "91100840mM";
	//const DBNAME = "enge2484_db_automacao";

	private $conn;

	/**
	 * METODO CONSTRUTOR (CHAMADO AO INSTANCIAR OBJETO)
	 */
	public function __construct(){

		$this->conn = new \PDO(
			"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME, 
			Sql::USERNAME,
			Sql::PASSWORD
		);

	}

	/**
	 * METODO RESPONSAVEL POR DEFINIR PARAMETROS PELO BindParam
	 *
	 * @param $statement
	 * @param array $parameters
	 * @return void
	 */
	private function setParams($statement, $parameters = array()){

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}

	/**
	 * METODO RESPONSAVEL POR RECEBER VALOR PELO BindParam
	 *
	 * @param $statement
	 * @param $key
	 * @param $value
	 * @return void
	 */
	private function bindParam($statement, $key, $value){

		$statement->bindParam($key, $value);

	}

	/**
	 * METODO REPSONSAVEL POR EXECUTAR UMA QUERY NO BANCO (QUERY - PARAMETROS)
	 *
	 * @param $rawQuery
	 * @param array $params
	 * @return void
	 */
	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

	}

	/**
	 * METODO RESPONSAVEL POR EXECUTAR UM SELECT NO BANCO (QUERY - PARAMETROS)
	 *
	 * @param $rawQuery
	 * @param array $params
	 * @return array
	 */
	public function select($rawQuery, $params = array()):array{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

}

 ?>
