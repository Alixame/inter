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
use Vendor\Mailer;

// DEFINANDO CLASE User QUE HERDA METODOS E FUNÇÕES DA CLASSE MODEL
class User extends Model {

    const SESSION = "User";
	const SECRET = "Mercury___Secret";
	const SECRET_IV = "Mercury_Secret_IV";
	const ERROR = "UserError";
	const ERROR_REGISTER = "UserErrorRegister";
	const SUCCESS = "UserSucesss";

    /**
     * METODO RESPONSAVEL POR VERIFICAR SE EXISTE SESSÃO ATIVA
     */
    public static function getFromSession(){

        $user = new User;

        if (isset($_SESSION[User::SESSION]) && (int)$_SESSION[User::SESSION]["iduser"] > 0){

            $user->setData($_SESSION[User::SESSION]);

        }

        return $user;

    }

    /**
     * METODO RESPONSAVEL PARA VERIFICAR SE USUARIO ESTÁ LOGADO
     *
     * @param boolean $inadmin
     * @return boolean
     */
    public static function checkLogin($inadmin){

        if (!isset($_SESSION[User::SESSION])
            || 
            !$_SESSION[User::SESSION]
            || 
            !(int)$_SESSION[User::SESSION]["iduser"] > 0 ){
            
            
            //não está logado
            return FALSE;

        } else {

            if ($inadmin == TRUE  && (bool)$_SESSION[User::SESSION]["inadmin"] == TRUE){
             
                return TRUE;

            }else if ($inadmin == FALSE) {
                
                return TRUE;

            } else {
                
                return FALSE;

            }

        }

    }

    /**
     * METODO RESPONSAVEL POR FAZER O LOGIN DE UM USUARIO (VERIFICANDO CREDENCIAIS)
     *
     * @param $login
     * @param $password
     * @return void
     */
    public static function login($login,$password){

        $sql = new Sql;

        $results = $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b ON a.idperson = b.idperson WHERE a.deslogin = :login",array(
            ":login"=>$login
        ));

        if(count($results) === 0){

            throw new \Exception("Usuario inexistente ou senha inválida1");
        
        }

        $data = $results[0];


        if (password_verify($password,$data["despassword"])){

            $user = new User();

            $user->setData($data);       

            $_SESSION[User::SESSION] = $user->getValues();

            return $user;

        } else {

            throw new \Exception("Usuario inexistente ou senha inválida2");
        
        }    

    }

    /**
     * METODO RESPONSAVEL POR FAZER O LOGIN DE UM USUARIO (VERIFICANDO CREDENCIAIS)
     *
     * @param $login
     * @param $password
     * @return void
     */
    public static function AdminLogin($login,$password){

        $sql = new Sql;

        $results = $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b ON a.idperson = b.idperson WHERE a.deslogin = :login",array(
            ":login"=>$login
        ));

        if(count($results) === 0){

            throw new \Exception("Usuario inexistente ou senha inválida1");
        
        }

        $data = $results[0];
        

        if($data["inadmin"] === "0"){
            
            return $user = new User();

        }

        if (password_verify($password,$data["despassword"])){

            $user = new User();

            $user->setData($data);       
            
            $_SESSION[User::SESSION] = $user->getValues();

            return $user;

        } else {

            throw new \Exception("Usuario inexistente ou senha inválida2");
        
        }    

    }

    /**
     * METODO RESPONSAVEL POR VERIFICAR O TIPO DE USUARIO
     *
     * @param boolean $inadmin
     * @return void
     */
    public static function verifyLogin($inadmin = FALSE){

        if (!User::checkLogin($inadmin)){

            if ($inadmin == FALSE) {

                header("Location: /login");

            }

            exit;

        }

    }


    public static function verifyLogout(){

        if(isset($_SESSION[user::SESSION])){

            if((bool)$_SESSION[user::SESSION]["inadmin"] === TRUE ){

                header("Location: /admin");
                exit;

            } else {

                header("Location: /panel");
                exit;

            } 

        }

    }
    
     /**
     * METODO RESPONSAVEL POR VERIFICAR O TIPO DE USUARIO
     *
     * @param boolean $inadmin
     * @return void
     */
    public static function AdminVerifyLogin($inadmin = TRUE){

        if (!User::checkLogin(TRUE)){

            if ($inadmin == TRUE) {

                header("Location: /admin/login");

            } 

            exit;

        }

    }

    /**
     * METODO RESPONSAVEL POR DESLOGAR USUARIO
     *
     * @return void
     */
    public static function logout(){

        $_SESSION[User::SESSION] = NULL;

    }

    /**
     * METODO RESPONSAVEL POR LISTAR TODOS USUARIOS
     */
    public static function listAll(){

        $sql =  new Sql;

        return $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) ORDER BY b.desperson");

    }

    /**
     * METODO RESPONSAVEL POR TRAZER INFORMAÇÕES DE UM USUARIO
     *
     * @param $iduser
     */
    public static function getDetailsUser($iduser){

        $sql =  new Sql;

        return $sql->select("SELECT * FROM tb_users a RIGHT JOIN tb_persons b USING(idperson) WHERE b.idperson = '$iduser'");

    }

    /**
     * METODO RESPONSAVEL POR SALVAR DADOS DE USUARIO NO BANCO
     *
     * @return void
     */
    public function save(){

        $sql = new Sql;

        $results = $sql->select("CALL sp_users_save(:desperson, :deslogin, :despassword, :desemail, :nrphone, :inadmin)", array(
            ":desperson"=>$this->getdesperson(),
            ":deslogin"=>$this->getdeslogin(),
            ":despassword"=>User::getPasswordHash($this->getdespassword()),
            ":desemail"=>$this->getdesemail(),
            ":nrphone"=>$this->getnrphone(),
            ":inadmin"=>$this->getinadmin()
        ));

        $this->setData($results[0]);

    }

    /**
     * METODO RESPONSAVEL POR PEGAR UM USUARIO POR ID
     *
     * @param $iduser
     * @return void
     */
    public function get($iduser){

        $sql = new Sql;

        $results = $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) WHERE a.iduser = :iduser",array(
            
            ":iduser"=>$iduser

        ));

        $data = $results[0];

        $this->setData($data);

    }

    /**
     * METODO RESPONSAVEL POR PEGAR UM USUARIO POR ID
     *
     * @param $iduser
     * @return void
     */
    public function getUserNameById($iduser){

        $sql = new Sql;

        $results = $sql->select("SELECT desperson FROM tb_persons WHERE idperson = :iduser",array(
            ":iduser"=>$iduser
        ));

        return $results[0]["desperson"];

    }

    /**
     * METODO RESPONSAVEL POR ATUALIZAR DADOS DE UM USUARIO NO BANCO
     *
     * @return void
     */
    public function update(){

        $sql = new Sql;

        $results = $sql->select("CALL sp_usersupdate_save(:iduser, :desperson, :deslogin, :despassword, :desemail, :nrphone, :inadmin)", array(
            ":iduser"=>$this->getiduser(),
            ":desperson"=>$this->getdesperson(),
            ":deslogin"=>$this->getdeslogin(),
            ":despassword"=>$this->getdespassword(),
            ":desemail"=>$this->getdesemail(),
            ":nrphone"=>$this->getnrphone(),
            ":inadmin"=>$this->getinadmin()
        ));

        $this->setData($results[0]);

    }

    /**
     * METODO REPSONSAVEL POR APAGAR DADOS DE UM USUARIO
     *
     * @return void
     */
    public function delete(){

        $sql = new Sql;

        $sql->query("CALL sp_users_delete(:iduser)", array(
            ":iduser"=>$this->getiduser()
        ));

    }

    /**
     * METODO RESPONSAVEL POR RECUPERAR SENHA DE UM USUARIO (ENVIA EMAIL)
     *
     * @param $email
     * @param boolean $inadmin
     */
    public static function getForgot($email, $inadmin = true){

        $sql = new Sql;

        $results = $sql->select("
        SELECT *
        FROM tb_persons a
        INNER JOIN tb_users b USING(idperson)
        WHERE  a.desemail = :email", array(
            ":email" => $email
        ));

        if (count($results) === 0 ){

            throw new \Exception("Não foi possível recuperar a senha");
        
        } else {

            $data = $results[0];

            $results2 = $sql->select("CALL sp_userspasswordsrecoveries_create(:iduser, :desip)",array(

                ":iduser"=>$data["iduser"],
                ":desip"=>$_SERVER["REMOTE_ADDR"]

            ));

            if(count($results2) === 0 ){

                throw new \Exception("Não foi possível recuperar a senha");
            
            }else{

                $dataRecovery = $results2[0];

				$code = openssl_encrypt($dataRecovery['idrecovery'], 'AES-128-CBC', pack("a16", User::SECRET), 0, pack("a16", User::SECRET_IV));

				$code = base64_encode($code);

                
				if ($inadmin === true) {

					$link = "http://localhost/admin/forgot/reset?code='$code'";

				} else {

					$link = "http://localhost/forgot/reset?code='$code'";
					
				}		
                
                

				$mailer = new Mailer($data['desemail'], $data['desperson'], "Redefinir senha da Mercury Store", "forgot", array(
					"name"=>$data['desperson'],
					"link"=>$link
				));				

				$mailer->send();

				return $link;

            }

        }

    }

    /**
     * METODO RESPONSAVEL POR VALIDAR CODIGO DE RECUPERAÇÃO DE SENHA
     *
     * @param $code
     */
    public static function validForgotDecrypt($code){

		$code = base64_decode($code);

		$idrecovery = openssl_decrypt($code, 'AES-128-CBC', pack("a16", User::SECRET), 0, pack("a16", User::SECRET_IV));

		$sql = new Sql();

		$results = $sql->select("
			SELECT *
			FROM tb_userspasswordsrecoveries a
			INNER JOIN tb_users b USING(iduser)
			INNER JOIN tb_persons c USING(idperson)
			WHERE
				a.idrecovery = :idrecovery
				AND
				a.dtrecovery IS NULL
				AND
				DATE_ADD(a.dtregister, INTERVAL 1 HOUR) >= NOW();
		", array(
			":idrecovery"=>$idrecovery
		));

		if (count($results) === 0)
		{
			throw new \Exception("Não foi possível recuperar a senha.");
		}
		else
		{

			return $results[0];

		}

	}

    /**
     * METODO RESPONSVEL PEGAR USUARIO QUE QUER RECUPERAR SENHA
     *
     * @param $idrecovery
     * @return void
     */
    public static function setForgotUsed($idrecovery){

        $sql = new Sql;

        $sql->query("UPDATE tb_userspasswordsrecoveries SET dtrecovery = NOW()  WHERE idrecovery = :idrecovery", array(
            ":idrecovery"=>$idrecovery
        ));


    }

    /**
     * METODO RESPONSAVEL POR ALTERAR SENHA
     *
     * @param $password
     * @return void
     */
    public function setPassword($password){
        
        $sql = new Sql();

        $sql->query("UPDATE tb_users set despassword = :password WHERE iduser= :iduser", array(
            ':password'=>$password,
            ':iduser'=>$this->getiduser()
        ));

    }

    /**
     * METODO RESPONSAVEL POR DEFINIR UMA MENSAGEM DE ERRO
     *
     * @param $msg
     * @return void
     */
    public static function setError($msg){

		$_SESSION[User::ERROR] = $msg;

	}

    /**
     * METODO RESPONSAVEL POR PEGAR MENSAGEM DE ERRO
     *
     * @param $msg
     * @return void
     */
	public static function getError(){

		$msg = (isset($_SESSION[User::ERROR]) && $_SESSION[User::ERROR]) ? $_SESSION[User::ERROR] : '';

		User::clearError();

		return $msg;

	}

    /**
     * METODO RESPONSAVEL POR LIMPAR MENSAGEM DE ERRO
     *
     * @param $msg
     * @return void
     */
	public static function clearError(){

		$_SESSION[User::ERROR] = NULL;

	}

    /**
     * METODO RESPONSAVEL POR DEFINIR UMA MENSAGEM DE SUCESSO
     *
     * @param $msg
     * @return void
     */
    public static function setSuccess($msg){

		$_SESSION[User::SUCCESS] = $msg;

	}

    /**
     * METODO RESPONSAVEL POR PEGAR MENSAGEM DE SUCESSO
     *
     * @param $msg
     * @return void
     */
	public static function getSuccess(){

		$msg = (isset($_SESSION[User::SUCCESS]) && $_SESSION[User::SUCCESS]) ? $_SESSION[User::SUCCESS] : '';

		User::clearSuccess();

		return $msg;

	}

    /**
     * METODO RESPONSAVELPOR POR LIMPAR MENSAGEM DE SUCESSO
     *
     * @param $msg
     * @return void
     */
	public static function clearSuccess(){

		$_SESSION[User::SUCCESS] = NULL;

	}
    
    /**
     * METODO RESPONSAVEL POR DEFINIR MENSAGEM DE ERRO AO REGISTAR
     *
     * @param $msg
     * @return void
     */
	public static function setErrorRegister($msg){

		$_SESSION[User::ERROR_REGISTER] = $msg;

	}

    /**
     * METODO RESPONSAVEL POR PEGAR MENSAGEM DE ERRO AO REGISTAR
     *
     * @param $msg
     */
	public static function getErrorRegister(){

		$msg = (isset($_SESSION[User::ERROR_REGISTER]) && $_SESSION[User::ERROR_REGISTER]) ? $_SESSION[User::ERROR_REGISTER] : '';

		User::clearErrorRegister();

		return $msg;

	}

    /**
     * METODO RESPONSAVEL POR LIMPAR MENSAGEM DE ERRO AO REGISTAR
     *
     * @param $msg
     */
	public static function clearErrorRegister(){

		$_SESSION[User::ERROR_REGISTER] = NULL;

	}
    
    /**
     * METODO RESPONSAVEL POR VERIFICAR SE LOGIN JA EXISTE
     *
     * @param $login
     */
    public static function checkLoginExist($login){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :deslogin", [
			':deslogin'=>$login
		]);

		return (count($results) > 0);

	}

    /**
     * METODO RESPONSAVEL POR CRIPTOGRAFAR SENHA
     *
     * @param $password
     */
	public static function getPasswordHash($password){

		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);

	}

    public static function getPage($page = 1, $itemsPerPage = 10){

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_users a 
			INNER JOIN tb_persons b USING(idperson) 
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
			FROM tb_users a 
			INNER JOIN tb_persons b USING(idperson)
			WHERE b.desperson LIKE :search OR b.desemail = :search OR a.deslogin LIKE :search
			ORDER BY b.desperson
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

