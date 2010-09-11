<?php
/**
 * PhelanLocatorCollection.php
 *
 * Holds the PhelanLocatorCollection class
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
 * The PhelanLocatorCollection holds a managed list of locators
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
class PhelanLocatorCollection
{

    /**
     * @var PhelanLocator[] List of locators the element have.
     */
    private $_locators;


    /**
     * Adds a locator to the list.
     *
     * @param PhelanLocator $locator The locator to add.
     *
     * @return void
     */
    public function add(PhelanLocator $locator)
    {
        $this->_locators[$locator->getType()] = $locator;

    }//end add()


    /**
     * The item count
     *
     * @return int
     */
    public function count()
    {
        return count($this->_locators);

    }//end count()


    /**
     * Return the first locator in the list.
     * 
     * @return PhelanLocator
     */
    public function getFirst()
    {
        if (0 === $this->count()) {
            return null;
        }

        foreach ($this->_locators as $locator) {
            return $locator;
        }

    }//end getFirst()


    /**
     * Determines if a locator with the given type exists or not.
     *
     * @param String $type the locator type to assert
     *
     * @return bool
     */
    public function hasLocator($type)
    {
        return isset($this->_locators[$type]);

    }//end hasLocator()


    /**
     * Retrieves a locator of the given type
     *
     * @param String $type The type of the locator to retrieve
     *
     * @return PhelanLocator
     */
    public function get($type)
    {
        if (false === $this->hasLocator($type)) {
            return null;
        }

        return $this->_locators[$type];

    }//end get()


}//end class

?>