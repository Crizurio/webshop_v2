<?php

namespace webshop_v2\Models;

/**
 * Create the correct PDO for the application, in this case an connecton layer
 * to Mysql will be used for all databases
 */

abstract class createPDO
{
    private const DBHOSTNAME = 'localhost';
    private const DBUSERNAME = 'root';
    private const DBNAME = 'webshopv2';
    private const PASSWORD = 'Mitch';
    private const charset = 'utf8mb4';

    public static function getPDO()
    {
        $options =
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_EMULATE_PREPARES => false
            ];

        try {
            return new \PDO(
                'mysql:host=' . self::DBHOSTNAME . ';dbname='
                . self::DBNAME . ';charset=' . self::charset,
                self::DBUSERNAME,
                self::PASSWORD,
                $options
            );
        } catch (\PDOException $error) {
            echo $error->getMessage();
        }
    }
}