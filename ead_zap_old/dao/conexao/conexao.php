<?php

abstract class Conexao {

    private static $instance;

    /**
     * 
     * @return PDO     
     */
    public static function getInstance() {
        try {
            if (!isset(self::$instance)) {
                self::$instance = new PDO("mysql:host=localhost;charset=utf8mb4;dbname=eadzap", "eadzapSuperApprova", "eadzap.superapprova.com.br");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$instance;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}

