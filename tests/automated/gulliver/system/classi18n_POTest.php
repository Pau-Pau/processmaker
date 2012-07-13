<?php
require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php';
require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php';
require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php';
require_once PATH_TRUNK . 'gulliver/system/class.form.php';
require_once PATH_TRUNK . 'gulliver/system/class.dbconnection.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/propel/Propel.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/creole/Creole.php';
require_once PATH_TRUNK . 'gulliver/thirdparty/pear/PEAR.php';
require_once PATH_TRUNK . 'gulliver/system/class.i18n_po.php';

/**
 * Generated by ProcessMaker Test Unit Generator on 2012-07-12 at 22:32:24.
*/

class classi18n_POTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var i18n_PO
    */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
    */
    protected function setUp()
    {
        $this->object = new i18n_PO();
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
        $methods = get_class_methods('i18n_PO');        $this->assertTrue( count($methods) == 17);
    }

    /**
    * @covers i18n_PO::__construct
    * @todo   Implement test__construct().
    */
    public function test__construct()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('__construct', $methods ), 'exists method __construct' );
        $r = new ReflectionMethod('i18n_PO', '__construct');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'file');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers i18n_PO::buildInit
    * @todo   Implement testbuildInit().
    */
    public function testbuildInit()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('buildInit', $methods ), 'exists method buildInit' );
        $r = new ReflectionMethod('i18n_PO', 'buildInit');
        $params = $r->getParameters();
    } 

    /**
    * @covers i18n_PO::readInit
    * @todo   Implement testreadInit().
    */
    public function testreadInit()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('readInit', $methods ), 'exists method readInit' );
        $r = new ReflectionMethod('i18n_PO', 'readInit');
        $params = $r->getParameters();
    } 

    /**
    * @covers i18n_PO::addHeader
    * @todo   Implement testaddHeader().
    */
    public function testaddHeader()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('addHeader', $methods ), 'exists method addHeader' );
        $r = new ReflectionMethod('i18n_PO', 'addHeader');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'id');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
        $this->assertTrue( $params[1]->getName() == 'value');
        $this->assertTrue( $params[1]->isArray() == false);
        $this->assertTrue( $params[1]->isOptional () == false);
    } 

    /**
    * @covers i18n_PO::addTranslatorComment
    * @todo   Implement testaddTranslatorComment().
    */
    public function testaddTranslatorComment()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('addTranslatorComment', $methods ), 'exists method addTranslatorComment' );
        $r = new ReflectionMethod('i18n_PO', 'addTranslatorComment');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'str');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers i18n_PO::addExtractedComment
    * @todo   Implement testaddExtractedComment().
    */
    public function testaddExtractedComment()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('addExtractedComment', $methods ), 'exists method addExtractedComment' );
        $r = new ReflectionMethod('i18n_PO', 'addExtractedComment');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'str');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers i18n_PO::addReference
    * @todo   Implement testaddReference().
    */
    public function testaddReference()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('addReference', $methods ), 'exists method addReference' );
        $r = new ReflectionMethod('i18n_PO', 'addReference');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'str');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers i18n_PO::addFlag
    * @todo   Implement testaddFlag().
    */
    public function testaddFlag()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('addFlag', $methods ), 'exists method addFlag' );
        $r = new ReflectionMethod('i18n_PO', 'addFlag');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'str');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers i18n_PO::addPreviousUntranslatedString
    * @todo   Implement testaddPreviousUntranslatedString().
    */
    public function testaddPreviousUntranslatedString()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('addPreviousUntranslatedString', $methods ), 'exists method addPreviousUntranslatedString' );
        $r = new ReflectionMethod('i18n_PO', 'addPreviousUntranslatedString');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'str');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers i18n_PO::addTranslation
    * @todo   Implement testaddTranslation().
    */
    public function testaddTranslation()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('addTranslation', $methods ), 'exists method addTranslation' );
        $r = new ReflectionMethod('i18n_PO', 'addTranslation');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'msgid');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
        $this->assertTrue( $params[1]->getName() == 'msgstr');
        $this->assertTrue( $params[1]->isArray() == false);
        $this->assertTrue( $params[1]->isOptional () == false);
    } 

    /**
    * @covers i18n_PO::_writeLine
    * @todo   Implement test_writeLine().
    */
    public function test_writeLine()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('_writeLine', $methods ), 'exists method _writeLine' );
        $r = new ReflectionMethod('i18n_PO', '_writeLine');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'str');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers i18n_PO::_write
    * @todo   Implement test_write().
    */
    public function test_write()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('_write', $methods ), 'exists method _write' );
        $r = new ReflectionMethod('i18n_PO', '_write');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'str');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
    } 

    /**
    * @covers i18n_PO::prepare
    * @todo   Implement testprepare().
    */
    public function testprepare()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('prepare', $methods ), 'exists method prepare' );
        $r = new ReflectionMethod('i18n_PO', 'prepare');
        $params = $r->getParameters();
        $this->assertTrue( $params[0]->getName() == 'string');
        $this->assertTrue( $params[0]->isArray() == false);
        $this->assertTrue( $params[0]->isOptional () == false);
        $this->assertTrue( $params[1]->getName() == 'reverse');
        $this->assertTrue( $params[1]->isArray() == false);
        $this->assertTrue( $params[1]->isOptional () == true);
        $this->assertTrue( $params[1]->getDefaultValue() == '');
    } 

    /**
    * @covers i18n_PO::headerStroke
    * @todo   Implement testheaderStroke().
    */
    public function testheaderStroke()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('headerStroke', $methods ), 'exists method headerStroke' );
        $r = new ReflectionMethod('i18n_PO', 'headerStroke');
        $params = $r->getParameters();
    } 

    /**
    * @covers i18n_PO::getHeaders
    * @todo   Implement testgetHeaders().
    */
    public function testgetHeaders()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('getHeaders', $methods ), 'exists method getHeaders' );
        $r = new ReflectionMethod('i18n_PO', 'getHeaders');
        $params = $r->getParameters();
    } 

    /**
    * @covers i18n_PO::getTranslation
    * @todo   Implement testgetTranslation().
    */
    public function testgetTranslation()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('getTranslation', $methods ), 'exists method getTranslation' );
        $r = new ReflectionMethod('i18n_PO', 'getTranslation');
        $params = $r->getParameters();
    } 

    /**
    * @covers i18n_PO::__destruct
    * @todo   Implement test__destruct().
    */
    public function test__destruct()
    {
        $methods = get_class_methods($this->object);
        $this->assertTrue( in_array('__destruct', $methods ), 'exists method __destruct' );
        $r = new ReflectionMethod('i18n_PO', '__destruct');
        $params = $r->getParameters();
    } 

  } 
