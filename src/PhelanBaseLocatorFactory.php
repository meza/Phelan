<?php
/**
 * PhelanBaseLocatorFactory.php
 *
 * Holds the PhelanBaseLocatorFactory class
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
 * The PhelanBaseLocatorFactory creates the locators.
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
class PhelanBaseLocatorFactory
{

    /**
     * @var PhelanLocatorFactory The users' extension
     */
    private $_factoryExtension;


    /**
     * Creates the object
     *
     * @param PhelanLocatorFactory $factory Extension
     *
     * @return PhelanBaseLocatorFactory
     */
    public function  __construct(PhelanLocatorFactory $factory=null)
    {
        $this->_factoryExtension = $factory;

    }//end __construct()


    /**
     * Create a locator by the given params.
     *
     * @param String $nodeName The node name of the locator
     * @param String $value    The value of the node
     *
     * @return PhelanClassLocator
     */
    public function createLocator($nodeName, $value)
    {
        if (true === $this->_hasDecorator()) {
            $result = $this->_factoryExtension->createLocator(
                $nodeName,
                $value
            );
            if (true === $this->_isValidResponse($result)) {
                return $result;
            }
        }

        switch(strtolower($nodeName)) {
        case Phelan::LOCATOR_CLASSNAME:
            $loc = new PhelanClassLocator('class', $value);
            return $loc;
        case Phelan::LOCATOR_CSS:
        case Phelan::LOCATOR_ID:
        case Phelan::LOCATOR_LINK:
        case Phelan::LOCATOR_NAME:
        case Phelan::LOCATOR_TEXT:
        case Phelan::LOCATOR_XPATH:
            $loc = new PhelanLocator($nodeName, $value);
            return $loc;
        default:
            $loc = new PhelanTextLocator($nodeName, $value);
            return $loc;
        }

    }//end createLocator()


    /**
     * Determines if there is an extension or not.
     *
     * @return boolean
     */
    private function _hasDecorator()
    {
        return ($this->_factoryExtension instanceof PhelanLocatorFactory);

    }//end _hasDecorator()


    /**
     * Checks if the resopsne is valid.
     *
     * @param PhelanLocator $result The result to analyze
     *
     * @return bool
     */
    private function _isValidResponse($result)
    {
        return ($result instanceof PhelanLocator);

    }//end _isValidResponse()


}//end class

?>