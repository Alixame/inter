<?php

##### ROTAS DE CATEGORIAS DENTRO DO PAINEL DE ADMIN #####

/**
 * CARRENDANDO CLASSES ATRAVES OS NAMESPACE
 */

use Vendor\Model\Devices;
use Vendor\PageAdmin;
use Vendor\Model\User;
use Vendor\Model\Room;

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA DO PAINEL DE ADMIN-ROOMS
 */
$app->get("/admin/rooms", function() {

    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);

    // VERIFICANDO SE EXISTE DADO PARA PESQUISA
    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    // VALIDANDO PESQUISA
    if ($search != '') {

		$pagination = Room::getPageSearch($search, $page);

	} else {

		$pagination = Room::getPage($page);

	}

    // DEFININDO ARRAY -$pages-
	$pages = [];

    // CRIANDO URL DE PESQUISA
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, [
			'href'=>'/admin/rooms?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

    // INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
    $page = new PageAdmin();

    /**
    * RENDERIZANDO PAGINA 'CATEGORIES' ATRAVES DO SLIM
    *
    * PASSANDO UM ARRAY COM DADOS DOS -ROOMS-
    */
	$page->setTpl("rooms", [
		"rooms"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
	]);
	
});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA DO PAINEL DE CREATE-ROOMS
 */
$app->get("/admin/rooms/create", function() {
    
    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);

    // INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
    $page = new PageAdmin();

    /**
    * RENDERIZANDO PAGINA 'ROOMS-CREATE' ATRAVES DO SLIM
    */
	$page->setTpl("rooms-create");
	
});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 * 
 * ROTA DO PAINEL DE CREATE-ROOMS
 */
$app->post("/admin/rooms/create", function() {

    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);
    
    // INSTANCIANDO OBJETO DA CLASSE -room-
    $room = new Room;
 
    // ENVIADO DADOS DO -$_POST-
    $room->setData($_POST);

    // SALVANDO DADOS DO ROOM NO BANCO
    $room->save();

    // REDIRECIONANDO AO -/ADMIN/ROOMS-
    header("Location: /admin/rooms");
    exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$idroom-
 * 
 * ROTA DO PAINEL DE DELETE-ROOMS
 */
$app->get("/admin/rooms/:idroom/delete", function($idroom) {

    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);
    
    // INSTANCIANDO OBJETO DA CLASSE -Room-
    $room = new Room;

    // VERIFICANDO SE O -$idroom- EXISTE NO BANCO
	$room->get((int)$idroom);
    
    // APAGANDO DADOS DO ROOM DO BANCO
	$room->delete();

    // REDIRECIONANDO AO -/ADMIN/ROOMS-
	header("Location: /admin/rooms");
	exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$idroom-
 * 
 * ROTA DO PAINEL DE ALTER-ROOMS
 */
$app->get("/admin/rooms/:idroom", function($idroom) {

    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);

    // INSTANCIANDO OBJETO DA CLASSE -Room-
    $room = new Room;

    // VERIFICANDO SE O -$idroom- EXISTE NO BANCO
	$room->get((int)$idroom);

    // INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
    $page = new PageAdmin();

    /**
    * RENDERIZANDO PAGINA 'ROOMS-UPDATE' ATRAVES DO SLIM
    *
    * PASSANDO UM ARRAY COM DADOS DAS -ROOM-
    */
	$page->setTpl("rooms-update",array(
        "rooms"=>$room->getValues()
    ));
	
});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$idroom-
 * 
 * ROTA DO PAINEL DE ALTER-ROOMS
 */
$app->post("/admin/rooms/:idroom", function($idroom){

     // VERIFICANDO SE O USUARIO ESTA LOGADO
	User::verifyLogin();

    // INSTANCIANDO OBJETO DA CLASSE -Room-
	$room = new Room();

    // VERIFICANDO SE O -$idroom- EXISTE NO BANCO
	$room->get((int)$idroom);

    // DEFININDO DADOS DO POST
	$room->setData($_POST);

    // SALVANDO DADOS NO BANCO
	$room->save();	

    // REDIRECIONANDO PARA -/ADMIN/ROOMS-
	header('Location: /admin/rooms');
	exit;

});
