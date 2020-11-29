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
        $GLOBALS['xoopsOption']['template_main'] = 'conferences_tracks.tpl';
    } else {
        $GLOBALS['xoopsOption']['template_main'] = 'conferences_tracks_list0.tpl';
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
/** @var \XoopsPersistableObjectHandler $tracksHandler */
$tracksHandler = $helper->getHandler('Tracks');

$tracksPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($tracksPaginationLimit);
$criteria->setStart($start);

$tracksCount = $tracksHandler->getCount($criteria);
$tracksArray = $tracksHandler->getAll($criteria);

$id = \Xmf\Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'edit':
        $tracksObject = $tracksHandler->get(Request::getString('id', ''));
        $form         = $tracksObject->getForm();
        $form->display();
        break;

    case 'view':
        //        viewItem();
        $tracksPaginationLimit = 1;
        $myid                  = $id;
        //id
        $tracksObject = $tracksHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($tracksPaginationLimit);
        $criteria->setStart($start);
        $tracks['id'] = $tracksObject->getVar('id');
        /** @var \XoopsPersistableObjectHandler $conferenceHandler */
        $conferenceHandler = $helper->getHandler('Conference');

        $tracks['cid']     = $conferenceHandler->get($tracksObject->getVar('cid'))->getVar('title');
        $tracks['title']   = $tracksObject->getVar('title');
        $tracks['summary'] = $tracksObject->getVar('summary');

        //       $GLOBALS['xoopsTpl']->append('tracks', $tracks);
        $keywords[] = $tracksObject->getVar('title');

        $GLOBALS['xoopsTpl']->assign('tracks', $tracks);
        $start = $id;

        // Display Navigation
        if ($tracksCount > $tracksPaginationLimit) {
            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/tracks.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($tracksCount, $tracksPaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();

        if ($tracksCount > 0) {
            $GLOBALS['xoopsTpl']->assign('tracks', []);
            foreach (array_keys($tracksArray) as $i) {
                $tracks['id'] = $tracksArray[$i]->getVar('id');
                /** @var \XoopsPersistableObjectHandler $conferenceHandler */
                $conferenceHandler = $helper->getHandler('Conference');

                $tracks['cid']     = $conferenceHandler->get($tracksArray[$i]->getVar('cid'))->getVar('title');
                $tracks['title']   = $tracksArray[$i]->getVar('title');
                $tracks['title']   = $utility::truncateHtml($tracks['title'], $helper->getConfig('truncatelength'));
                $tracks['summary'] = $tracksArray[$i]->getVar('summary');
                $GLOBALS['xoopsTpl']->append('tracks', $tracks);
                $keywords[] = $tracksArray[$i]->getVar('title');
                unset($tracks);
            }
            // Display Navigation
            if ($tracksCount > $tracksPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/tracks.php');
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($tracksCount, $tracksPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords($helper->getConfig('keywords') . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_CONFERENCES_TRACKS_DESC);

$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/tracks.php');
$GLOBALS['xoopsTpl']->assign('conferences_url', CONFERENCES_URL);
$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));

$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));

$GLOBALS['xoopsTpl']->assign('admin', CONFERENCES_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);

require XOOPS_ROOT_PATH . '/footer.php';
