<?php
/**
 * EasyWika
 *
 * @link      http://code.google.com/p/easywika/
 * @author    Mario Schillermann (mario.schillermann@gmail.com)
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, Version 2
 */

namespace EasyWika\Version;

final class Version
{
    /**
     * EasyWika version identification - see compareVersion()
     */
    const VERSION = '1.0.0';

    /**
     *  Compare version
     *
     * @param  string  $version  A version string (e.g. "0.7.1").
     * @return int           -1 if the $version is older,
     *                           0 if they are the same,
     *                           and +1 if $version is newer.
     *
     */
    public static function compareVersion($version)
    {
        $version = strtolower($version);
        $version = preg_replace('/(\d)pr(\d?)/', '$1a$2', $version);

        return version_compare($version, strtolower(self::VERSION));
    }
}