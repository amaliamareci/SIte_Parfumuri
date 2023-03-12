<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/api/config/config.php";
include $_SERVER['DOCUMENT_ROOT'] . "/api/entity/User.php";

class UserRepository
{

    public function login($username, $password)
    {
        try {
            $result = pg_query_params(Db::getInstance()->getConnection(), "select password from users where username=$1 ", array($username));
            $row = pg_fetch_assoc($result);
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }

        if ($row != NULL && password_verify($password, $row['password']))
            return true;
        return false;
    }

    public function register($password, $username, $firstname, $lastname, $gender, $address, $birthday, $email)
    {
        try {
            $conn = Db::getInstance()->getConnection();
            $result = pg_query_params(
                $conn,
                "insert into users values((select coalesce(max(id),0) + 1 from users), $1, $2, $3, $4, $5, $6, $7, $8)",
                array($password, $username, $firstname, $lastname, $gender, $address, $birthday, $email)
            ) or die(pg_last_error($conn));
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }
    }
    public function changePassword($username, $password_old, $password_new)
    {
        try {
            $result = pg_query_params(Db::getInstance()->getConnection(), "select password from users where username=$1 ", array($username));
            $row = pg_fetch_assoc($result);
            if ($row != NULL && password_verify($password_old, $row['password']))
                $result = pg_query_params(
                    Db::getInstance()->getConnection(),
                    "UPDATE users SET password = $1 WHERE username = $2; ",
                    array(password_hash($password_new, PASSWORD_DEFAULT),$username)
                );
            else return false;
        } catch (PDOException $e) {
            trigger_error("Error in " . __METHOD__ . ": " . $e->getMessage(), E_USER_ERROR);
        }
        return true;
    }
}
