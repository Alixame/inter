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

// DEFINANDO CLASE Products QUE HERDA METODOS E FUNÇÕES DA CLASSE MODEL
class Devices extends Model {

    /**
     * METEODO RESPONSAVEL POR LISTAR TODOS PRODUTOS
     */
    public static function listAll($iduser){

        $sql =  new Sql;

        return $sql->select("SELECT a.iddevice, a.desdevice , a.deson , b.desroom
        FROM tb_devices a
        INNER JOIN tb_rooms b ON b.idroom = a.idroom
        WHERE a.iduser = $iduser
        ORDER BY b.desroom;");

    }

    /**
     * METODO RESPONSAVEL POR VERIFICAR LISTA DE PRODUTOS
     *
     * @param $list
     * @return $list
     */
    public static function checkList($list){

        foreach ($list as &$row) {
            
            $p = new Devices;
            $p->setData($row);
            $row = $p->getValues();

        }

        return $list;

    }

    /**
     * METODO RESPONSAVEL POR SALVAR DADOS DE PRODUTOS NO BANCO
     *
     * @return void
     */
    public function insert(){
        
        $sql = new Sql;

        $results = $sql->select("insert into tb_devices(desdevice,pin_A,iduser, idroom) values (:desdevice, :pinarduino, :iduser, :idroom)", array(
            ":desdevice"=>$this->getdesdevice(),
            ":pinarduino"=>$this->getpinarduino(),
            ":iduser"=>$this->getiduser(),
            ":idroom"=>$this->getidroom()
        ));

        $this->setData($results);

    }

      /**
     * METODO RESPONSAVEL POR SALVAR DADOS DE PRODUTOS NO BANCO
     *
     * @return void
     */
    public function update(){
        
        $sql = new Sql;

        $results = $sql->select("UPDATE tb_devices SET desdevice = :desdevice , pin_A = :pinarduino , idroom = :idroom WHERE iddevice = :iddevice", array(
            ":desdevice"=>$this->getdesdevice(),
            ":pinarduino"=>$this->getpinarduino(),
            ":iddevice"=>$this->getiddevice(),
            ":idroom"=>$this->getidroom()
        ));

        $this->setData($results);

    }

    /**
     * METODO RESPONSAVEL POR PEGAR PRODUTO POR ID 
     *
     * @param integer $iddevice
     */
    public function get($iddevice){
        
        $sql = new Sql;

        $results = $sql->select("SELECT * FROM tb_devices WHERE iddevice =  :iddevice",array(
            ":iddevice"=>$iddevice

        ));

        $this->setData($results[0]);

    }

    /**
     * METODO RESPONSAVEL POR APAGAR DADOS DE UM PRODUTO DO BANCO
     *
     * @return void
     */
    public function delete(){

        $sql = new Sql;

        $sql->query("DELETE FROM tb_devices WHERE iddevice = :iddevice", array(
            ":iddevice"=>$this->getiddevice()
        ));
        
    }

    /**
     * METODO RESPONSAVEL POR VERIFICAR SE O PRODUTO POSSUI FOTO VINCULADA
     *
     * @return void
     */
    public function checkPhotoOn(){

        $url = "/resources/img/devices/on/default.jpg";

        if (file_exists($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."resources".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."devices".DIRECTORY_SEPARATOR."on".DIRECTORY_SEPARATOR.$this->getiddevice().".jpg")){
            
            $url = "/resources/img/devices/on/".$this->getiddevice().".jpg";

        }

        $this->setdesphotoon($url);

    }

        /**
     * METODO RESPONSAVEL POR VERIFICAR SE O PRODUTO POSSUI FOTO VINCULADA
     *
     * @return void
     */
    public function checkPhotoOff(){


        $url = "/resources/img/devices/off/default.jpg";
        
        if (file_exists($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."resources".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."devices".DIRECTORY_SEPARATOR."off".DIRECTORY_SEPARATOR.$this->getiddevice().".jpg")){
            
            $url = "/resources/img/devices/off/".$this->getiddevice().".jpg";

        }

        $this->setdesphotooff($url);

    }

    /**
     * METODO RESPONSAVEL POR PEGAR VALORES (ADICIONANDO FOTO)
     */
    public function getValues(){
        
        $this->checkPhotoOn();
        $this->checkPhotoOff();

        $values = parent::getValues();

        return $values;

    }

    /**
     * METODO RESPONSAVEL POR SETAR FOTO AO PRODUTO
     *
     * @param $file
     * @return void
     */
    public function setPhotoOn($file){

        $extension = explode(".",$file['name']);

        $extension = end($extension);

        switch ($extension) {
            case 'jpg':case 'jpeg':
                $image = imagecreatefromjpeg($file["tmp_name"]);
                break;
            case 'gif':
                $image = imagecreatefromgif($file["tmp_name"]);
                break;
            case 'png':
                $image = imagecreatefrompng($file["tmp_name"]);
                break;
        }

        $dist = $_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."resources".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."devices".DIRECTORY_SEPARATOR."on".DIRECTORY_SEPARATOR.$this->getiddevice().".jpg";

        imagejpeg($image, $dist);
        
        imagedestroy($image);

        $this->checkPhotoOn();

    }

      /**
     * METODO RESPONSAVEL POR SETAR FOTO AO PRODUTO
     *
     * @param $file
     * @return void
     */
    public function setPhotoOff($file){

        $extension = explode(".",$file['name']);

        $extension = end($extension);

        switch ($extension) {
            case 'jpg':case 'jpeg':
                $image = imagecreatefromjpeg($file["tmp_name"]);
                break;
            case 'gif':
                $image = imagecreatefromgif($file["tmp_name"]);
                break;
            case 'png':
                $image = imagecreatefrompng($file["tmp_name"]);
                break;
        }

        $dist = $_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."resources".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."devices".DIRECTORY_SEPARATOR."off".DIRECTORY_SEPARATOR.$this->getiddevice().".jpg";

        imagejpeg($image, $dist);
        
        imagedestroy($image);

        $this->checkPhotoOff();

    }

    public static function getPage($page = 1, $itemsPerPage = 10){

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS a.iddevice, a.desdevice, a.pin_A, b.idperson, b.desperson 
            FROM tb_devices a inner join tb_persons b
            WHERE a.iduser = b.idperson
            ORDER BY b.desperson
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
            FROM tb_devices
            WHERE desdevice LIKE :search
            ORDER BY desdevice
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

    public static function getPageGetUser($iduser, $page = 1, $itemsPerPage = 10){

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS a.iddevice, a.desdevice, a.pin_A, b.idperson, b.desperson, c.desroom
            FROM tb_devices a 
            inner join tb_persons b
            inner join tb_rooms c ON a.idroom = c.idroom
            WHERE a.iduser = $iduser AND b.idperson = $iduser
            ORDER BY a.iddevice
			LIMIT $start, $itemsPerPage;
		");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	public static function getPageSearchGetUser($iduser, $search, $page = 1, $itemsPerPage = 10){

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
            SELECT SQL_CALC_FOUND_ROWS *
            FROM tb_devices a inner join tb_persons b
            WHERE a.iduser = $iduser AND b.idperson = $iduser");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

    /**
     * METODO RESPONSAVEL POR LIGAR UM DISPOSITIVO
     *
     * @param int $iddevice
     * @return void
     */
    public function on($iddevice){
        
        $sql = new Sql();

        $sql->select("UPDATE tb_devices SET deson = 1 WHERE iddevice = :iddevice",[
            ":iddevice"=>$iddevice
        ]);
        
    }

    /**
     * METODO RESPONSAVEL POR DESLIGAR UM DISPOSITIVO
     *
     * @param int $iddevice
     * @return void
     */
    public function off($iddevice){
        
        $sql = new Sql();

        $sql->select("UPDATE tb_devices SET deson = 0 WHERE iddevice = :iddevice",[
            ":iddevice"=>$iddevice
        ]);
        
    }

}

