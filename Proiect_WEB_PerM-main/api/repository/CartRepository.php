<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/api/config/config.php";

class CartRepository
{
    public function addProductToCart($username, $info_url, $quantity)
    {
        try {
            pg_query_params(
                Db::getInstance()->getConnection(),
                "call add_product_to_cart($1, $2, $3);",
                array($username, $info_url, $quantity)
            );
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }
    }

    public function getProductsFromCart($username)
    {
        try {
            $result = array();
            $query = pg_query_params(
                Db::getInstance()->getConnection(),
                "select p.info_url, p.new_price, p.manufacturer, p.name, c.quantity, p.stock from cart c join products p on c.id_product=p.id where c.id_user=(select id from users where username=$1);",
                array($username)
            );
            $row = pg_fetch_assoc($query);
            while ($row) {
                array_push($result, $row);
                $row = pg_fetch_assoc($query);
            }
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }

        return $result;
    }

    public function deleteProductFromCart($username, $product)
    {
        try {
            pg_query_params(
                Db::getInstance()->getConnection(),
                "delete from cart where id_product=(select id from products where info_url=$1) and id_user=(select id from users where username=$2);",
                array($product, $username)
            );
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }
    }
}
