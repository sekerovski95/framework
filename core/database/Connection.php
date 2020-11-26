<?php

class Connection
{
    public static function make($config)
    {
        try {
            $pdo =  new PDO(
                $config['connection'],
                $config['username'],
                $config['password'],
                $config['options']
            );

            $dbname = "`".str_replace("`","``",$config['name'],)."`";

            $pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
            $pdo->query("use $dbname");

            $pdo->query("CREATE TABLE IF NOT EXISTS primeyear (
                id INT NOT NULL AUTO_INCREMENT,
                PRIMARY KEY(id),
                year    INT UNIQUE,
                day     VARCHAR(512)
            )");

            return $pdo;

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
