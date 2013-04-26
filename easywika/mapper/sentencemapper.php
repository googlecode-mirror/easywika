<?php
/**
 * EasyWika
 *
 * @link      http://code.google.com/p/easywika/
 * @author    Mario Schillermann (mario.schillermann@gmail.com)
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, Version 2
 */

namespace EasyWika\Mapper;

class SentenceMapper
{
    protected $_tableSurfix = 'sentence';


    public $language;
    public $translation;

    protected $_handle;

    public function __construct($database)
    {
        $this->_handle = $database->connect();
    }

    /**
     * Get table name from language
     *
     * @return string
     */
    public function getTableLanguage()
    {
        return DATABASE_PREFIX . '_' . $this->language . '_' . $this->_tableSurfix;
    }

    /**
     * Get table name from translation
     *
     * @return string
     */
    public function getTableTranslation()
    {
        return DATABASE_PREFIX . '_' . $this->translation . '_' . $this->_tableSurfix;
    }

    /**
     * Get example by pattern
     *
     * @param string $pattern
     *
     * @return array
     */
    public function findByPattern($pattern = null, $translated = true)
    {
        $result = array();

        if ($pattern === null) {
            throw new Exception('pattern is missing!');
        }
        $likePraefix = '';
        $likeSurfix = '';

        if ($translated === true) {
            $likePraefix = '%>';
            $likeSurfix = '<%';
        }
        $query = array(
            'SELECT `' . $this->getTableLanguage() . '`.`' . $this->_tableSurfix . '`AS language, `' . $this->getTableTranslation() . '`.`' . $this->_tableSurfix . '` AS translation',
            'FROM `' . $this->getTableLanguage() . '`' ,
            'LEFT JOIN `' . $this->getTableTranslation() . '`' ,
            'ON `' . $this->getTableLanguage() . '`.`id` = `' . $this->getTableTranslation() . '`.`id`',
            'WHERE `' . $this->getTableLanguage() . '`.`' . $this->_tableSurfix . '`',
            'LIKE \'' . $likePraefix . '%' . mysql_real_escape_string($pattern) . '%' . $likeSurfix . '\'',
        );

        $stmt = $this->_handle->query(implode(' ', $query));

        while($row = $stmt->fetchObject('\\EasyWika\\Entity\\SentenceEntity')) {
            $result[] = $row;
        }

        return $result;
    }

}