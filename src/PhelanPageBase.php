<?php
/**
 * PhelanPageBase.php
 *
 * Holds the PhelanPageBase class
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
 * The PhelanPageBase is the abstract for Phelan based tests
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
abstract class PhelanPageBase
{

    /**
     * @var PhelanPage The inner page object
     */
    private $_page;

    /**
     * @var PHPUnit_Extensions_SeleniumTestCase The selenium instance to use
     */
    private $_selenium;


    /**
     * Constructs the page
     *
     * @param string                              $configXml The config to parse
     * @param PHPUnit_Extensions_SeleniumTestCase $selenium  The selenium
     * instance to use
     */
    public function __construct(
        $configXml,
        PHPUnit_Extensions_SeleniumTestCase $selenium
    ) {
        $phelan          = new Phelan();
        $this->_page     = $phelan->getPage($configXml);
        $this->_selenium = $selenium;

    }//end __construct()


    /**
     * Get the page instance
     *
     * @return PhelanPage
     */
    protected function getPage()
    {
        return $this->_page;

    }//end getPage()


    /**
     * Gets the selenium instance
     *
     * @return PHPUnit_Extensions_SeleniumTestCase
     */
    protected function getSelenium()
    {
        return $this->_selenium;

    }//end getSelenium()


    /**
     * Return the page's url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->getPage()->getUrl();

    }//end getUrl()


    /**
     * Return the page's path
     *
     * @return String
     */
    public function getPath()
    {
        return $this->getPage()->getPath();

    }//end getPath()


    /**
     * Get a locator of the page while validating it's existence
     *
     * @param string $name The id of the element
     * @param string $type The type of the element
     *
     * @return string The locator of the element
     */
    public function getLocator($name, $type=null)
    {
        $locator  = $this->getPage()->getLocator($name, $type);
        $selenium = $this->getSelenium();

        $selenium->assertNotNull(
            $locator,
            'The received locator is null for element: '.$name
        );
        $locString = $locator->getStringFormat();
        $selenium->assertTrue(
            $selenium->isElementPresent($locString),
            'Element "'.$name.'" with locator: "'.$locString.'" was not found'
        );

        return $locString;

    }//end getLocator()


}//end class

?>