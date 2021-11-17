<?php

###### ROTAS DE USUARIOS DENTRO DO PAINEL DE ADMIN ######

/**
 * CARRENDANDO CLASSES ATRAVES OS NAMESPACE
 */
use Vendor\PageAdmin;
use Vendor\Model\User;

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$iduser-
 * 
 * ROTA DO PAINEL DE ADMIN-USERS-PASSWORD
 */
$app->get("/admin/users/:iduser/password", function($iduser){

	// VERIFICANDO SE O USUARIO ESTA LOGADO
	User::AdminVerifyLogin(TRUE);

	// INSTANCIANDO OBJETO DA CLASSE -User-
	$user = new User();

	// VERIFICANDO SE O -$iduser- EXISTE NO BANCO
	$user->get((int)$iduser);

	// INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
	$page = new PageAdmin();

	/**
    * RENDERIZANDO PAGINA 'USERS-PASSWORD' ATRAVES DO SLIM
    *
    * PASSANDO UM ARRAY COM DADOS DOS -USUARIOS-
    */
	$page->setTpl("users-password", [
		"user"=>$user->getValues(),
		"msgError"=>User::getError(),
		"msgSuccess"=>User::getSuccess()
	]);

});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$iduser-
 * 
 * ROTA DO PAINEL DE ADMIN-USERS-PASSWORD
 */
$app->post("/admin/users/:iduser/password", function($iduser){

	// VERIFICANDO SE O USUARIO ESTA LOGADO
	User::AdminVerifyLogin(TRUE);

	// VALIDANDO DADOS DO CAMPO -SENHA-
	if (!isset($_POST['despassword']) || $_POST['despassword']==='') {

		User::setError("Preencha a nova senha.");
		header("Location: /admin/users/$iduser/password");
		exit;

	}

	// VALIDANDO DADOS DO CAMPO -CONFIRMAR SENHA-
	if (!isset($_POST['despassword-confirm']) || $_POST['despassword-confirm']==='') {

		User::setError("Preencha a confirmação da nova senha.");
		header("Location: /admin/users/$iduser/password");
		exit;

	}

	// VALIDANDO SE OS CAMPOS SÃO IGUAIS
	if ($_POST['despassword'] !== $_POST['despassword-confirm']) {

		User::setError("Confirme corretamente as senhas.");
		header("Location: /admin/users/$iduser/password");
		exit;

	}

	// INSTANCIANDO OBJETO DA CLASSE -User-
	$user = new User();

	// VERIFICANDO SE O -$iduser- EXISTE NO BANCO
	$user->get((int)$iduser);

	// CRIPTOGRAFANDO NOVA SENHA
	$password = password_hash($_POST["despassword"], PASSWORD_DEFAULT, [
		"cost"=>12
	]);

	// DEFININDO SENHA NO BANCO
	$user->setPassword($password);

	// DEFININDO MENSAGEM DE SUCESSO
	User::setSuccess("Senha alterada com sucesso.");

	// REDIRECIONANDO PARA ROTA -/ADMIN/USERS/{ID}/PASSWORD-
	header("Location: /admin/users/$iduser/password");
	exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA DO PAINEL DE ADMIN-USERS
 */
$app->get("/admin/users", function() {

	// VERIFICANDO SE O USUARIO ESTA LOGADO
	User::AdminVerifyLogin(TRUE);

	// VERIFICANDO SE EXISTE DADO PARA PESQUISA
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	// VALIDANDO PESQUISA
	if ($search != '') {

		$pagination = User::getPageSearch($search, $page);

	} else {

		$pagination = User::getPage($page);

	}

	// DEFININDO ARRAY -$pages-
	$pages = [];

	// CRIANDO URL DE PESQUISA
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, [
			'href'=>'/admin/users?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

	// INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
	$page = new PageAdmin();
	
	/**
    * RENDERIZANDO PAGINA 'USERS' ATRAVES DO SLIM
    *
    * PASSANDO UM ARRAY COM DADOS DOS -USUARIOS-
    */
	$page->setTpl("users", array(
		"users"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
	));
	
});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA DO PAINEL DE CREATE-USERS
 */
$app->get("/admin/users/create", function() {

	// VERIFICANDO SE O USUARIO ESTA LOGADO
	User::AdminVerifyLogin(TRUE);

	// INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
	$page = new PageAdmin;

	/**
    * RENDERIZANDO PAGINA 'USERS-CREATE' ATRAVES DO SLIM
    */
	$page->setTpl("users-create");
	
});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 * 
 * ROTA DO PAINEL DE CREATE-USERS
 */
$app->post("/admin/users/create", function() {

	// VERIFICANDO SE O USUARIO ESTA LOGADO
	User::AdminVerifyLogin(TRUE);

	// INSTANCIANDO OBJETO DA CLASSE -User-
	$user = new User;

	// DEFININDO PERMISSÃO DO USUARIO CRIADO
 	$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;

	// ENVIADO DADOS DO -$_POST-
 	$user->setData($_POST);

	// SALVANDO NO BANCO
	$user->save();

	// REDIRECIONANDO AO -/ADMIN/USERS-
	header("Location: /admin/users");
 	exit;
	
});


/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$iduser-
 * 
 * ROTA DO PAINEL DE DELETE-USERS
 */
$app->get("/admin/users/:iduser/delete", function($iduser) {

	// VERIFICANDO SE O USUARIO ESTA LOGADO
	User::AdminVerifyLogin(TRUE);

	// INSTANCIANDO OBJETO DA CLASSE -User-
	$user = new User;

	// VERIFICANDO SE O -$iduser- EXISTE NO BANCO
	$user->get((int)$iduser);
	
	// APAGANDO DADOS DO USUARIO DO BANCO
	$user->delete();

	// REDIRECIONANDO AO -/ADMIN/USERS-
	header("Location: /admin/users");
	exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$iduser-
 * 
 * ROTA DO PAINEL DE ALTER-USERS
 */
$app->get("/admin/users/:iduser", function($iduser) {

	// VERIFICANDO SE O USUARIO ESTA LOGADO
	User::AdminVerifyLogin(TRUE);

	// INSTANCIANDO OBJETO DA CLASSE -User-
	$user = new User;

	// VERIFICANDO SE O -$iduser- EXISTE NO BANCO
	$user->get((int)$iduser);

	// INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
	$page = new PageAdmin;

	/**
    * RENDERIZANDO PAGINA 'USERS-UPDATE' ATRAVES DO SLIM
    *
    * PASSANDO UM ARRAY COM DADOS DO -USUARIO-
    */
	$page->setTpl("users-update", array(
		"user"=>$user->getValues()
	));
	
});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$iduser-
 * 
 * ROTA DO PAINEL DE ALTER-USERS
 */
$app->post("/admin/users/:iduser", function($iduser) {

	// VERIFICANDO SE O USUARIO ESTA LOGADO
	User::AdminVerifyLogin(TRUE);

	// INSTANCIANDO OBJETO DA CLASSE -User-
	$user = new User;

	// VERIFICANDO SE O -$iduser- EXISTE NO BANCO
	$user->get((int)$iduser);

	// VERIFICANDO SE O INADMIN ESTA DEFINIDO
	$_POST['inadmin']=isset($_POST['inadmin']) ? 1 : 0;

	// ENVIADO DADOS DO -$_POST-
	$user->setData($_POST);

	// ALTERANDO DADOS DO USUARIO NO BANCO
	$user->update();

	// REDIRECIONANDO AO -/ADMIN/USERS-
	header("Location: /admin/users");
	exit;
	
});