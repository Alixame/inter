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
use Vendor\ResponseMailer;

// DEFINANDO CLASE User QUE HERDA METODOS E FUNÇÕES DA CLASSE MODEL
class Contact extends Model {
    
    /**
     * METODO RESPONSAVEL POR LISTAR TODOS USUARIOS
     */
    public static function listAll(){

        $sql =  new Sql;

        return $sql->select("SELECT * FROM tb_messages WHERE responsed = 0;");

    }

    /**
     * METODO RESPONSAVEL POR SALVAR DADOS DE USUARIO NO BANCO
     *
     * @return void
     */
    public function save(){

        $sql = new Sql;

        $results = $sql->select("CALL sp_message_save(:desname, :nrphone, :desemail, :typemessage, :desmessage)", array(
            ":desname"=>$this->getdesname(),
            ":nrphone"=>$this->getnrphone(),
            ":desemail"=>$this->getdesemail(),
            ":typemessage"=>$this->gettypemessage(),
            ":desmessage"=>$this->getdesmessage(),
        ));

        $this->setData($results[0]);

    }

     /**
     * METODO REPSONSAVEL POR APAGAR DADOS DE UMA MENSAGEM
     *
     * @return void
     */
    public function delete(){

        $sql = new Sql;

        $sql->query("CALL sp_message_delete(:idmessage)", array(
            ":idmessage"=>$this->getidmessage()
        ));

    }

    /**
     * METODO RESPONSAVEL POR PEGAR UM USUARIO POR ID
     *
     * @param $idmessage
     * @return void
     */
    public function get($idmessage){

        $sql = new Sql;

        $results = $sql->select("SELECT * FROM tb_messages WHERE idmessage = :idmessage",array(
            ":idmessage"=>$idmessage
        ));

        $data = $results[0];

        $this->setData($data);

    }


    public static function getPage($page = 1, $itemsPerPage = 10){

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_messages 
			ORDER BY responsed
			LIMIT $start, $itemsPerPage;
		");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS desemail;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["desemail"],
			'pages'=>ceil($resultTotal[0]["desemail"] / $itemsPerPage)
		];

	}

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10){

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_messages
			WHERE typemessage LIKE :search OR desname = :search OR nrphone LIKE :search
			ORDER BY responsed
			LIMIT $start, $itemsPerPage;
		", [
			':search'=>'%'.$search.'%'
		]);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS desemail;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["desemail"],
			'pages'=>ceil($resultTotal[0]["desemail"] / $itemsPerPage)
		];

	} 

    /**
     * METODO RESPONSAVEL POR RECUPERAR SENHA DE UM USUARIO (ENVIA EMAIL)
     *
     * @param $email
     * @param boolean $inadmin
     */
    public static function setResponse($data){

        $mailer = new ResponseMailer($data['desemail'], $data['desname'], "Agradecemos o contato", "response", array(
            "name"=>$data['desname'],
            "typemessage"=>$data['typemessage'],
            "desnameat"=>$data['desnameat'],
            "desmessageat"=>$data['desmessageat']
        ));				

        $send = $mailer->send();
        


        if($send){

            return TRUE;

        } else {

            return FALSE;

        }

    }

    public static function updateResponse($idmessage){

        $sql =  new Sql;

        return $sql->select("UPDATE tb_messages SET responsed = 1 WHERE idmessage =".$idmessage);

        
    }

}   