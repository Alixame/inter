<?php

##### ROTAS DE MENSAGENS DE CLIENTES DENTRO DO PAINEL DE ADMIN #####

/**
 * CARRENDANDO CLASSES ATRAVES OS NAMESPACE
 */

use Vendor\Model\Contact;
use Vendor\PageAdmin;
use Vendor\Model\User;

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA DO PAINEL DE ADMIN-MESSAGES
 */
$app->get("/admin/messages", function() {

    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);

    // VERIFICANDO SE EXISTE DADO PARA PESQUISA
    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    // VALIDANDO PESQUISA
    if ($search != '') {

		$pagination = Contact::getPageSearch($search, $page);

	} else {

		$pagination = Contact::getPage($page);

	}

    // DEFININDO ARRAY -$pages-
	$pages = [];

    // CRIANDO URL DE PESQUISA
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, [
			'href'=>'/admin/messages?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

    // INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
    $page = new PageAdmin();

    /**
    * RENDERIZANDO PAGINA 'PRODUCTS' ATRAVES DO SLIM
    *
    * PASSANDO UM ARRAY COM DADOS DOS -PRODUTOS-
    */
    $page->setTpl("messages",[
        "messages"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
    ]);

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$idmessage-
 * 
 * ROTA DO PAINEL DE DELETE-MESSAGES
 */
$app->get("/admin/messages/:idmessage/delete", function($idmessage) {

	// VERIFICANDO SE O USUARIO ESTA LOGADO
	User::AdminVerifyLogin(TRUE);

	// INSTANCIANDO OBJETO DA CLASSE -User-
	$contact = new Contact;

	// VERIFICANDO SE O -$contact- EXISTE NO BANCO
	$contact->get((int)$idmessage);
	
	// APAGANDO DADOS DO USUARIO DO BANCO
	$contact->delete();

	// REDIRECIONANDO AO -/ADMIN/MESSAGE-
	header("Location: /admin/messages");
	exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$idmessage-
 * 
 * ROTA DO PAINEL DE VIEW-MESSSAGE
 */
$app->get("/admin/messages/:idmessage", function($idmessage) {
    
	// VERIFICANDO SE O USUARIO ESTA LOGADO
	User::AdminVerifyLogin(TRUE);

	// INSTANCIANDO OBJETO DA CLASSE -User-
	$contact = new Contact;

	// VERIFICANDO SE O -$contact- EXISTE NO BANCO
	$contact->get((int)$idmessage);

    // INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
    $page = new PageAdmin();

    /**
    * RENDERIZANDO PAGINA 'MESSAGES-VIEW' ATRAVES DO SLIM
    *
    * PASSANDO UM ARRAY COM DADOS DOS -MESSAGES-
    */
    $page->setTpl("messages-view",[
        "messages"=>$contact->getValues()
    ]);

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$idmessage-
 * 
 * ROTA DO PAINEL DE RESPONSE-MESSSAGE
 */
$app->get("/admin/messages/:idmessage/response", function($idmessage) {
    
    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);

    // INSTANCIANDO OBJETO DA CLASSE -User-
	$contact = new Contact;

	// VERIFICANDO SE O -$contact- EXISTE NO BANCO
	$contact->get((int)$idmessage);

    // INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
    $page = new PageAdmin();

    /**
    * RENDERIZANDO PAGINA 'MESSAGES-VIEW' ATRAVES DO SLIM
    *
    * PASSANDO UM ARRAY COM DADOS DOS -MESSAGES-
    */
    $page->setTpl("messages-response",[
        "messages"=>$contact->getValues()
    ]);

  

});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$idmessage-
 * 
 * ROTA DO PAINEL DE UPDATE-PRODUCT
 */
$app->post("/admin/messages/:idmessage/response", function($idmessage) {
    
    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);

    // INSTANCIANDO OBJETO DA CLASSE -User-
	$contact = new Contact;

    // VERIFICANDO SE O -$contact- EXISTE NO BANCO
	$contact->get((int)$idmessage);

    // ENVIADO DADOS DO -$_POST-
    $contact->setData($_POST);

    // ARMAZENANDO DADOS EM UM ARRAY
    $data = $contact->getValues();

    // ENVIA MENSAGEM POR EMAIL
	Contact::setResponse($data);

    // Mudando o status da mensagem para respondida
    Contact::updateResponse($idmessage);

    // REDIRECIONANDO AO -/ADMIN/MESSAGES-
    header("Location: /admin/messages");
    exit;

});