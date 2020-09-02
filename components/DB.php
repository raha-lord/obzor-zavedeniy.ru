<?php
        class DB
        {
            public static function getConnection()
            {
                $paramsPatch =  ROOT.'/config/db_params.php';
                $params = include ($paramsPatch);
                $db = new PDO("mysql:host={$params['host']};dbname={$params['dbname']};charset=UTF8", $params['user'], $params['password']);

                return $db;
            }

        }