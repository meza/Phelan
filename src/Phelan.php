<?php
/**
 * Phelan.php
 *
 * Holds the Phelan class
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
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'PhelanPageBase.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'PhelanLocator.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'PhelanLocatorFactory.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'PhelanBaseLocatorFactory.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'PhelanClassLocator.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'PhelanLocatorCollection.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'PhelanPage.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'PhelanPageElement.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'PhelanPageElementCollection.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'PhelanTextLocator.php';
/**
 * The Phelan class parses the Selena uixml config
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
class Phelan
{

    const LOCATOR_ID        = 'id';
    const LOCATOR_XPATH     = 'xpath';
    const LOCATOR_CLASSNAME = 'class';
    const LOCATOR_LINK      = 'link';
    const LOCATOR_NAME      = 'name';
    const LOCATOR_CSS       = 'css';
    const LOCATOR_TEXT      = 'text';

    /**
     * @var PhelanBaseLocatorFactory That will handle the locator creation
     */
    private $_locatorFactory;


    /**
     * Constructs the object
     *
     * @param PhelanLocatorFactory $customFactory A pluggable factory for
     * custom locators.
     *
     * @return Phelan
     */
    public function __construct(PhelanLocatorFactory $customFactory=null)
    {
        $this->_locatorFactory = new PhelanBaseLocatorFactory($customFactory);

    }//end __construct()


    /**
     * Parses the given xml to a PhelanPage
     *
     * @param string $xmlFilename The xml to parse
     *
     * @return PhelanPage
     */
    public function getPage($xmlFilename)
    {
        libxml_use_internal_errors(true);
        $xml      = new SimpleXMLElement(file_get_contents($xmlFilename));
        $page     = $this->_createPage($xml);
        $elements = $xml->xpath('//WebElement');
        foreach ($elements as $key => $element) {
            $page->addElement($this->_createElement($element));
        }

        return $page;

    }//end getPage()


    /**
     * Creates a PhelanLocator out of the xml node.
     *
     * @param SimpleXMLElement $locatorXML The node to process
     *
     * @return PhelanLocator
     */
    private function _createLocator(SimpleXMLElement $locatorXML)
    {
        $name    = (string) $locatorXML->getName();
        $value   = (string) $locatorXML;
        $locator = $this->_locatorFactory->createLocator($name, $value);
        return $locator;

    }//end _createLocator()


    /**
     * Creates a PhelanPageElement out of the xml node.
     *
     * @param SimpleXMLElement $elementXML The node to process
     *
     * @return PhelanPageElement
     */
    private function _createElement(SimpleXMLElement $elementXML)
    {
        $atts     = $elementXML->attributes();
        $element  = new PhelanPageElement((string) $atts['name']);
        $locators = $elementXML->xpath('Locators/*');
        foreach ($locators as $locator) {
            $element->addLocator($this->_createLocator($locator));
        }

        return $element;

    }//end _createElement()


    /**
     * Creates a PhelanPage out of the xml node.
     *
     * @param SimpleXMLElement $page The node to process
     *
     * @return PhelanPage;
     */
    private function _createPage(SimpleXMLElement $page)
    {
        $atts = $page->attributes();
        $url  = rtrim((string) $atts['url'],'/\\');
        $path = trim((string) $atts['path'], '/\\');

        $pageObject = new PhelanPage($url, $path);
        return $pageObject;

    }//end _createPage()


}//end class

?>