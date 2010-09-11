<?php
/**
 * PhelanPage
 *
 * Holds the PhelanPage class
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
 * The PhelanPage denotes the Page element in the config
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
class PhelanPage
{

    private $_url = '';

    private $_path = '';

    public $elements = null;


    /**
     * Constructs the object.
     *
     * @param string $url  The url of the page
     * @param string $path The path of the page
     *
     * @return PhelanPage
     */
    public function __construct($url='', $path='')
    {
        $this->_url     = $url;
        $this->_path    = $path;
        $this->elements = new PhelanPageElementCollection();

    }//end __construct()


    /**
     * Adds an element to the page
     *
     * @param PhelanPageElement $element The element to add to the page
     *
     * @return void
     */
    public function addElement(PhelanPageElement $element)
    {
        $this->elements->add($element);

    }//end addElement()


    /**
     * Fetches the needed locator
     *
     * @param string $elementId   The id of the element
     * @param string $locatorType The type of the locator
     *
     * @return PhelanLocator
     */
    public function getLocator($elementId, $locatorType=null)
    {
        $element = $this->elements->get($elementId);
        if (false === $element) {
            return null;
        }

        $locator = $element->getLocator($locatorType);
        return $locator;

    }//end getLocator()


}//end class

?>