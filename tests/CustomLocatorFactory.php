<?php
/**
 * CustomLocatorFactory.php
 *
 * Holds the CustomLocatorFactory class
 *
 * PHP Version: PHP 5
 *
 * @category File
 * @package  Phelan
 * @author   meza <meza@meza.hu>
 * @license  GPL3.0
 *                    GNU GENERAL PUBLIC LICENSE
 *                       Version 3, 29 June 2007
 *
 * Copyright (C) 2007 Free Software Foundation, Inc. <http://fsf.org/>
 * Everyone is permitted to copy and distribute verbatim copies
 * of this license document, but changing it is not allowed.
 * @link     http://www.meza.hu
 */

/**
 * The CustomLocatorFactory class is responsible for ...
 *
 * PHP Version: PHP 5
 *
 * @category Class
 * @package  Phelan
 * @author   meza <meza@meza.hu>
 * @license  GPL3.0
 *                    GNU GENERAL PUBLIC LICENSE
 *                       Version 3, 29 June 2007
 *
 * Copyright (C) 2007 Free Software Foundation, Inc. <http://fsf.org/>
 * Everyone is permitted to copy and distribute verbatim copies
 * of this license document, but changing it is not allowed.
 * @link     http://www.meza.hu
 */
class CustomLocatorFactory implements PhelanLocatorFactory
{


    /**
     * Creates custom locators.
     *
     * @param String $nodeName The parsed node's name
     * @param String $value    The parsed node's value
     *
     * @return PhelanLocator
     */
    public function createLocator($nodeName, $value)
    {
        switch(strtolower($nodeName)) {
        case 'custom':
            $loc = new PhelanCustomLocator($nodeName, $value);
            return $loc;
        default:
            return null;
        }

    }//end createLocator()


}//end class

?>