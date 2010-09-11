<?php
/**
 * PhelanLocatorFactory.php
 *
 * Holds the PhelanLocatorFactory class
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
 * The PhelanLocatorFactory creates the locators.
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
class PhelanLocatorFactory
{


    /**
     * Create a locator by the given params.
     *
     * @param String $nodeName The node name of the locator
     * @param String $value    The value of the node
     *
     * @return PhelanClassLocator
     */
    public function createLocator($nodeName, $value)
    {
        switch(strtolower($nodeName)) {
        case Phelan::LOCATOR_CLASSNAME:
            $loc = new PhelanClassLocator('class', $value);
            return $loc;
        case Phelan::LOCATOR_CSS:
        case Phelan::LOCATOR_ID:
        case Phelan::LOCATOR_LINK:
        case Phelan::LOCATOR_NAME:
        case Phelan::LOCATOR_TEXT:
        case Phelan::LOCATOR_XPATH:
            $loc = new PhelanLocator($nodeName, $value);
            return $loc;
        default:
            $loc = new PhelanTextLocator($nodeName, $value);
            return $loc;
        }

    }//end createLocator()


}//end class

?>