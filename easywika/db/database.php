<?php
/**
 * PageShare
 *
 * @link      http://code.google.com/p/mabilis-wika/
 * @author    Mario Schillermann (mario.schillermann@gmail.com)
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, Version 2
 */

namespace EasyWika\Db;

class Database
{
    /**
     * Database instance
     *
     * @var pdo object
     */
    static private $_instance = false;

    /**
     * Database handle
     *
     * @var pdo object
     */
    static private $_handle = false;

    private function __construct()
    {

    }

    /**
     * Get database instance
     *
     * @return object pdo
     */
    static function getInstance()
    {
       if (!self::$_instance) {

           self::$_instance = new Database();
       }
       return self::$_instance;
    }

    /**
     * Connecting with database
     *
     * @return object pdo
     */
    public function connect()
    {
        if (!self::$_handle) {

            $localConfig = include APP_PATH . '/config/local.php';
            $globalConfig = include APP_PATH . '/config/global.php';
            self::$_handle = new \PDO(
                $globalConfig['db']['dsn'],
                $localConfig['db']['username'],
                $localConfig['db']['password']
            );
        }

        return self::$_handle;
    }
}