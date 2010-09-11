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
 * The PhelanPage class is responsible for ...
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

    public $elements = array();


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
        $this->_url  = $url;
        $this->_path = $path;

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
        $this->elements[] = $element;

    }//end addElement()


}//end class

?>