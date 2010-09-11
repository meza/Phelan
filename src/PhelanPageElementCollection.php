<?php
/**
 * PhelanPageElementCollection.php
 *
 * Holds the PhelanPageElementCollection class
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
 * The PhelanPageElementCollection holds a managed list of the elements
 * found on a page.
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
class PhelanPageElementCollection
{

    /**
     * @var PhelanPageElement[] The element list of the page.
     */
    private $_elements;


    /**
     * Adds an element to the list.
     *
     * @param PhelanPageElement $element The element to add
     *
     * @return void
     */
    public function add(PhelanPageElement $element)
    {
        $this->_elements[$element->getName()] = $element;

    }//end add()


    /**
     * Determines if an element is set or not
     *
     * @param String $name The element ot assert
     *
     * @return bool
     */
    public function hasElement($name)
    {
        return isset($this->_elements[$name]);

    }//end hasElement()


    /**
     * Retrieves the element from the list
     *
     * @param String $name the name of the element.
     *
     * @return PhelanPageElement
     */
    public function get($name)
    {
        if (false === $this->hasElement($name)) {
            return false;
        }

        return $this->_elements[$name];

    }//end get()


}//end class

?>