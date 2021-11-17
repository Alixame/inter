<?php

use \Vendor\Model\User;
use \Vendor\Model\Cart;

/**
 * METODO REPSONSAVEL POR FORMATAR UM VALOR (TROCA . POR ,)
 *
 * @param $vlprice
 */
function formatPrice($vlprice){

    return number_format($vlprice, 2, ",", ".");

}

/**
 * METODO REPSONSAVEL POR FORMATAR UMA DATA (DIA/MES/ANO)
 *
 * @param $date
 */
function formatDate($date){

	return date('d/m/Y', strtotime($date));

}

/**
 * METODO REPSONSAVEL POR VERIFICAR SE O USUARIO ESTA LOGADO
 *
 * @param boolean $inadmin
 */
function checkLogin($inadmin = true){
     
    return  User::checkLogin($inadmin);

}

/**
 * METODO RESPONSAVEL POR PEGAR NOME DO USUARIO
 */
function getUserName(){

    $user = User::getFromSession();

    return $user->getdesperson();

}

/**
 * METODO RESPONSAVEL POR PEGAR NOME DO USUARIO
 */
function getName($iduser){

    $user = new User;

    return $user->getUserNameById($iduser);

}

/**
 * METODO RESPONSAVEL POR PEGAR QUANTIDADE TOTAL NO CARRINHO
 */
function CartValueQt(){

	$cart = Cart::getFromSession();

	$totals = $cart->getProductsTotals();

	return $totals['nrqtd'];

}

/**
 * METODO RESPONSAVEL POR PEGAR VALOR TOTAL DO CARRINHO
 */
function CartValueTotal(){

	$cart = Cart::getFromSession();

	$totals = $cart->getValues();

    $total = formatPrice($totals['vlsubtotal'] +  $totals['vlfreight']);

    if ($totals['vlsubtotal'] != null){
	    
        return "R$ ".$total;
    
    } else {

        return 'Adicione um Produto!';

    }
}

/**
 * METODO REPSONSAVEL POR VERIFICAR SE POSSUI PRODUTO DENTRO DO CARRINHO
 *
 * @param Cart $cart
 */
function checkValueCart($vlsubtotal){
    
    if ($vlsubtotal == NULL) {
        
        return true;

    }

}

/**
 * METODO RESPONSAVEL POR DEBUGAR O CODIGO (VAR_DUMP PERSONALIZADO)
 *
 */
function debug($variavel){
    
    echo "<pre>";
    var_dump($variavel);
    echo "</pre>";


}