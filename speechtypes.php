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
use Xmf\Request;

require __DIR__ . '/header.php';

$op = \Xmf\Request::getCmd('op', 'list');

if ('edit' !== $op) {
    if ('view' === $op) {
        $GLOBALS['xoopsOption']['template_main'] = 'conferences_speechtypes.tpl';
    } else {
        $GLOBALS['xoopsOption']['template_main'] = 'conferences_speechtypes_list0.tpl';
    }
}
require_once XOOPS_ROOT_PATH . '/header.php';

global $xoTheme;

$start = \Xmf\Request::getInt('start', 0);
// Define Stylesheet
/** @var xos_opal_Theme $xoTheme */
$xoTheme->addStylesheet($stylesheet);

$db = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsPersistableObjectHandler $speechtypesHandler */
$speechtypesHandler = $helper->getHandler('Speechtypes');

$speechtypesPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($speechtypesPaginationLimit);
$criteria->setStart($start);

$speechtypesCount = $speechtypesHandler->getCount($criteria);
$speechtypesArray = $speechtypesHandler->getAll($criteria);

$id = \Xmf\Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'edit':
        $speechtypesObject = $speechtypesHandler->get(Request::getString('id', ''));
        $form              = $speechtypesObject->getForm();
        $form->display();
        break;

    case 'view':
        //        viewItem();
        $speechtypesPaginationLimit = 1;
        $myid                       = $id;
        //id
        $speechtypesObject = $speechtypesHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($speechtypesPaginationLimit);
        $criteria->setStart($start);
        $speechtypes['id']      = $speechtypesObject->getVar('id');
        $speechtypes['name']    = $speechtypesObject->getVar('name');
        $speechtypes['color']   = $speechtypesObject->getVar('color');
        $speechtypes['plenary'] = $speechtypesObject->getVar('plenary');
        $speechtypes['logo']    = $speechtypesObject->getVar('logo');

        //       $GLOBALS['xoopsTpl']->append('speechtypes', $speechtypes);
        $keywords[] = $speechtypesObject->getVar('name');

        $GLOBALS['xoopsTpl']->assign('speechtypes', $speechtypes);
        $start = $id;

        // Display Navigation
        if ($speechtypesCount > $speechtypesPaginationLimit) {
            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/speechtypes.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($speechtypesCount, $speechtypesPaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();

        if ($speechtypesCount > 0) {
            $GLOBALS['xoopsTpl']->assign('speechtypes', []);
            foreach (array_keys($speechtypesArray) as $i) {
                $speechtypes['id']      = $speechtypesArray[$i]->getVar('id');
                $speechtypes['name']    = $speechtypesArray[$i]->getVar('name');
                $speechtypes['color']   = $speechtypesArray[$i]->getVar('color');
                $speechtypes['plenary'] = $speechtypesArray[$i]->getVar('plenary');
                $speechtypes['logo']    = $speechtypesArray[$i]->getVar('logo');
                $GLOBALS['xoopsTpl']->append('speechtypes', $speechtypes);
                $keywords[] = $speechtypesArray[$i]->getVar('name');
                unset($speechtypes);
            }
            // Display Navigation
            if ($speechtypesCount > $speechtypesPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/speechtypes.php');
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($speechtypesCount, $speechtypesPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords($helper->getConfig('keywords') . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_CONFERENCES_SPEECHTYPES_DESC);

$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/speechtypes.php');
$GLOBALS['xoopsTpl']->assign('conferences_url', CONFERENCES_URL);
$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));

$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));

$GLOBALS['xoopsTpl']->assign('admin', CONFERENCES_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);

require XOOPS_ROOT_PATH . '/footer.php';
