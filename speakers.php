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
        $GLOBALS['xoopsOption']['template_main'] = 'conferences_speakers.tpl';
    } else {
        $GLOBALS['xoopsOption']['template_main'] = 'conferences_speakers_list0.tpl';
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
/** @var \XoopsPersistableObjectHandler $speakersHandler */
$speakersHandler = $helper->getHandler('Speakers');

$speakersPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($speakersPaginationLimit);
$criteria->setStart($start);

$speakersCount = $speakersHandler->getCount($criteria);
$speakersArray = $speakersHandler->getAll($criteria);

$id = \Xmf\Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'edit':
        $speakersObject = $speakersHandler->get(Request::getString('id', ''));
        $form           = $speakersObject->getForm();
        $form->display();
        break;

    case 'view':
        //        viewItem();
        $speakersPaginationLimit = 1;
        $myid                    = $id;
        //id
        $speakersObject = $speakersHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($speakersPaginationLimit);
        $criteria->setStart($start);
        $speakers['id']       = $speakersObject->getVar('id');
        $speakers['name']     = $speakersObject->getVar('name');
        $speakers['email']    = $speakersObject->getVar('email');
        $speakers['descrip']  = $speakersObject->getVar('descrip');
        $speakers['location'] = $speakersObject->getVar('location');
        $speakers['company']  = $speakersObject->getVar('company');
        $speakers['photo']    = $speakersObject->getVar('photo');
        $speakers['url']      = $speakersObject->getVar('url');
        $speakers['hits']     = $speakersObject->getVar('hits');

        //       $GLOBALS['xoopsTpl']->append('speakers', $speakers);
        $keywords[] = $speakersObject->getVar('name');

        $GLOBALS['xoopsTpl']->assign('speakers', $speakers);
        $start = $id;

        // Display Navigation
        if ($speakersCount > $speakersPaginationLimit) {
            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/speakers.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($speakersCount, $speakersPaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();

        if ($speakersCount > 0) {
            $GLOBALS['xoopsTpl']->assign('speakers', []);
            foreach (array_keys($speakersArray) as $i) {
                $speakers['id']       = $speakersArray[$i]->getVar('id');
                $speakers['name']     = $speakersArray[$i]->getVar('name');
                $speakers['email']    = $speakersArray[$i]->getVar('email');
                $speakers['descrip']  = $speakersArray[$i]->getVar('descrip');
                $speakers['location'] = $speakersArray[$i]->getVar('location');
                $speakers['company']  = $speakersArray[$i]->getVar('company');
                $speakers['photo']    = $speakersArray[$i]->getVar('photo');
                $speakers['url']      = $speakersArray[$i]->getVar('url');
                $speakers['hits']     = $speakersArray[$i]->getVar('hits');
                $GLOBALS['xoopsTpl']->append('speakers', $speakers);
                $keywords[] = $speakersArray[$i]->getVar('name');
                unset($speakers);
            }
            // Display Navigation
            if ($speakersCount > $speakersPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/speakers.php');
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($speakersCount, $speakersPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords($helper->getConfig('keywords') . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_CONFERENCES_SPEAKERS_DESC);

$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/speakers.php');
$GLOBALS['xoopsTpl']->assign('conferences_url', CONFERENCES_URL);
$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));

$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));

$GLOBALS['xoopsTpl']->assign('admin', CONFERENCES_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);

require XOOPS_ROOT_PATH . '/footer.php';
