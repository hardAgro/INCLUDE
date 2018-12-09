<?php
trait DatabaseConfig
{
    protected static $host;
    protected static $dbname;
    protected static $username;
    protected static $password;

    public static function databaseConfigAttributes()
    {
        $host = $_SERVER['HTTP_HOST'];

        # Put your credentials of database in production here
        self::$host = "localhost";
        self::$dbname = "comedata";
        self::$username = "root";
        self::$password = "comedata123";
    }
}