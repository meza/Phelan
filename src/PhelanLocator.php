<?php
/**
 * PhelanLocator.php
 *
 * Holds the PhelanLocator class
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
 * The PhelanLocator class is the parent of all locators
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
class PhelanLocator
{

    /**
     * @var String the type of the locator
     */
    private $_type;

    /**
     * @var String the value of the locator
     */
    private $_value;


    /**
     * Constructs the object
     *
     * @param String $type  The type of the locator
     * @param String $value The value of the locator
     *
     * @return PhelanLocator
     */
    public function __construct($type, $value)
    {
        $this->_type  = $type;
        $this->_value = $value;

    }//end __construct()


    /**
     * Return the string fformat of the locator.
     * 
     * @return string
     */
    public function getStringFormat()
    {
        return $this->getType().'='.$this->getValue();

    }//end getStringFormat()


    /**
     * Retrieves the type of the Locator.
     *
     * @return String
     */
    public function getType()
    {
        return $this->_type;

    }//end getType()


    /**
     * Retrieves the value of the Locator.
     *
     * @return String
     */
    public function getValue()
    {
        return $this->_value;

    }//end getValue()


}//end class

?>