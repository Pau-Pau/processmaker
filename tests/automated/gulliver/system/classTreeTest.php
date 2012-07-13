<?php
require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php';
require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php';
require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php';
require_once PATH_TRUNK . 'gulliver/system/class.form.php';
require_once PATH_TRUNK . 'gulliver/system/class.dbconnection.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/propel/Propel.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/creole/Creole.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/pear/PEAR.php';
require_once PATH_TRUNK . 'gulliver/system/class.tree.php';

/**
 * Generated by ProcessMaker Test Unit Generator on 2012-07-12 at 22:32:23.
*/

class classTreeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Tree
    */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
    */
    protected function setUp()
    {
        $this->object = new Tree();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
    */
    protected function tearDown()
    {
    }

    /**
     * This is the default method to test, if the class still having 
     * the same number of methods.
    */
    public function testNumberOfMethodsInThisClass()
    {
        $methods = get_class_methods('Tree');        $this->assertTrue( count($methods) == 14);
    }

    /**
    * @covers Tree::Tree
    * @todo   Implement testTree().
    */
    public function testTree()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('Tree', $methods ), 'exists method Tree' );
        $r = new ReflectionMethod('Tree', 'Tree');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'xmlnode');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == true);
        $this->assertTrue( $params[0]->getDefaultValue() == '');
    } 

    /**
    * @covers Tree::addChild
    * @todo   Implement testaddChild().
    */
    public function testaddChild()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('addChild', $methods ), 'exists method addChild' );
        $r = new ReflectionMethod('Tree', 'addChild');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'name');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
        $this->assertTrue( $params[1]->getName() == 'label');
        $this->assertTrue( $params[1]->isArray() == false);
        $this->assertTrue( $params[1]->isOptional () == false);
        $this->assertTrue( $params[2]->getName() == 'attributes');
        $this->assertTrue( $params[2]->isArray() == false);
        $this->assertTrue( $params[2]->isOptional () == true);
        $this->assertTrue( $params[2]->getDefaultValue() == 'Array');
    } 

    /**
    * @covers Tree::printPlus
    * @todo   Implement testprintPlus().
    */
    public function testprintPlus()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('printPlus', $methods ), 'exists method printPlus' );
        $r = new ReflectionMethod('Tree', 'printPlus');
        $params = $r->getParameters();
    } 

    /**
    * @covers Tree::printLabel
    * @todo   Implement testprintLabel().
    */
    public function testprintLabel()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('printLabel', $methods ), 'exists method printLabel' );
        $r = new ReflectionMethod('Tree', 'printLabel');
        $params = $r->getParameters();
    } 

    /**
    * @covers Tree::printContent
    * @todo   Implement testprintContent().
    */
    public function testprintContent()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('printContent', $methods ), 'exists method printContent' );
        $r = new ReflectionMethod('Tree', 'printContent');
        $params = $r->getParameters();
    } 

    /**
    * @covers Tree::render
    * @todo   Implement testrender().
    */
    public function testrender()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('render', $methods ), 'exists method render' );
        $r = new ReflectionMethod('Tree', 'render');
        $params = $r->getParameters();
    } 

  } 
