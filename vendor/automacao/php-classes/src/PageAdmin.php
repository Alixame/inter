<?php

namespace Vendor;

use Vendor\Page;

class PageAdmin extends Page{

    /**
     * METODO CONSTRUTOR (CHAMADO AO INSTANCIAR OBJETO)
     *
     * @param array $opts
     * @param string $tpl_dir
     */
    public function __construct($opts = array(), $tpl_dir = "/views/admin/" ){

        parent::__construct($opts, $tpl_dir);

    }

}

