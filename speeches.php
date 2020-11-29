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
        $GLOBALS['xoopsOption']['template_main'] = 'conferences_speeches.tpl';
    } else {
        $GLOBALS['xoopsOption']['template_main'] = 'conferences_speeches_list0.tpl';
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
/** @var \XoopsPersistableObjectHandler $speechesHandler */
$speechesHandler = $helper->getHandler('Speeches');

$speechesPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($speechesPaginationLimit);
$criteria->setStart($start);

$speechesCount = $speechesHandler->getCount($criteria);
$speechesArray = $speechesHandler->getAll($criteria);

$id = \Xmf\Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'edit':
        $speechesObject = $speechesHandler->get(Request::getString('id', ''));
        $form           = $speechesObject->getForm();
        $form->display();
        break;

    case 'view':
        //        viewItem();
        $speechesPaginationLimit = 1;
        $myid                    = $id;
        //id
        $speechesObject = $speechesHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($speechesPaginationLimit);
        $criteria->setStart($start);
        $speeches['id'] = $speechesObject->getVar('id');
        /** @var \XoopsPersistableObjectHandler $speechtypesHandler */
        $speechtypesHandler = $helper->getHandler('Speechtypes');

        $speeches['typeid']   = $speechtypesHandler->get($speechesObject->getVar('typeid'))->getVar('name');
        $speeches['title']    = $speechesObject->getVar('title');
        $speeches['summary']  = $speechesObject->getVar('summary');
        $speeches['stime']    = formatTimestamp($speechesObject->getVar('stime'), 's');
        $speeches['etime']    = formatTimestamp($speechesObject->getVar('etime'), 's');
        $speeches['duration'] = $speechesObject->getVar('duration');
        /** @var \XoopsPersistableObjectHandler $speakersHandler */
        $speakersHandler = $helper->getHandler('Speakers');

        $speeches['speakerid'] = $speakersHandler->get($speechesObject->getVar('speakerid'))->getVar('name');
        /** @var \XoopsPersistableObjectHandler $conferenceHandler */
        $conferenceHandler = $helper->getHandler('Conference');

        $speeches['cid'] = $conferenceHandler->get($speechesObject->getVar('cid'))->getVar('title');
        /** @var \XoopsPersistableObjectHandler $tracksHandler */
        $tracksHandler = $helper->getHandler('Tracks');

        $speeches['tid']     = $tracksHandler->get($speechesObject->getVar('tid'))->getVar('title');
        $speeches['slides1'] = $speechesObject->getVar('slides1');
        $speeches['slides2'] = $speechesObject->getVar('slides2');
        $speeches['slides3'] = $speechesObject->getVar('slides3');
        $speeches['slides4'] = $speechesObject->getVar('slides4');

        //       $GLOBALS['xoopsTpl']->append('speeches', $speeches);
        $keywords[] = $speechesObject->getVar('title');

        $GLOBALS['xoopsTpl']->assign('speeches', $speeches);
        $start = $id;

        // Display Navigation
        if ($speechesCount > $speechesPaginationLimit) {
            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/speeches.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($speechesCount, $speechesPaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();

        if ($speechesCount > 0) {
            $GLOBALS['xoopsTpl']->assign('speeches', []);
            foreach (array_keys($speechesArray) as $i) {
                $speeches['id'] = $speechesArray[$i]->getVar('id');
                /** @var \XoopsPersistableObjectHandler $speechtypesHandler */
                $speechtypesHandler = $helper->getHandler('Speechtypes');

                $speeches['typeid']   = $speechtypesHandler->get($speechesArray[$i]->getVar('typeid'))->getVar('name');
                $speeches['title']    = $speechesArray[$i]->getVar('title');
                $speeches['title']    = $utility::truncateHtml($speeches['title'], $helper->getConfig('truncatelength'));
                $speeches['summary']  = $speechesArray[$i]->getVar('summary');
                $speeches['stime']    = formatTimestamp($speechesArray[$i]->getVar('stime'), 's');
                $speeches['etime']    = formatTimestamp($speechesArray[$i]->getVar('etime'), 's');
                $speeches['duration'] = $speechesArray[$i]->getVar('duration');
                /** @var \XoopsPersistableObjectHandler $speakersHandler */
                $speakersHandler = $helper->getHandler('Speakers');

                $speeches['speakerid'] = $speakersHandler->get($speechesArray[$i]->getVar('speakerid'))->getVar('name');
                /** @var \XoopsPersistableObjectHandler $conferenceHandler */
                $conferenceHandler = $helper->getHandler('Conference');

                $speeches['cid'] = $conferenceHandler->get($speechesArray[$i]->getVar('cid'))->getVar('title');
                /** @var \XoopsPersistableObjectHandler $tracksHandler */
                $tracksHandler = $helper->getHandler('Tracks');

                $speeches['tid']     = $tracksHandler->get($speechesArray[$i]->getVar('tid'))->getVar('title');
                $speeches['slides1'] = $speechesArray[$i]->getVar('slides1');
                $speeches['slides2'] = $speechesArray[$i]->getVar('slides2');
                $speeches['slides3'] = $speechesArray[$i]->getVar('slides3');
                $speeches['slides4'] = $speechesArray[$i]->getVar('slides4');
                $GLOBALS['xoopsTpl']->append('speeches', $speeches);
                $keywords[] = $speechesArray[$i]->getVar('title');
                unset($speeches);
            }
            // Display Navigation
            if ($speechesCount > $speechesPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/speeches.php');
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($speechesCount, $speechesPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords($helper->getConfig('keywords') . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_CONFERENCES_SPEECHES_DESC);

$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/speeches.php');
$GLOBALS['xoopsTpl']->assign('conferences_url', CONFERENCES_URL);
$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));

$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));

$GLOBALS['xoopsTpl']->assign('admin', CONFERENCES_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);

require XOOPS_ROOT_PATH . '/footer.php';
