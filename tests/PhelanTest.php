<?php

/**
 * PhelanTest.php
 *
 * Holds the PhelanTest class
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
 * The PhelanTest class is responsible for ...
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
class PhelanTest extends MockAmendingTestCaseBase
{

    /**
     * @var String the filename of the test xml
     */
    private $_xml;


    /**
     * Sets up the fixtures
     *
     * @return void
     */
    protected function setUp()
    {
        $this->_xml  = dirname(__FILE__).DIRECTORY_SEPARATOR;
        $this->_xml .= '_files'.DIRECTORY_SEPARATOR.'SkeletonPage.xml';

    }//end setUp()


    /**
     * Test overall parsing
     *
     * @test
     *
     * @return PhelanPage
     */
    public function testEndToEnd()
    {
        $expected = new PhelanPage('http://example.com', 'examplepath');
        $elementa = new PhelanPageElement('aNamedDiv');

        $loc = new PhelanLocator('id', 'aNamedDivsID');

        $elementa->locators = array($loc);

        $elementb = new PhelanPageElement('xpathDiv');

        $loc = new PhelanLocator('xpath', "//td[text()='somne text']");

        $elementb->locators = array($loc);

        $elementc = new PhelanPageElement('allDiv');

        $loc1 = new PhelanLocator('xpath', '//div#all');
        $loc2 = new PhelanLocator('id', 'all');
        $loc3 = new PhelanLocator('class', 'allclass');
        $loc4 = new PhelanLocator('link', 'A link value');
        $loc5 = new PhelanLocator('name', 'aFormName');
        $loc6 = new PhelanLocator('css', 'div .class');
        $loc7 = new PhelanLocator('unexisting', 'some gibberish');

        $elementc->locators = array(
                               $loc1,
                               $loc2,
                               $loc3,
                               $loc4,
                               $loc5,
                               $loc6,
                               $loc7,
                              );

        $expected->elements = array(
                               $elementa,
                               $elementb,
                               $elementc,
                              );

        $object = new Phelan();
        $actual = $object->getPage($this->_xml);

        $this->assertEquals(
            $expected,
            $actual,
            'The parsed page is not whart it should be'
        );

        return $expected;

    }//end testEndToEnd()


}//end class

?>