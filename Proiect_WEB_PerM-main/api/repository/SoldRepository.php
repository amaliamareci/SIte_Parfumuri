<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/api/config/config.php";

class SoldRepository
{

    public function addProductsFromCart($user)
    {
        try {
            pg_query_params(Db::getInstance()->getConnection(), "call add_products_to_sale($1);", array($user));
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }
    }

    public function getSoldRaport($category, $gender, $time)
    {
        try {
            $result = pg_query_params(Db::getInstance()->getConnection(), "select raport_sold($1,$2,$3)", array($category, $gender, $time));
            $row = pg_fetch_array($result);
            $raport_array = explode(",", substr($row[0], 1, strlen($row[0]) - 2));
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }
        return $raport_array;
    }
}
