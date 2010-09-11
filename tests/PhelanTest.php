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
     * @var Phelan instance
     */
    protected $object;


    /**
     * Sets up the fixtures
     *
     * @return void
     */
    protected function setUp()
    {
        $this->_xml   = dirname(__FILE__).DIRECTORY_SEPARATOR;
        $this->_xml  .= '_files'.DIRECTORY_SEPARATOR.'SkeletonPage.xml';
        $this->object = new Phelan();

    }//end setUp()


    /**
     * Test overall parsing
     *
     * @test
     *
     * @group endtoend
     *
     * @return PhelanPage
     */
    public function testEndToEnd()
    {
        $producedParseResult = $this->object->getPage($this->_xml);

        $this->assertType(
            'PhelanPage',
            $producedParseResult,
            'The parsed page is not whart it should be'
        );

        return $producedParseResult;

    }//end testEndToEnd()


    /**
     * Provides input data to the getLocator's test
     *
     * @return array
     */
    public function testProvider()
    {
        return array(
                array(
                 'elementName' => 'unexistingelement',
                 'locatorType' => null,
                 'expected'    => false,
                ),
                array(
                 'elementName' => 'aNamedDiv',
                 'locatorType' => null,
                 'expected'    => 'id=aNamedDivsID',
                ),
                array(
                 'elementName' => 'aNamedDiv',
                 'locatorType' => Phelan::LOCATOR_ID,
                 'expected'    => 'id=aNamedDivsID',
                ),
                array(
                 'elementName' => 'aNamedDiv',
                 'locatorType' => 'idx',
                 'expected'    => false,
                ),
                array(
                 'elementName' => 'xpathDiv',
                 'locatorType' => null,
                 'expected'    => 'xpath=//td[text()=\'some text\']',
                ),
                array(
                 'elementName' => 'allDiv',
                 'locatorType' => null,
                 'expected'    => 'xpath=//div#all',
                ),
                array(
                 'elementName' => 'allDiv',
                 'locatorType' => Phelan::LOCATOR_XPATH,
                 'expected'    => 'xpath=//div#all',
                ),
                array(
                 'elementName' => 'allDiv',
                 'locatorType' => Phelan::LOCATOR_ID,
                 'expected'    => 'id=all',
                ),
                array(
                 'elementName' => 'allDiv',
                 'locatorType' => Phelan::LOCATOR_CLASSNAME,
                 'expected'    => 'className=allclass',
                ),
                array(
                 'elementName' => 'allDiv',
                 'locatorType' => Phelan::LOCATOR_LINK,
                 'expected'    => 'link=A link value',
                ),
                array(
                 'elementName' => 'allDiv',
                 'locatorType' => Phelan::LOCATOR_NAME,
                 'expected'    => 'name=aFormName',
                ),
                array(
                 'elementName' => 'allDiv',
                 'locatorType' => Phelan::LOCATOR_CSS,
                 'expected'    => 'css=div .class',
                ),
                array(
                 'elementName' => 'allDiv',
                 'locatorType' => 'custom',
                 'expected'    => 'text=some gibberish',
                ),
                array(
                 'elementName' => 'allDiv',
                 'locatorType' => 'unexisting locator',
                 'expected'    => false,
                ),
                array(
                 'elementName' => 'emptyElement',
                 'locatorType' => Phelan::LOCATOR_ID,
                 'expected'    => false,
                ),
                array(
                 'elementName' => 'emptyElement',
                 'locatorType' => null,
                 'expected'    => false,
                ),
               );

    }//end testProvider()


    /**
     * Test the getLocator method.
     *
     * @param String $elementId   The id of the element to fetch
     * @param String $locatorType The type of the locator to find
     * @param String $expected    The expected locator
     *
     * @test
     *
     * @dataProvider testProvider()
     *
     * @group endtoend
     *
     * @return void
     */
    public function testGetLocator(
        $elementId,
        $locatorType,
        $expected
    ) {
        $locator = $this->testEndToEnd()->getLocator(
            $elementId,
            $locatorType
        );

        $actual = null;
        if (null !== $locator) {
            $actual = $locator->getStringFormat();
        }

        $this->assertEquals(
            $expected,
            $actual,
            'The received locator does not match the expected value'
        );

    }//end testGetLocator()


    /**
     * Provides input data to the getLocator's test
     *
     * @return array
     */
    public function decoratorProvider()
    {
        return array(
                array(
                 'elementName' => 'allDiv',
                 'locatorType' => 'custom',
                 'expected'    => 'customLocator=some gibberish',
                ),
                array(
                 'elementName' => 'allDiv',
                 'locatorType' => 'unexisting locator',
                 'expected'    => false,
                ),
               );

    }//end decoratorProvider()


    /**
     * Test the getLocator method.
     *
     * @param String $elementId   The id of the element to fetch
     * @param String $locatorType The type of the locator to find
     * @param String $expected    The expected locator
     *
     * @test
     *
     * @dataProvider decoratorProvider()
     *
     * @group endtoend
     *
     * @return void
     */
    public function testGetLocatorWithDecorator(
        $elementId,
        $locatorType,
        $expected
    ) {
        $decorator    = new CustomLocatorFactory();
        $this->object = new Phelan($decorator);
        $this->testGetLocator($elementId, $locatorType, $expected);
    }


}//end class

?>