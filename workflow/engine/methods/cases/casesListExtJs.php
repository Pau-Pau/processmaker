<?php

  $action   = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : 'todo');

  $oHeadPublisher =& headPublisher::getSingleton();
  //$oHeadPublisher->setExtSkin( 'xtheme-blue');    
  switch ( $action ) {
  	case 'draft' :
         $config = getDraft(); 
         break;

  	case 'todo' :
  	default : 
  	     $action = 'todo';
         $config = getToDo(); 
         break;
  }

  $columns      = json_encode($config['caseColumns']);
  $readerFields = json_encode( $config['caseReaderFields']);
    	
  $oHeadPublisher->assignNumber( 'pageSize',     20 ); //sending the page size
  $oHeadPublisher->assignNumber( 'columns',      $columns ); //sending the columns to display in grid
  $oHeadPublisher->assignNumber( 'readerFields', $readerFields ); //sending the fields to get from proxy
  $oHeadPublisher->assign( 'action', $action ); //sending the fields to get from proxy
  $oHeadPublisher->assign( 'PMDateFormat', 'M d, Y' ); //sending the fields to get from proxy

  $oHeadPublisher->addExtJsScript('cases/casesList', false );    //adding a javascript file .js

  $oHeadPublisher->addContent( 'cases/casesListExtJs'); //adding a html file  .html.

  G::RenderPage('publish', 'extJs');
 
 
  function getToDo() {
    $caseColumns = array ();
    $caseColumns[] = array( 'header' =>'#',          'dataIndex' => 'APP_NUMBER',        'width' => 45, 'align' => 'center');
    $caseColumns[] = array( 'header' =>'Case',       'dataIndex' => 'APP_TITLE',         'width' => 150 );
    $caseColumns[] = array( 'header' =>'Task',       'dataIndex' => 'APP_TAS_TITLE',     'width' => 120 );
    $caseColumns[] = array( 'header' =>'Process',    'dataIndex' => 'APP_PRO_TITLE',     'width' => 120 );
    $caseColumns[] = array( 'header' =>'Sent by',    'dataIndex' => 'APP_DEL_PREVIOUS_USER', 'width' => 90 );
    $caseColumns[] = array( 'header' =>'Due Date',   'dataIndex' => 'DEL_TASK_DUE_DATE', 'width' => 110);
    $caseColumns[] = array( 'header' =>'Last Modify', 'dataIndex' => 'APP_UPDATE_DATE',  'width' => 110 );
    $caseColumns[] = array( 'header' =>'Priority',   'dataIndex' => 'DEL_PRIORITY',      'width' => 50 );
    
    $caseReaderFields = array();
    $caseReaderFields[] = array( 'name' => 'APP_UID' );
    $caseReaderFields[] = array( 'name' => 'APP_NUMBER' );
    $caseReaderFields[] = array( 'name' => 'APP_STATUS' );
    $caseReaderFields[] = array( 'name' => 'DEL_INDEX' );
    $caseReaderFields[] = array( 'name' => 'APP_TITLE' );
    $caseReaderFields[] = array( 'name' => 'APP_PRO_TITLE' );
    $caseReaderFields[] = array( 'name' => 'APP_TAS_TITLE' );
    $caseReaderFields[] = array( 'name' => 'APP_DEL_PREVIOUS_USER' );
    $caseReaderFields[] = array( 'name' => 'DEL_TASK_DUE_DATE' );
    $caseReaderFields[] = array( 'name' => 'APP_UPDATE_DATE' );
    $caseReaderFields[] = array( 'name' => 'DEL_PRIORITY' );
 
 // TEST test in daytop   
    $caseColumns[] = array( 'header' =>'Screener',   'dataIndex' => 'NAME_OF_PHONE_SCREENER',      'width' => 50 );
    $caseColumns[] = array( 'header' =>'lastname',   'dataIndex' => 'LAST_NAME',      'width' => 50 );
    $caseColumns[] = array( 'header' =>'firstname',   'dataIndex' => 'FIRST_NAME',      'width' => 50 );
    $caseColumns[] = array( 'header' =>'age',   'dataIndex' => 'AGE',      'width' => 50 );
    $caseColumns[] = array( 'header' =>'gender',   'dataIndex' => 'GENDER',      'width' => 50 );
    
    $caseReaderFields[] = array( 'name' => 'NAME_OF_PHONE_SCREENER' );
    $caseReaderFields[] = array( 'name' => 'LAST_NAME' );
    $caseReaderFields[] = array( 'name' => 'FIRST_NAME' );
    $caseReaderFields[] = array( 'name' => 'AGE' );
    $caseReaderFields[] = array( 'name' => 'GENDER' );
 // TEST test in daytop   
   
        
    return array ( 'caseColumns' => $caseColumns, 'caseReaderFields' => $caseReaderFields );  
    
    
  }
  
  function getDraft() {
    $caseColumns = array ();
    $caseColumns[] = array( 'header' =>'#',           'dataIndex' => 'APP_NUMBER',        'width' => 45, 'align' => 'center');
    $caseColumns[] = array( 'header' =>'Case',        'dataIndex' => 'APP_TITLE',         'width' => 150 );
    $caseColumns[] = array( 'header' =>'Task',        'dataIndex' => 'APP_TAS_TITLE',     'width' => 120 );
    $caseColumns[] = array( 'header' =>'Process',     'dataIndex' => 'APP_PRO_TITLE',     'width' => 120 );
    $caseColumns[] = array( 'header' =>'Due Date',    'dataIndex' => 'DEL_TASK_DUE_DATE', 'width' => 110);
    $caseColumns[] = array( 'header' =>'Last Modify', 'dataIndex' => 'APP_UPDATE_DATE',   'width' => 110 );
    $caseColumns[] = array( 'header' =>'Priority',    'dataIndex' => 'DEL_PRIORITY',      'width' => 50 );
    
    $caseReaderFields = array();
    $caseReaderFields[] = array( 'name' => 'APP_UID' );
    $caseReaderFields[] = array( 'name' => 'APP_NUMBER' );
    $caseReaderFields[] = array( 'name' => 'APP_STATUS' );
    $caseReaderFields[] = array( 'name' => 'DEL_INDEX' );
    $caseReaderFields[] = array( 'name' => 'APP_TITLE' );
    $caseReaderFields[] = array( 'name' => 'APP_PRO_TITLE' );
    $caseReaderFields[] = array( 'name' => 'APP_TAS_TITLE' );
    $caseReaderFields[] = array( 'name' => 'APP_DEL_PREVIOUS_USER' );
    $caseReaderFields[] = array( 'name' => 'DEL_TASK_DUE_DATE' );
    $caseReaderFields[] = array( 'name' => 'APP_UPDATE_DATE' );
    $caseReaderFields[] = array( 'name' => 'DEL_PRIORITY' );

 // TEST test in daytop   
    $caseColumns[] = array( 'header' =>'Screener',   'dataIndex' => 'NAME_OF_PHONE_SCREENER',      'width' => 50 );
    $caseColumns[] = array( 'header' =>'lastname',   'dataIndex' => 'LAST_NAME',      'width' => 50 );
    $caseColumns[] = array( 'header' =>'firstname',   'dataIndex' => 'FIRST_NAME',      'width' => 50 );
    $caseColumns[] = array( 'header' =>'age',   'dataIndex' => 'AGE',      'width' => 50 );
    $caseColumns[] = array( 'header' =>'gender',   'dataIndex' => 'GENDER',      'width' => 50 );
    
    $caseReaderFields[] = array( 'name' => 'NAME_OF_PHONE_SCREENER' );
    $caseReaderFields[] = array( 'name' => 'LAST_NAME' );
    $caseReaderFields[] = array( 'name' => 'FIRST_NAME' );
    $caseReaderFields[] = array( 'name' => 'AGE' );
    $caseReaderFields[] = array( 'name' => 'GENDER' );
 // TEST test in daytop   
     
    return array ( 'caseColumns' => $caseColumns, 'caseReaderFields' => $caseReaderFields );  
    
   }
  
  
  
  
  
  
  
  
  