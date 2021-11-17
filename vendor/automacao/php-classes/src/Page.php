<?php

namespace Vendor;

use Rain\Tpl;


class Page {

    private $tpl;

    private $options = [];

    private $defaults = [
        "header" => true,
        "footer" => true,
        "data"   => []
    ];

    /**
     * METODO CONSTRUTOR (CHAMADO AO INSTANCIAR OBJETO)
     *
     * @param array $opts
     * @param string $tpl_dir
     */
    public function __construct($opts = array(), $tpl_dir = "/views/pages/"){
        
        $this->options = array_merge($this->defaults, $opts);

        $config = array(
            'tpl_dir'   => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
            'cache_dir' => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
            'debug'     => false
        );

        Tpl::configure($config);
       
        $this->tpl = new Tpl;

        $this->setData($this->options["data"]);

        if($this->options["header"] === true ) $this->tpl->draw("header");

    }

    /**
     * METODO RESPONSAVEL POR DEFINIR DADOS
     *
     * @param array $data
     */
    private function setData($data = array()){

        foreach ($data as $key => $value) {
            $this->tpl->assign($key,$value);
        }

    }

    /**
     * METODO RESPONAVEL POR DEFINIR TPL (RENDERIZA PAGINA)
     *
     * @param $name
     * @param array $data
     * @param boolean $returnHTML
     */
    public function setTpl($name, $data = array(), $returnHTML = false){

        $this->setData($data);

        return $this->tpl->draw($name,$returnHTML);

    }

    /**
     * METODO EXECUTADO POR ULTIMO
     */
    public function __destruct(){

       if($this->options["footer"] === true ) $this->tpl->draw("footer");

    }













}