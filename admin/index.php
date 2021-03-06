<?php

declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Module: Conferences
 *
 * @category        Module
 * @author          XOOPS Development Team <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GPL 2.0 or later
 */

use XoopsModules\Conferences;
use XoopsModules\Conferences\Common;

require __DIR__ . '/admin_header.php';
xoops_cp_header();
$adminObject = \Xmf\Module\Admin::getInstance();
//count "total Speakers"
/** @var \XoopsPersistableObjectHandler $speakersHandler */
$totalSpeakers = $speakersHandler->getCount();
//count "total Speeches"
/** @var \XoopsPersistableObjectHandler $speechesHandler */
$totalSpeeches = $speechesHandler->getCount();
//count "total Speechtypes"
/** @var \XoopsPersistableObjectHandler $speechtypesHandler */
$totalSpeechtypes = $speechtypesHandler->getCount();
//count "total Tracks"
/** @var \XoopsPersistableObjectHandler $tracksHandler */
$totalTracks = $tracksHandler->getCount();
//count "total Conference"
/** @var \XoopsPersistableObjectHandler $conferenceHandler */
$totalConference = $conferenceHandler->getCount();
//count "total Location"
/** @var \XoopsPersistableObjectHandler $locationHandler */
$totalLocation = $locationHandler->getCount();
// InfoBox Statistics
$adminObject->addInfoBox(AM_CONFERENCES_STATISTICS);

// InfoBox speakers
$adminObject->addInfoBoxLine(sprintf(AM_CONFERENCES_THEREARE_SPEAKERS, $totalSpeakers));

// InfoBox speeches
$adminObject->addInfoBoxLine(sprintf(AM_CONFERENCES_THEREARE_SPEECHES, $totalSpeeches));

// InfoBox speechtypes
$adminObject->addInfoBoxLine(sprintf(AM_CONFERENCES_THEREARE_SPEECHTYPE, $totalSpeechtypes));

// InfoBox tracks
$adminObject->addInfoBoxLine(sprintf(AM_CONFERENCES_THEREARE_TRACKS, $totalTracks));

// InfoBox conference
$adminObject->addInfoBoxLine(sprintf(AM_CONFERENCES_THEREARE_CONFERENCE, $totalConference));

// InfoBox location
$adminObject->addInfoBoxLine(sprintf(AM_CONFERENCES_THEREARE_LOCATION, $totalLocation));

//------ check Upload Folders ---------------
$adminObject->addConfigBoxLine('');
$redirectFile = $_SERVER['SCRIPT_NAME'];

$configurator  = new Common\Configurator();
$uploadFolders = $configurator->uploadFolders;

foreach (array_keys($uploadFolders) as $i) {
    $adminObject->addConfigBoxLine(Common\DirectoryChecker::getDirectoryStatus($uploadFolders[$i], 0777, $redirectFile));
}

// Render Index
$adminObject->displayNavigation(basename(__FILE__));

//check for latest release
//$newRelease = $utility->checkVerModule($helper);
//if (!empty($newRelease)) {
//    $adminObject->addItemButton($newRelease[0], $newRelease[1], 'download', 'style="color : Red"');
//}

//------------- Test Data ----------------------------

if ($helper->getConfig('displaySampleButton')) {
    $yamlFile            = dirname(__DIR__) . '/config/admin.yml';
    $config              = loadAdminConfig($yamlFile);
    $displaySampleButton = $config['displaySampleButton'];

    if (1 == $displaySampleButton) {
        xoops_loadLanguage('admin/modulesadmin', 'system');
        require_once dirname(__DIR__) . '/testdata/index.php';

        $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'ADD_SAMPLEDATA'), $helper->url('testdata/index.php?op=load'), 'add');
        $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'SAVE_SAMPLEDATA'), $helper->url('testdata/index.php?op=save'), 'add');
        //    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA'), $helper->url( 'testdata/index.php?op=exportschema'), 'add');
        $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'HIDE_SAMPLEDATA_BUTTONS'), '?op=hide_buttons', 'delete');
    } else {
        $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLEDATA_BUTTONS'), '?op=show_buttons', 'add');
        $displaySampleButton = $config['displaySampleButton'];
    }
    $adminObject->displayButton('left', '');;
}

//------------- End Test Data ----------------------------

$adminObject->displayIndex();

function loadAdminConfig($yamlFile)
{
    $config = \Xmf\Yaml::readWrapped($yamlFile); // work with phpmyadmin YAML dumps
    return $config;
}

function hideButtons($yamlFile)
{
    $app                        = [];
    $app['displaySampleButton'] = 0;
    \Xmf\Yaml::save($app, $yamlFile);
    redirect_header('index.php', 0, '');
}

function showButtons($yamlFile)
{
    $app                        = [];
    $app['displaySampleButton'] = 1;
    \Xmf\Yaml::save($app, $yamlFile);
    redirect_header('index.php', 0, '');
}

$op = \Xmf\Request::getString('op', 0, 'GET');

switch ($op) {
    case 'hide_buttons':
        hideButtons($yamlFile);
        break;
    case 'show_buttons':
        showButtons($yamlFile);
        break;
}

echo $utility::getServerStats();

//codeDump(__FILE__);
require __DIR__ . '/admin_footer.php';
