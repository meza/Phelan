<?php
/**
 * PhelanPageElement.php
 *
 * Holds the PhelanPageElement class
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
 * The PhelanPageElement is the type of a WebElement
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
class PhelanPageElement
{

    /**
     * @var PhelanLocator[] The list of locators to a given element.
     */
    private $_locators = null;


    /**
     * Construct the object
     *
     * @param String $name The name of the element.
     *
     * @return PhelanPageElement
     */
    public function __construct($name)
    {
        $this->_name     = $name;
        $this->_locators = new PhelanLocatorCollection();

    }//end __construct()


    /**
     * Returns the name of the element
     *
     * @return String
     */
    public function getName()
    {
        return $this->_name;

    }//end getName()


    /**
     * Adds a locator to the element.
     *
     * @param PhelanLocator $locator The locator to add.
     *
     * @return void
     */
    public function addLocator(PhelanLocator $locator)
    {
        $this->_locators->add($locator);

    }//end addLocator()


    /**
     * Retrieves the given locator from the list
     *
     * @param String $type The locator type to fetch. If none given,
     * the first in the list will be the result or null
     *
     * @return PhelanLocator
     */
    public function getLocator($type=null)
    {
        if (0 === $this->_locators->count()) {
            return null;
        }

        if (null === $type) {
            return $this->_locators->getFirst();
        }

        if (false === $this->_locators->hasLocator($type)) {
            return null;
        }

        return $this->_locators->get($type);

    }//end getLocator()


}//end class

?>