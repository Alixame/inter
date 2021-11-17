<?php

##### ROTAS DE DISPOSITIVOS DENTRO DO PAINEL DE ADMIN #####

/**
 * CARRENDANDO CLASSES ATRAVES OS NAMESPACE
 */
use Vendor\PageAdmin;
use Vendor\Model\User;
use Vendor\Model\Devices;
use Vendor\Model\Room;

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * ROTA DO PAINEL DE ADMIN-DEVICES
 */
$app->get("/admin/devices", function() {

    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);

    // VERIFICANDO SE EXISTE DADO PARA PESQUISA
    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    // VALIDANDO PESQUISA
    if ($search != '') {

		$pagination = Devices::getPageSearch($search, $page);

	} else {

		$pagination = Devices::getPage($page);

	}

    // DEFININDO ARRAY -$pages-
	$pages = [];

    // CRIANDO URL DE PESQUISA
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, [
			'href'=>'/admin/devices?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

    // INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
    $page = new PageAdmin();

    /**
    * RENDERIZANDO PAGINA 'DEVICES-ALL' ATRAVES DO SLIM
    *
    * PASSANDO UM ARRAY COM DADOS DOS -devices- , -pesquisa- e -paginas-
    */
    $page->setTpl("devices-all",[
        "devices"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
    ]);

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$iduser-
 * 
 * ROTA DO PAINEL DE ADMIN-ALL-DEVICES
 */
$app->get("/admin/users/:iduser/devices", function($iduser) {
    
    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);

    // VERIFICANDO SE EXISTE DADO PARA PESQUISA
    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    // VALIDANDO PESQUISA
    if ($search != '') {

		$pagination = Devices::getPageSearchGetUser($iduser, $search, $page);

	} else {

		$pagination = Devices::getPageGetUser($iduser, $page);

	}

    // DEFININDO ARRAY -$pages-
	$pages = [];

    // CRIANDO URL DE PESQUISA
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, [
			'href'=>'/admin/devices?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

    // INSTANCIANDO OBJETO DA CLASSE -User-
    $user = new User();
    // INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
    $page = new PageAdmin();

    /**
    * RENDERIZANDO PAGINA 'DEVICES-USER' ATRAVES DO SLIM
    *
    * PASSANDO UM ARRAY COM DADOS DOS -devices- , -pesquisa- e -paginas-
    */
    $page->setTpl("devices-user",[
        "iduser"=>$iduser,
        "name"=>$user->getUserNameById($iduser),
        "devices"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
    ]);

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$iduser-
 * 
 * ROTA DO PAINEL DE CREATE-DEVICES
 */
$app->get("/admin/users/:iduser/devices/create", function($iduser) {

    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);

    // INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
    $page = new PageAdmin();

    $rooms = Room::listAll();

    /**
    * RENDERIZANDO PAGINA 'DEVICES-CREATE' ATRAVES DO SLIM
    *    
    * PASSANDO UM ARRAY COM DADOS DO -iduser-
    */
    $page->setTpl("devices-create",[
        "iduser"=>$iduser,
        "rooms"=>$rooms
    ]);

});

/**
 * CONFIGURANDO ROTA DO TIPO -POST-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$iduser-
 * 
 * ROTA DO PAINEL DE CREATE-DEVICES
 */
$app->post("/admin/users/:iduser/devices/create", function($iduser) {

    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);

    // INSTANCIANDO OBJETO DA CLASSE -Devices-
    $devices = new Devices;

    // DEFININDO POST DE -iduser-
    $_POST["iduser"] = $iduser;

    // ENVIADO DADOS DO -$_POST-
    $devices->setData($_POST);

    // SALVANDO DADOS DO PRODUTO NO BANCO
    $devices->insert();

    // REDIRECIONANDO AO -/ADMIN/USERS/{ID}/DEVICES-
    header("Location: /admin/users/$iduser/devices");
    exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$iddevice-
 * 
 * ROTA DO PAINEL DE UPDATE-DEVICES
 */
$app->get("/admin/devices/:iddevice", function($iddevice) {
    
    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);

    // INSTANCIANDO OBJETO DA CLASSE -Products-
    $devices = new Devices;

    // VERIFICANDO SE EXISTE O -idproduct- NO BANCO
    $devices->get((int)$iddevice);

    // INSTANCIANDO OBJETO DA CLASSE -PageAdmin-
    $page = new PageAdmin();

    $data = $devices->getValues();

    $desroom = Room::getNameRoom($data['idroom']);

    $rooms = Room::listAll();

    /**
    * RENDERIZANDO PAGINA 'PRODUCTS-UPDATE' ATRAVES DO SLIM
    *
    * PASSANDO UM ARRAY COM DADOS DOS -PRODUTOS-
    */ 
    $page->setTpl("devices-update",[
        "devices"=>$data,
        "desroom"=>$desroom[0]["desroom"],
        "rooms"=>$rooms
    ]);

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$iddevice-
 * 
 * ROTA DO PAINEL DE UPDATE-DEVICES
 */
$app->post("/admin/devices/:iddevice", function($iddevice) {
    
    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);

    // INSTANCIANDO OBJETO DA CLASSE -Devices-
    $devices = new Devices;

    // VERIFICANDO SE EXISTE O -iddevice- NO BANCO
    $devices->get((int)$iddevice);

    // ENVIADO DADOS DO -$_POST-
    $devices->setData($_POST);

    // SALVANDO DADOS DO PRODUTO NO BANCO
    $devices->update($iddevice);
    
    // PEGANDO IMAGEM PASSADA POR -$_FILES-
    $imageon = $_FILES["fileon"];

    $imageoff = $_FILES["fileoff"];

    // VERIFICANDO SE JA EXISTE FOTO VINCULADA AO PRODUTO
    if ($imageon["error"] != 4) {
       
        // DEFININDO IMAGEM
        $devices->setPhotoOn($imageon);

    }   

    // VERIFICANDO SE JA EXISTE FOTO VINCULADA AO PRODUTO
    if ($imageoff["error"] != 4) {
       
        // DEFININDO IMAGEM
        $devices->setPhotoOff($imageoff);

    }   

    // REDIRECIONANDO AO -/ADMIN/PRODUCTS-
    header("Location: /admin/devices");
    exit;

});

/**
 * CONFIGURANDO ROTA DO TIPO -GET-
 * 
 * RECEBE COMO PARAMETERO DENTRO DA FUNÇÃO ANONIMA O -$iddevice-
 * 
 * ROTA DO PAINEL DE DELETE-DEVICES
 */
$app->get("/admin/devices/:iddevice/delete", function($iddevice) {
    
    // VERIFICANDO SE O USUARIO ESTA LOGADO
    User::AdminVerifyLogin(TRUE);

    // INSTANCIANDO OBJETO DA CLASSE -Products-
    $device = new Devices;

    // VERIFICANDO SE EXISTE O -iddevice- NO BANCO
    $device->get((int)$iddevice);
    
    // APAGANDO DADOS DO PRODUTO DO BANCO
    $device->delete();

    // REDIRECIONANDO AO -/ADMIN/deviceS-
    header("Location: /admin/devices");
    exit;

});