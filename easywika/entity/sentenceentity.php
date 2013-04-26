<?php
/**
 * EasyWika
 *
 * @link      http://code.google.com/p/easywika/
 * @author    Mario Schillermann (mario.schillermann@gmail.com)
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General public License, Version 2
 */

namespace EasyWika\Entity;

class SentenceEntity
{
    /**
     * Set table column
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    public function __set($key, $value)
    {
        switch ($key) {
            case 'language':
                $this->{$key} = $value;
                break;
            case 'translation':
                $this->{$key} = $value;
                break;
        }
    }

    /**
     * Get table column
     *
     * @param string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (isset($this->{$key})) {
            return $this->{$key};
        }
        return null;
    }

}