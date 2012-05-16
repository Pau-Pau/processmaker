<?php 
  require_once PATH_TRUNK . 'gulliver/thirdparty/smarty/libs/Smarty.class.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlform.php'; 
  require_once PATH_TRUNK . 'gulliver/system/class.xmlDocument.php'; 
  require_once PATH_TRUNK . 'gulliver/thirdparty/propel/Propel.php' ;
  require_once PATH_TRUNK . 'gulliver/thirdparty/creole/Creole.php' ;
  require_once PATH_TRUNK . 'workflow/engine/classes/class.archive.php'; 

  /** 
   * Generated by ProcessMaker Test Unit Generator on 2012-05-10 at 20:56:17.
  */ 

  class classgzip_fileTest extends PHPUnit_Framework_TestCase 
  { 
    /**
    * @covers gzip_file::gzip_file
    * @todo   Implement testgzip_file().
    */
    public function testgzip_file() 
    { 
        if (class_exists('gzip_file')) {
             $methods = get_class_methods( 'gzip_file');
            $this->assertTrue( in_array( 'gzip_file', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers gzip_file::create_gzip
    * @todo   Implement testcreate_gzip().
    */
    public function testcreate_gzip() 
    { 
        if (class_exists('gzip_file')) {
             $methods = get_class_methods( 'gzip_file');
            $this->assertTrue( in_array( 'create_gzip', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

    /**
    * @covers gzip_file::open_archive
    * @todo   Implement testopen_archive().
    */
    public function testopen_archive() 
    { 
        if (class_exists('gzip_file')) {
             $methods = get_class_methods( 'gzip_file');
            $this->assertTrue( in_array( 'open_archive', $methods ), 'seems like this function is outside this class' ); 
        } 
    } 

  } 