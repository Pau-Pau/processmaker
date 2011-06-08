<?php
/**
 * processes_Ajax.php
 *
 * ProcessMaker Open Source Edition
 * Copyright (C) 2004 - 2008 Colosa Inc.23
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * For more information, contact Colosa Inc, 2566 Le Jeune Rd.,
 * Coral Gables, FL, 33134, USA, or email info@colosa.com.
 *
 */
try {
  /*global $RBAC;
  switch ($RBAC->userCanAccess('PM_FACTORY'))
  {
  	case -2:
  	  G::SendTemporalMessage('ID_USER_HAVENT_RIGHTS_SYSTEM', 'error', 'labels');
  	  G::header('location: ../login/login');
  	  die;
  	break;
  	case -1:
  	  G::SendTemporalMessage('ID_USER_HAVENT_RIGHTS_PAGE', 'error', 'labels');
  	  G::header('location: ../login/login');
  	  die;
  	break;
  }*/
  $oJSON   = new Services_JSON();
  if ( isset ($_REQUEST['data']) ) {
	  $oData   = $oJSON->decode(stripslashes($_REQUEST['data']));
	  $sOutput = '';
  }

  G::LoadClass('processMap');
  $oProcessMap = new processMap(new DBConnection);

  switch($_REQUEST['action'])
  {
  	case 'load':
  	  if ($oData->ct) {
  	    $sOutput = $oProcessMap->load($oData->uid, true, $_SESSION['APPLICATION'], -1, $_SESSION['TASK'], $oData->ct);
  	  }
  	  else {
  	    if ($oData->mode) {
  	      $sOutput = $oProcessMap->load($oData->uid);
  	    }
  	    else {
  	    	$sOutput = $oProcessMap->load($oData->uid, true, $_SESSION['APPLICATION'], $_SESSION['INDEX'], $_SESSION['TASK']);
  	    }
  	  }
  	break;
  	case 'process_Edit':
  	  $oProcessMap->editProcess($oData->pro_uid);
  	break;
  	case 'process_Export':
  	  include(PATH_METHODS . 'processes/processes_Export.php');
  	break;
  	case 'process_User':
  	  include(PATH_METHODS . 'processes/processes_User.php');
  	break;
  	case 'availableProcessesUser':
  	  include(PATH_METHODS . 'processes/processes_availableProcessesUser.php');
  	break;
  	case 'webEntry_generate':
  	  include(PATH_METHODS . 'processes/processes_webEntryGenerate.php');
  	break;
        // add this event to validate de data to create a Web Entry
  	case 'webEntry_validate':
  	  include(PATH_METHODS . 'processes/processes_webEntryValidate.php');
  	break;
  	case 'webEntry_delete':
  	  $form=$_REQUEST;
  	  unlink(PATH_DATA ."sites" . PATH_SEP . SYS_SYS . PATH_SEP . "public" . PATH_SEP. $form['PRO_UID']. PATH_SEP.$form['FILENAME']);
  	  unlink(PATH_DATA ."sites" . PATH_SEP . SYS_SYS . PATH_SEP . "public" . PATH_SEP. $form['PRO_UID']. PATH_SEP .str_replace(".php","Post",$form['FILENAME']).".php");
  	  $oProcessMap->webEntry($_REQUEST['PRO_UID']);
  	break;
  	
  	case 'webEntry_new':
  	  $oProcessMap->webEntry_new($oData->PRO_UID);
  	break;
  	case 'assignProcessUser':
  	  $oProcessMap->assignProcessUser($oData->PRO_UID, $oData->USR_UID);
  	break;
  	case 'removeProcessUser':
  	  $oProcessMap->removeProcessUser($oData->PU_UID);
  	break;
  	case 'supervisorDynaforms':
  	  $oProcessMap->supervisorDynaforms($oData->pro_uid);
  	break;
  	case 'supervisorInputs':
  	  $oProcessMap->supervisorInputs($oData->pro_uid);
  	break;
  	case 'webEntry':
  	  $oProcessMap->webEntry($oData->pro_uid);
  	break;
  	
  	case 'webEntry_Val_Assig':
  	  include(PATH_METHODS . 'processes/webEntry_Val_Assig.php');
  	break;
  	
  	case 'saveTitlePosition':
  	  $sOutput = $oProcessMap->saveTitlePosition($oData->pro_uid, $oData->position->x, $oData->position->y);
  	break;
  	case 'steps':
  	  switch ($oData->option)
  	  {
  	  	case 1:
  	  	  $oProcessMap->steps($oData->proUid, $oData->tasUid);
  	  	break;
  	  	case 2:
  	  	  $oProcessMap->stepsConditions($oData->proUid, $oData->tasUid);
  	  	break;
  	  	case 3:
  	  	  $oProcessMap->stepsTriggers($oData->proUid, $oData->tasUid);
  	  	break;
  	  }
  	break;
  	case 'users':
  	  $oProcessMap->users($oData->pro_uid, $oData->tas_uid);
  	break;

  	case 'users_adhoc':
  	  $oProcessMap->users_adhoc($oData->pro_uid, $oData->tas_uid);
  	break;

  	case 'addTask':
  	  $sOutput = $oProcessMap->addTask($oData->uid, $oData->position->x, $oData->position->y);
  	break;

  	case 'addSubProcess':
  	  $sOutput = $oProcessMap->addSubProcess($oData->uid, $oData->position->x, $oData->position->y);
  	break;
        case 'taskColor':
  	  $oTask->taskColor($oData->pro_uid, $oData->tas_uid);
  	break;
       case 'addTaskHidden':
  	  $sOutput = $oProcessMap->addTaskHidden($oData->uid, $oData->position->x, $oData->position->y);
  	break;
  	case 'editTaskProperties':
  	  $oProcessMap->editTaskProperties($oData->uid, (isset($oData->iForm) ? $oData->iForm : 1), $oData->index);
  	break;
  	case 'saveTaskPosition':
  	  $sOutput = $oProcessMap->saveTaskPosition($oData->uid, $oData->position->x, $oData->position->y);
  	break;
  	case 'deleteTask':
  	  $sOutput = $oProcessMap->deleteTask($oData->tas_uid);
  	break;
  	case 'addGuide':
  	  $sOutput = $oProcessMap->addGuide($oData->uid, $oData->position, $oData->direction);
  	break;
  	case 'saveGuidePosition':
  	  $sOutput = $oProcessMap->saveGuidePosition($oData->uid, $oData->position, $oData->direction);
  	break;
  	case 'deleteGuide':
  	  $sOutput = $oProcessMap->deleteGuide($oData->uid);
  	break;
  	case 'deleteGuides':
  	  $sOutput = $oProcessMap->deleteGuides($oData->pro_uid);
  	break;
  	case 'addText':
  	  $sOutput = $oProcessMap->addText($oData->uid, $oData->label, $oData->position->x, $oData->position->y);
  	break;
  	case 'updateText':
  	  $sOutput = $oProcessMap->updateText($oData->uid, $oData->label);
  	break;
  	case 'saveTextPosition':
  	  $sOutput = $oProcessMap->saveTextPosition($oData->uid, $oData->position->x, $oData->position->y);
  	break;
  	case 'deleteText':
  	  $sOutput = $oProcessMap->deleteText($oData->uid);
  	break;
  	case 'dynaforms':
  	  $oProcessMap->dynaformsList($oData->pro_uid);
  	break;
  	case 'inputs':
  	  $oProcessMap->inputdocsList($oData->pro_uid);
  	break;
  	case 'outputs':
  	  $oProcessMap->outputdocsList($oData->pro_uid);
  	break;
  	case 'triggers':
  	  $oProcessMap->triggersList($oData->pro_uid);
  	break;
  	case 'case_scheduler':
          if(isset($_REQUEST['PRO_UID'])){
            $oProcessMap->caseSchedulerList($_REQUEST['PRO_UID']);
          }
  	break;
  	case 'log_case_scheduler':
          if(isset($_REQUEST['PRO_UID'])){
            $oProcessMap->logCaseSchedulerList($_REQUEST['PRO_UID']);
          }
  	break;
  	case 'messages':
  	  $oProcessMap->messagesList($oData->pro_uid);
  	break;
  	case 'reportTables':
  	  $oProcessMap->reportTablesList($oData->pro_uid);
  	break;
  	case 'derivations':
  	  if (!isset($oData->type)) {
  	    $oProcessMap->currentPattern($oData->pro_uid, $oData->tas_uid);
  	  }
  	  else {
  	  	switch ($oData->type) {
  	    	case 0:
  	    	  $oData->type = 'SEQUENTIAL';
  	    	break;
  	    	case 1:
  	    	  $oData->type = 'SELECT';
  	    	break;
  	    	case 2:
  	    	  $oData->type = 'EVALUATE';
  	    	break;
  	    	case 3:
  	    	  $oData->type = 'PARALLEL';
  	    	break;
  	    	case 4:
  	    	  $oData->type = 'PARALLEL-BY-EVALUATION';
  	    	break;
  	    	case 5:
  	    	  $oData->type = 'SEC-JOIN';
  	    	break;
                case 8:
  	    	  $oData->type = 'DISCRIMINATOR';
  	    	break;
  	    }
  	    $oProcessMap->newPattern($oData->pro_uid, $oData->tas_uid, $oData->next_task, $oData->type);
  	  }
  	break;
  	case 'saveNewPattern':
  	  switch ($oData->type)
  	  {
  	  	case 0:
  	  	  $sType = 'SEQUENTIAL';
  	  	break;
  	  	case 1:
  	  	  $sType = 'SELECT';
  	  	break;
  	  	case 2:
  	  	  $sType = 'EVALUATE';
  	  	break;
  	  	case 3:
  	  	  $sType = 'PARALLEL';
  	  	break;
  	  	case 4:
  	  	  $sType = 'PARALLEL-BY-EVALUATION';
  	  	break;
  	  	case 5:
  	  	  $sType = 'SEC-JOIN';
  	  	break;
                case 8:
  	  	  $sType = 'DISCRIMINATOR';
  	  	break;
  	  }
  	  if (($oData->type != 0) && ($oData->type != 5) && ($oData->type != 8)) {
  	    if ($oProcessMap->getNumberOfRoutes($oData->pro_uid, $oData->tas_uid, $oData->next_task, $sType) > 0) {
  	    	die;
  	    }
  	    unset($aRow);
  	  }
  	  if (($oData->delete) || ($oData->type == 0) || ($oData->type == 5) || ($oData->type == 8)) {
  	  	G::LoadClass('tasks');
  	  	$oTasks = new Tasks();
  	    $oTasks->deleteAllRoutesOfTask($oData->pro_uid, $oData->tas_uid);
  	    $oTasks->deleteAllGatewayOfTask($oData->pro_uid, $oData->tas_uid);
  	  }
  	  $oProcessMap->saveNewPattern($oData->pro_uid, $oData->tas_uid, $oData->next_task, $sType, $oData->delete);
  	break;
  	case 'deleteAllRoutes':
  	  G::LoadClass('tasks');
	  	$oTasks = new Tasks();
	    $oTasks->deleteAllRoutesOfTask($oData->pro_uid, $oData->tas_uid);
  	break;
  	case 'objectPermissions':
  	  $oProcessMap->objectsPermissionsList($oData->pro_uid);
  	break;
  	case 'newObjectPermission':
  	  $oProcessMap->newObjectPermission($oData->pro_uid);
  	break;
  	case 'editObjectPermission':
          // we also need the process uid variable for the function.
          $oProcessMap->editObjectPermission($oData->op_uid,$oData->pro_uid);
  	break;
  	case 'caseTracker':
  	  $oProcessMap->caseTracker($oData->pro_uid);
  	break;
  	case 'caseTrackerObjects':
  	  $oProcessMap->caseTrackerObjects($oData->pro_uid);
  	break;
  	case 'processFilesManager':
      $_SESSION['PFMDirectory'] = '';
  	  $oProcessMap->processFilesManager($oData->pro_uid);
  	break;
  	case 'exploreDirectory':
      $objData = G::json_decode($_REQUEST['data']);
      $_SESSION['PFMDirectory'] = $objData->{'main_directory'};
      $oProcessMap->exploreDirectory($oData->pro_uid, $oData->main_directory, $oData->directory);
  	break;
  	case 'deleteFile':
  	  $oProcessMap->deleteFile($oData->pro_uid, $oData->main_directory, $oData->directory, $oData->file);
  	break;
  	case 'deleteDirectory':
  	  $oProcessMap->deleteDirectory($oData->pro_uid, $oData->main_directory, $oData->directory, $oData->dir_to_delete);
  	break;
  	case 'downloadFile':
  	  $oProcessMap->downloadFile($oData->pro_uid, $oData->main_directory, $oData->directory, $oData->file);
  	break;
  	case 'deleteSubProcess':
  	  $sOutput = $oProcessMap->deleteSubProcess($oData->pro_uid, $oData->tas_uid);
  	break;
  	case 'subProcess_Properties':
  	  $oProcessMap->subProcess_Properties($oData->pro_uid, $oData->tas_uid, $oData->index);
  	break;
  	case 'showDetailsPMDWL':
  	  G::LoadClass('processes');
	  	$oProcesses = new Processes();
	  	$oProcesses->ws_open_public();
	  	$aFields   = get_object_vars($oProcesses->ws_processGetData($oData->pro_uid));

	  	$aFields['description'] = nl2br ($aFields['description']);
	  	$aFields['installSteps'] = nl2br ($aFields['installSteps']);
	  	switch ($aFields['privacy']) {
	  	  case 'FREE':
	  	    $aFields['link_label'] = G::LoadTranslation('ID_DOWNLOAD');
	  	    $aFields['link_href']  = '<A href="../processes/downloadPML?id='.$oData->pro_uid.'">'.G::LoadTranslation('ID_DOWNLOAD').'</A>';
	  	  break;
	  	  case 'PUBLIC':
	  	    require_once 'classes/model/Configuration.php';
	  	    $oCriteria = new Criteria('workflow');
	  	    $oCriteria->addSelectColumn(ConfigurationPeer::CFG_VALUE);
	  	    $oCriteria->add(ConfigurationPeer::CFG_UID, 'REGISTER_INFORMATION');
	  	    $oCriteria->add(ConfigurationPeer::USR_UID, $_SESSION['USER_LOGGED']);
	  	    if (ConfigurationPeer::doCount($oCriteria) > 0) {
	  	      $oDataset = ConfigurationPeer::doSelectRS($oCriteria);
	  	      $oDataset->setFetchmode(ResultSet::FETCHMODE_ASSOC);
            $oDataset->next();
            $aRow = $oDataset->getRow();
            $aRI  = unserialize($aRow['CFG_VALUE']);
	  	      try {
              if ($oProcesses->ws_open($aRI['u'], $aRI['p']) == 1) {
                $bExists = true;
              }
              else {
                $bExists = false;
              }
            }
            catch (Exception $oException) {
              $bExists = false;
            }
            if ($bExists) {
	  	        $aFields['link_label'] = G::LoadTranslation('ID_DOWNLOAD');
	  	        $aFields['link_href']  = '<A href="../processes/downloadPML?id='.$oData->pro_uid . '&s=' . $sessionId.'">'.G::LoadTranslation('ID_DOWNLOAD').'</A>';
	  	      }
	  	      else {
	  	        $aFields['link_label'] = G::LoadTranslation('ID_NEED_REGISTER');
	  	        $aFields['link_href']  = '<A href=javascript:registerPML("' . $oData->pro_uid . '");>'.G::LoadTranslation('ID_NEED_REGISTER').'</A>';
	  	      }
	  	    }
	  	    else {
	  	      $aFields['link_label'] = G::LoadTranslation('ID_NEED_REGISTER');
	  	      $aFields['link_href']  = '<A href=javascript:registerPML("' . $oData->pro_uid . '");>'.G::LoadTranslation('ID_NEED_REGISTER').'</A>';
	  	    }
	  	  break;
	  	}
	  	$G_PUBLISH = new Publisher;
      $G_PUBLISH->AddContent('xmlform', 'xmlform', 'processes/objectpmView', '', $aFields, '');
      G::RenderPage('publish', 'raw');
  	break;
    case 'registerPML':
      $aFields = array();
      $aFields['pro_uid'] = $oData->pro_uid;
      $aFields['link_create_account'] = PML_SERVER;
      $G_PUBLISH = new Publisher;
      $G_PUBLISH->AddContent('xmlform', 'xmlform', 'processes/registerPML', '', $aFields, '');
      G::RenderPage('publish', 'raw');
    break;
    case 'loginPML':
      G::LoadClass('processes');
      G::LoadThirdParty('pear/json','class.json');
	  	$oProcesses = new Processes();
	  	try {
        if ($oProcesses->ws_open($oData->u, $oData->p) == 1) {
          $bExists = true;
        }
        else {
          $bExists = false;
        }
      }
      catch (Exception $oException) {
        $bExists = false;
      }
      $oResponse = new stdclass();
      if ($bExists) {
        require_once 'classes/model/Configuration.php';
	  	  $oConfiguration = new Configuration();
	  	  $oConfiguration->create(array('CFG_UID'   => 'REGISTER_INFORMATION',
	  	                                'OBJ_UID'   => '',
	  	                                'CFG_VALUE' => serialize(array('u' => $oData->u, 'p' => $oData->p)),
	  	                                'PRO_UID'   => '',
	  	                                'USR_UID'   => $_SESSION['USER_LOGGED'],
	  	                                'APP_UID'   => ''));
	  	  $oResponse->sLabel = G::LoadTranslation('ID_DOWNLOAD');
	  	  $oResponse->sLink  = '../processes/downloadPML?id=' . $oData->pro_uid . '&s=' . $sessionId;
      }
      $oResponse->bExists = $bExists;
      $oJSON = new Services_JSON();
      echo $oJSON->encode($oResponse);
    break;

    case 'editFile':
    	//echo $_REQUEST['filename'];
    	global $G_PUBLISH;
	  	$G_PUBLISH = new Publisher();
      ///-- $sDirectory = PATH_DATA_MAILTEMPLATES . $_REQUEST['pro_uid'] . PATH_SEP . $_REQUEST['filename'];
      $sDir = "";
      if(isset($_SESSION['PFMDirectory']))
        $sDir = $_SESSION['PFMDirectory'];

      switch($sDir){
        case 'mailTemplates' : $sDirectory = PATH_DATA_MAILTEMPLATES . $_REQUEST['pro_uid'] . PATH_SEP . $_REQUEST['filename'];
                break;
        case 'public' : $sDirectory = PATH_DATA_PUBLIC . $_REQUEST['pro_uid'] . PATH_SEP . $_REQUEST['filename'];
                break;
        default : $sDirectory = PATH_DATA_MAILTEMPLATES . $_REQUEST['pro_uid'] . PATH_SEP . $_REQUEST['filename'];
                break;
      }
	  	$fcontent = file_get_contents($sDirectory);
			$extion=explode(".",$_REQUEST['filename']);
      
	  	//if($extion[count($extion)-1]=='html' || $extion[count($extion)-1]=='txt'){
	  	$aData = Array(
	  		'pro_uid'=>$_REQUEST['pro_uid'],
	  		'fcontent'=>$fcontent,
	  		'filename'=>$_REQUEST['filename'],
	  	);
	  	$G_PUBLISH->AddContent('xmlform', 'xmlform', 'processes/processes_FileEdit', '', $aData);
	  	G::RenderPage('publish', 'raw');
	    /*}else{ echo 'krlos';
	  		$aMessage['MESSAGE'] = G::loadTranslation(	'HTML_FILES' );
        $G_PUBLISH->AddContent ( 'xmlform', 'xmlform', 'login/showMessage', '',$aMessage );
	  		}*/
	  		
    break;
    case 'saveFile':
    	global $G_PUBLISH;
	  	$G_PUBLISH = new Publisher();
      $sDir = "";
      if(isset($_REQUEST['MAIN_DIRECTORY']))
        $sDir = $_REQUEST['MAIN_DIRECTORY'];
      switch($sDir){
        case 'mailTemplates' : $sDirectory = PATH_DATA_MAILTEMPLATES . $_REQUEST['pro_uid'] . PATH_SEP . $_REQUEST['filename'];
                break;
        case 'public' : $sDirectory = PATH_DATA_PUBLIC . $_REQUEST['pro_uid'] . PATH_SEP . $_REQUEST['filename'];
                break;
        default : $sDirectory = PATH_DATA_MAILTEMPLATES . $_REQUEST['pro_uid'] . PATH_SEP . $_REQUEST['filename'];
                break;
      }
	  	$fp = fopen($sDirectory, 'w');
	  	$content = stripslashes($_REQUEST['fcontent']);
	  	$content = str_replace("@amp@", "&", $content);
	  	fwrite($fp, $content);
	  	fclose($fp);
	  	echo 'saved: '. $sDirectory;
    break;
    case 'events':
      $oProcessMap->eventsList($oData->pro_uid, $oData->type);
    break;
/*
	case 'saveFile':
    	global $G_PUBLISH;
	  	$G_PUBLISH = new Publisher();
	  	$sDirectory = PATH_DATA_MAILTEMPLATES . $_REQUEST['pro_uid'] . PATH_SEP . $_REQUEST['filename'];

	  	$fp = fopen($sDirectory, 'w');
	  	$content = stripslashes($_REQUEST['fcontent']);
	  	$content = str_replace("@amp@", "&", $content);
	  	fwrite($fp, $content);
	  	fclose($fp);
	  	echo 'saved: '. $sDirectory;
    break;
*/
    case 'emptyFileOptions':
    	global $G_PUBLISH;
	  	$G_PUBLISH = new Publisher();
	  	$G_PUBLISH->AddContent('xmlform', 'xmlform', 'processes/processes_FileEditCreateEmpty', '');
	    G::RenderPage('publish', 'raw');
    break;
  }
  if( isset($sOutput) )
  	die($sOutput);
}
catch (Exception $oException) {
	die($oException->getMessage() . "\n" . $oException->getTraceAsString());
}
?>
