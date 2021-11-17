<?php

namespace Vendor;

class Model {

    private $values = [];

    /**
     * METODO RESPONSAVEL POR CRIAR DINAMICAMENTE GET E SET
     *
     * @param $name
     * @param $args
     */
    public function __call($name,$args){
        
        $method = substr($name,0,3);
        $fieldName = substr($name, 3 , strlen($name));

        switch ($method) {
            case 'set':
                $this->values[$fieldName] = $args[0];
            break;

            case 'get':
                return (isset($this->values[$fieldName])) ? $this->values[$fieldName] : NULL;
            break;
        }

    }

    /**
     * METODO RESPOSNAVEL POR DEFINIR SINTAXE DO GET E SET (METODO - CHAVE - VALOR)
     *
     * @param array $data
     */
    public function setData($data = array()){

        foreach ($data as $key => $value) {
            
            $this->{"set".$key}($value);

        }

    }

    /**
     * METODO RESPONSAVEL POR PEGAR VALOR DO OBJETO
     */
    public function getValues(){
       
        return $this->values;
    
    }



}