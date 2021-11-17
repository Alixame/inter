<?php
/**
 *  DEFININDO NAMESPACE
 */
namespace Vendor\Model;

/**
 * CARRENDANDO CLASSES UTILIZANDO OS NAMESPACE
 */
use Vendor\DB\Sql;
use Vendor\Model;

// DEFINANDO CLASE room QUE HERDA METODOS E FUNÇÕES DA CLASSE MODEL
class Room extends Model {

    /**
     * METODO RESPONSAVEL POR LISTAR TODAS AS CATEGORIAS CADASTRADAS
     *
     * @return array
     */
    public static function listAll(){

        $sql =  new Sql;

        return $sql->select("SELECT * FROM tb_rooms ORDER BY desroom");

    }

    /**
     * METODO RESPONSAVEL POR LISTAR TODAS AS CATEGORIAS CADASTRADAS
     *
     * @return array
     */
    public static function getNameRoom($idroom){

        $sql =  new Sql;

        return $sql->select("SELECT desroom FROM tb_rooms WHERE idroom = $idroom");

    }

    /**
     * METODO RESPONSAVEL POR SALVAR DADOS DE CATEGORIAS NO BANCO
     *
     */
    public function save(){
        
        $sql = new Sql;

        $results = $sql->select("CALL sp_rooms_save(:idroom, :desroom)", array(
            ":idroom"=>$this->getidroom(),
            ":desroom"=>$this->getdesroom()
        ));

        $this->setData($results);


    }

    /**
     * METODO RESPONSAVEL POR PEGAR UMA CATEGORIA EXPECIFICA ATRAVES DO ID
     *
     * @param $idroom
     */
    public function get($idroom){
        
        $sql = new Sql;

        $results = $sql->select("SELECT * FROM tb_rooms WHERE idroom =  :idroom",array(
            ":idroom"=>$idroom

        ));

        $this->setData($results[0]);

    }

    /**
     * METODO RESPONSAVEL POR ALTERAR DADOS DA CATEGORIA NO BANCO
     *
     */
    public function update(){

        $sql = new Sql;

        $results = $sql->select("ALTER tb_rooms SET desroom = :desroom WHERE idroom = :idroom)", array(
            ":idroom"=>$this->getidroom(),   
            ":desroom"=>$this->getdesroom()
        ));

        $this->setData($results[0]);


    }

    /**
     * METODO RESPONSAVEL POR APAGAR DADOS DA CATEGORIA NO BANCO
     *
     */
    public function delete(){

        $sql = new Sql;

        $sql->query("DELETE FROM tb_rooms WHERE idroom = :idroom", array(
            ":idroom"=>$this->getidroom()
        ));

    }

    public static function getPage($page = 1, $itemsPerPage = 10){

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_rooms 
			ORDER BY desroom
			LIMIT $start, $itemsPerPage;
		");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10){

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_rooms 
			WHERE desroom LIKE :search
			ORDER BY desroom
			LIMIT $start, $itemsPerPage;
		", [
			':search'=>'%'.$search.'%'
		]);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}
}

