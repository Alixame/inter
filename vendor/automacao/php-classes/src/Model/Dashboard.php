<?php
/**
 *  DEFININDO NAMESPACE
 */
namespace Vendor\Model;

/**
 * CARRENDANDO CLASSES UTILIZANDO OS NAMESPACE
 */
use Vendor\DB\Sql;
use Vendor\Model;

// DEFINANDO CLASE Category QUE HERDA METODOS E FUNÇÕES DA CLASSE MODEL
class Dashboard extends Model {

    public static function getTotalsSales(){

        $sql = new Sql();

		$results = $sql->select("SELECT COUNT(idstatus) FROM tb_orders WHERE idstatus = 3;");

		return $results;

	}

    public static function getTotalsUsers(){

        $sql = new Sql();

		$results = $sql->select("SELECT COUNT(inadmin) FROM tb_users WHERE inadmin = 0;");

		return $results;

	}

    public static function getTotalsAccess(){

        $sql = new Sql();

		$results = $sql->select("SELECT COUNT(dessessionid) FROM tb_carts;");

		return $results;

	}

	public static function getTotalsMessages(){

        $sql = new Sql();

		$results = $sql->select("SELECT COUNT(idmessage) FROM tb_messages;");

		return $results;

	}

}

