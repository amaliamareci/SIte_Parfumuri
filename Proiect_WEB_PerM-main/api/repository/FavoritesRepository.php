<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/api/config/config.php";

class FavoritesRepository
{

    public function addProduct($username, $info_url)
    {
        try {
            $result = pg_query_params(
                Db::getInstance()->getConnection(),
                "insert into favorites values((select id from users where username=$1), (select id from products where info_url=$2));",
                array($username, $info_url)
            );
            $row = pg_fetch_assoc($result);
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }
    }

    public function removeProduct($username, $info_url)
    {
        try {
            $result = pg_query_params(
                Db::getInstance()->getConnection(),
                "delete from favorites where id_user=(select id from users where username=$1) and id_product=(select id from products where info_url=$2);",
                array($username, $info_url)
            );
            $row = pg_fetch_assoc($result);
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }
    }

    public function checkIsFavoriteProduct($username, $info_url)
    {
        try {
            $query = pg_query_params(
                Db::getInstance()->getConnection(),
                "select count(*) from favorites where id_user=(select id from users where username=$1) and id_product=(select id from products where info_url=$2);",
                array($username, $info_url)
            );
            $row = pg_fetch_assoc($query);
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }

        echo ($row['count']);

        return $row;
    }

    public function getAllByUsername($username)
    {
        try {
            $result = array();
            $query = pg_query_params(
                Db::getInstance()->getConnection(),
                "select info_url, old_price, new_price, name
                    from favorites f join products p on f.id_product=p.id 
                    where id_user=(select id from users where username=$1);",
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

}
