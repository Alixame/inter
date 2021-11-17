<?php

##### ROTAS PADRÃO DO SITE #####

/**
 * CARRENDANDO CLASSES ATRAVES OS NAMESPACE
 */
use Vendor\Model\Contact;
use Vendor\Page;


/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA HOME
 */
$app->get('/', function() {

    //INSTANCIANDO OBJETO DA CLASSE PAGE
    $page = new Page;

    /**
     * RENDERIZANDO PAGINA 'MAIN' ATRAVES DO SLIM
     * 
     * PASSANDO UM ARRAY COM OS DADOS DOS PRODUTOS
     */
    $page->setTpl("main");
    
});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 * 
 * ROTA PARA ENVIAR MENSAGEM DE CONTATO
 */
$app->post("/sent-contact", function(){

	// INSTANCIANDO OBJETO DA CLASSE -User-
	$contact = new Contact;

    // ENVIADO DADOS DO -$_POST-
 	$contact->setData($_POST);

    // SALVANDO NO BANCO
    $contact->save();

    // REDIRECIONANDO PARA A RODA -/MESSAGE-SENT-
	header("Location: /message-sent");
	exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA DE SUCESSO DE ENVIO DA MENSAGEM
 */
$app->get('/message-sent', function() {

    //INSTANCIANDO OBJETO DA CLASSE PAGE
    $page = new Page([
		"header" => false,
		"footer" => false
	]);

    /**
     * RENDERIZANDO PAGINA 'MESSAGE-SENT' ATRAVES DO SLIM
     */
    $page->setTpl("message-sent");
    
});