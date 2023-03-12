<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/api/config/config.php";
include $_SERVER['DOCUMENT_ROOT'] . "/api/entity/Product.php";

class ProductRepository
{
    public function getProductByInfoUrl($info_url)
    {
        try {
            $result = pg_query_params(Db::getInstance()->getConnection(), "select * from products where info_url=$1", array($info_url));
            $row = pg_fetch_assoc($result);
            $product = new Product(
                $row['id'],
                $row['name'],
                $row['manufacturer'],
                $row['stock'],
                $row['new_price'],
                $row['old_price'],
                $row['quantity'],
                $row['category'],
                $row['gender'],
                $row['type'],
                $row['info_url'],
                $row['release_date']
            );
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }

        return $product;
    }

    public function getIngredientsByInfoUrl($info_url)
    {
        try {
            $ingredients_query = pg_query_params(Db::getInstance()->getConnection(), "select get_ingredients($1)", array($info_url));
            $ingredients = pg_fetch_row($ingredients_query);
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }

        return $ingredients;
    }

    public function getRecommendedPerfumesForProductPage($info_url)
    {
        try {
            $recommended_products_query = pg_query_params(Db::getInstance()->getConnection(), "select recommended($1)", array($info_url));
            $recommended_products = pg_fetch_row($recommended_products_query);
            $recommended_array = explode(",", substr($recommended_products[0], 1, strlen($recommended_products[0]) - 2));
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }

        return $recommended_array;
    }

    public function getProductsByGender($gender)
    {
        try {
            $result = array();
            $query = pg_query_params(Db::getInstance()->getConnection(), "select info_url from products where gender=$1", array($gender));

            $row = pg_fetch_assoc($query);
            while ($row) {
                array_push($result, $row['info_url']);
                $row = pg_fetch_assoc($query);
            }
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }

        return $result;
    }

    public function getNewProducts()
    {
        try {
            $result = array();
            $query = pg_query(Db::getInstance()->getConnection(), "select info_url from products where to_char(release_date, 'yyyy') = to_char(current_date, 'yyyy');");
            $row = pg_fetch_assoc($query);
            while ($row) {
                array_push($result, $row['info_url']);
                $row = pg_fetch_assoc($query);
            }
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }

        return $result;
    }

    public function getSearchProducts($info_url)
    {
        try {
            $result = pg_query_params(Db::getInstance()->getConnection(), "select GETPRODUCTSFROMSEARCHBAR($1)", array($info_url));
            $row = pg_fetch_array($result);
            $search_array = explode(",", substr($row[0], 1, strlen($row[0]) - 2));
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }

        return $search_array;
    }

    public function getCustomPerfume($step1, $step2, $step3, $step4)
    {
        try {
            $query = pg_query_params(
                Db::getInstance()->getConnection(),
                "select getCustomRecommendation($1,$2,$3,$4)",
                array($step1, $step2, $step3, $step4)
            );
            $row = pg_fetch_assoc($query);
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }

        return $row['getcustomrecommendation'];
    }

    public function getFilterProducts($type, $category, $price)
    {
        try {
            $result = pg_query_params(Db::getInstance()->getConnection(), "select get_products_from_filter($1,$2,$3)", array($type, $category, $price));
            $row = pg_fetch_array($result);
            $filter_array = explode(",", substr($row[0], 1, strlen($row[0]) - 2));
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }

        return $filter_array;
    }

    public function getStockRaport($category, $gender)
    {
        try {
            $result = pg_query_params(Db::getInstance()->getConnection(), "select raport_stock($1,$2)", array($category, $gender));
            $row = pg_fetch_array($result);
            $raport_array = explode(",", substr($row[0], 1, strlen($row[0]) - 2));
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }
        return $raport_array;
    }
    public function insertProduct($name,$manufacturer,$stock,$new_price,$old_price,$quantity,$category,$gender,$type,$info_url,$realease_date,$ingredients){
        try{
            $result = pg_query_params(
                Db::getInstance()->getConnection(),
                "insert into products_view values($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12);",
                array($name,$manufacturer,$stock,$new_price,$old_price,$quantity,$category,$gender,$type,'default_product',$realease_date,$ingredients)
            );

        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }
    }
}
