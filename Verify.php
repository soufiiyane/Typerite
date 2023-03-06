<?php
require_once 'app/Classes/BDConnection.php';

    if (isset($_GET['token'])) {
        extract($_GET);
        $connection = BDConnection::getInstance();
        $query = $connection->getConnection()->prepare(/** @lang text */'select * from user where 
            token = ?');
        $query->bindParam(1,$token);
        $query->execute();
        $user = $query->fetchObject();
        if (!$user) {

            return false;
        }
        $query = $connection->getConnection()->prepare(/** @lang text */'update user set is_verified =
            ?,token = ? where id = ?');
        $token = '';
        $verify = true;
        $query->bindParam(1, $verify);
        $query->bindParam(2,$token);
        $query->bindParam(3,$user->id);
        $query->execute();

        return true;
    }
    return false;