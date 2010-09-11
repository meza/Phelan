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
        $locator = new PhelanLocator(
            $locatorXML->getName(),
            (string) $locatorXML
        );
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
        $element  = new PhelanPageElement($atts['name']);
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
        $url  = (string) $atts['url'];
        $path = (string) $atts['path'];

        $pageObject = new PhelanPage($url, $path);
        return $pageObject;

    }//end _createPage()


}//end class

?>