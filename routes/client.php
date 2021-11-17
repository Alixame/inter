<?php 

##### ROTAS CLIENTE #####

/**
 * CARRENDANDO CLASSES ATRAVES OS NAMESPACE
 */
use Vendor\Model\User;
use Vendor\Model\Devices;
use Vendor\PageClient;

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA DO PAINEL DO CLIENTE
 */
$app->get("/panel", function(){

    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::verifyLogin(FALSE);

    // PEGANDO DADOS DO USUARIO NA SESSÃO
    $user = User::getFromSession();

    // PEGANDO DADOS DO USUARIO DO BANCO
    $user = $user->getValues();

    // LISTANDO TODOS OS DISPOSITIVOS VINCULADOS AO USUARIO
    $devices = Devices::listAll($user["iduser"]);

    // INSTANCIANDO OBJETO DA CLASSE -PageClient-
    $page =  new PageClient();

    /**
     * RENDERIZANDO PAGINA 'Panel' ATRAVES DO SLIM
     *
     *
     */
    $page->setTpl("panel", [
		'devices'=>Devices::checkList($devices)
	]);

});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 */
$app->post("/panel/on/device/:iddevice", function($iddevice){

    // VERIFICANDO SE O USUARIO ESTA LOGADO
	User::verifyLogin(FALSE);

    //INSTANCIANDO OBJETO DA CLASSE -Devices-
	$devices = new Devices();

    // CHAMANDO FUNÇÃO PARA LIGAR O DISPOSITIVO
	$devices->on($iddevice);

    // REDIRECIONANDO PARA RODA -/PANEL-
    header("Location: /panel");
	exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 */
$app->post("/panel/off/device/:iddevice", function($iddevice){

    // VERIFICANDO SE O USUARIO ESTA LOGADO
	User::verifyLogin(FALSE);

    //INSTANCIANDO OBJETO DA CLASSE -Devices-
	$devices = new Devices();

    // CHAMANDO FUNÇÃO PARA DESLIGAR O DISPOSITIVO
	$devices->off($iddevice);

    // REDIRECIONANDO PARA RODA -/PANEL-
    header("Location: /panel");
	exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA PARA O LOGIN DE CLIENTE
 */
$app->get("/login", function(){

    // VERIFICANDO SE O USUARIO ESTA LOGADO
	User::verifyLogout();

    //INSTANCIANDO OBJETO DA CLASSE -Page-
    $page =  new PageClient([
        "header" => false,
		"footer" => false
    ]);

    /**
     * RENDERIZANDO PAGINA 'LOGIN' ATRAVES DO SLIM
     */
    $page->setTpl("login",[
        "error"=>User::getError(),
        "errorRegister"=>User::getErrorRegister()
    ]);

});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 * 
 * ROTA PARA O LOGIN DE CLIENTE
 */
$app->post("/login", function(){

    try{
       
        // VERIFICANDO SE EXISTE USUARIO COM LOGIN E SENHA INFORMADOS
        User::login($_POST["login"], $_POST["password"]);
    
    } catch (\Exception $e) {

        User::setError($e->getMessage());

    }
    
    // REDIRECIONANDO AO -/PANEL-
    header("Location: /panel");
    exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA PARA O DESCONECTAR DE CLIENTE
 */
$app->get("/logout", function(){

    // DESLOGANDO O USUARIO
    User::logout();
    
    // REDIRECIONANDO AO -/LOGIN-
    header("Location: /login");
    exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA PARA RECUPERAR SENHA
 */
$app->get("/forgot", function() {

    //INSTANCIANDO OBJETO DA CLASSE -Page-
    $page =  new PageClient([
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
$app->post("/forgot", function() {

	// VERIFICANDO SE EXISTE UM USUARIO COM O EMAIL INFORMADO
	$user = User::getForgot($_POST["email"], false);
	
	// REDIRECIONANDO AO -/FORGOT/SENT-
	header("Location: /forgot/sent");
	exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA PARA ENVIAR EMAIL PARA RECUPERAÇÃO DE SENHA
 */
$app->get("/forgot/sent", function() {

    //INSTANCIANDO OBJETO DA CLASSE -Page-
    $page =  new PageClient([
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
$app->get("/forgot/reset", function() {

	// VERIFICANDO O CODIGO DE RECUPERAÇÃO
	$user = User::validForgotDecrypt($_GET["code"]);

    //INSTANCIANDO OBJETO DA CLASSE -Page-
    $page =  new PageClient([
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
$app->post("/forgot/reset", function() {

	// VERIFICANDO O CODIGO DE RECUPERAÇÃO
	$forgot = User::validForgotDecrypt($_POST["code"]);

	// VERIFICANDO SE O USUARIO JA RECUPEROU A SENHA
	User::setForgotUsed($forgot["idrecovery"]);

	// INSTANCIANDO OBJETO DA CLASSE -User-
	$user = new User;

	// VERIFICANDO -iduser-
	$user->get((int)$forgot["iduser"]);

	// NOVA SENHA
	$password = $_POST["password"];

	// ALTERANDO SENHA
	$user->setPassword($password);

    //INSTANCIANDO OBJETO DA CLASSE -Page-
    $page =  new PageClient([
        "header" => false,
		"footer" => false
     ]);

    /**
     * RENDERIZANDO PAGINA 'FORGOT-RESET-SUCCESS' ATRAVES DO SLIM
     */
    $page->setTpl("forgot-reset-success");
	
});