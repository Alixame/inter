<?php

##### ROTAS DE ADMIN #####

/**
 * CARRENDANDO CLASSES ATRAVES OS NAMESPACE
 */

use Vendor\Model\Dashboard;
use Vendor\PageAdmin;
use Vendor\Model\User;


/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA DO PAINEL DE ADMIN
 */
$app->get("/admin", function() {

	// VERIFICANDO SE O USUARIO ESTA LOGADO
	User::AdminVerifyLogin(TRUE);

	// INSTANCIANDO OBJETO DA CLASSE -Dashboard-
	$dashboard = new Dashboard();

	// CONSULTAS DO DASHBORD
	$sales = $dashboard->getTotalsSales();
	$users = $dashboard->getTotalsUsers();
	$access = $dashboard->getTotalsAccess();
	$contact = $dashboard->getTotalsMessages();

	// INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
	$page = new PageAdmin();

	/**
    * RENDERIZANDO PAGINA 'MAIN' ATRAVES DO SLIM
	*
	* PASSANDO POR ARRAY VALORES DO DASHBORD
	*
    */
	$page->setTpl("main", array(
		"sales"=>"",//$sales[0]['COUNT(idstatus)'],
		"users"=>"",//$users[0]['COUNT(inadmin)'],
		"access"=>"",//$access[0]['COUNT(dessessionid)']
		"contact"=>""//$contact[0]['COUNT(idmessage)']
	));
	
});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA DE LOGIN DE ADMIN
 */
$app->get("/admin/login", function() {

	// VERIFICANDO SE O USUARIO ESTA LOGADO
	User::verifyLogout();

	/**
	 * INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
	 * 
	 * RETIRANDO -HEADER- E -FOOTER- DA PAGINA
	 */ 
	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	/**
    * RENDERIZANDO PAGINA 'LOGIN' ATRAVES DO SLIM
    */
	$page->setTpl("login");
	
});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 * 
 * ROTA DE LOGIN DE ADMIN
 */
$app->post("/admin/login", function() {

	// VERIFICANDO SE LOGIN E SENHA EXISTEM NO BANCO
	User::AdminLogin($_POST["login"], $_POST["password"]);

	if(isset($_SESSION[User::SESSION])){

		// REDIRECIONANDO PARA -/ADMIN-
		header("Location: /admin");
		exit;

	} else {

		// REDIRECIONANDO PARA -/LOGIN-
		header("Location: /login");
		exit;

	}

	
});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA PARA DESLOGAR USUARIO
 */
$app->get("/admin/logout", function() {

	// FINALIZANDO SESSÃO DO USUARIO QUE ESTIVER LOGADO
	User::logout();

	// REDIRECIONANDO PARA -/ADMIN/LOGIN-
	header("Location: /admin/login");
	exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA PARA RECUPERAR SENHA
 */
$app->get("/admin/forgot", function() {

	/**
	 * INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
	 * 
	 * RETIRANDO -HEADER- E -FOOTER- DA PAGINA
	 */
	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	/**
    * RENDERIZANDO PAGINA 'FORGOT' ATRAVES DO SLIM
    */
	$page->setTpl("forgot");
	
});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 * 
 * ROTA PARA RECUPERAR SENHA
 */
$app->post("/admin/forgot", function() {

	// VERIFICANDO SE EXISTE UM USUARIO COM O EMAIL INFORMADO
	$user = User::getForgot($_POST["email"]);
	
	// REDIRECIONANDO AO -/ADMIN/FORGOT/SENT-
	header("Location: /admin/forgot/sent");
	exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA PARA ENVIAR EMAIL PARA RECUPERAÇÃO DE SENHA
 */
$app->get("/admin/forgot/sent", function() {

	/**
	 * INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
	 * 
	 * RETIRANDO -HEADER- E -FOOTER- DA PAGINA
	 */
	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	/**
    * RENDERIZANDO PAGINA 'FORGOT-SENT' ATRAVES DO SLIM
    */
	$page->setTpl("forgot-sent");
	
});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA PARA ALTERAR SENHA
 */
$app->get("/admin/forgot/reset", function() {

	// VERIFICANDO O CODIGO DE RECUPERAÇÃO
	$user = User::validForgotDecrypt($_GET["code"]);

	/**
	 * INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
	 * 
	 * RETIRANDO -HEADER- E -FOOTER- DA PAGINA
	 */
	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	/**
    * RENDERIZANDO PAGINA 'FORGOT-RESET' ATRAVES DO SLIM
    * 
    * PASSANDO UM ARRAY COM OS DADOS DO USUARIO E CODIGO DE RECUPERAÇÃO
    */
	$page->setTpl("forgot-reset",array(
		"name"=>$user["desperson"],
		"code"=>$_GET["code"]
	));
	
});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 * 
 * ROTA PARA ALTERAR SENHA
 */
$app->post("/admin/forgot/reset", function() {

	// VERIFICANDO O CODIGO DE RECUPERAÇÃO
	$forgot = User::validForgotDecrypt($_POST["code"]);

	// VERIFICANDO SE O USUARIO JA RECUPEROU A SENHA
	User::setForgotUsed($forgot["idrecovery"]);

	// INSTANCIANDO OBJETO DA CLASSE -User-
	$user = new User;

	// VERIFICANDO -iduser-
	$user->get((int)$forgot["iduser"]);

	// CRIPTOGRAFANDO NOVA SENHA
	$password = password_hash($_POST["password"], PASSWORD_DEFAULT, [
		"cost"=>12
	]);

	// ALTERANDO SENHA
	$user->setPassword($password);

	/**
	 * INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
	 * 
	 * RETIRANDO -HEADER- E -FOOTER- DA PAGINA
	 */
	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	/**
    * RENDERIZANDO PAGINA 'FORGOT-RESET-SUCCESS' ATRAVES DO SLIM
    */
	$page->setTpl("forgot-reset-success");
	
});