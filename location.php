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
        $GLOBALS['xoopsOption']['template_main'] = 'conferences_location.tpl';
    } else {
        $GLOBALS['xoopsOption']['template_main'] = 'conferences_location_list0.tpl';
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
/** @var \XoopsPersistableObjectHandler $locationHandler */
$locationHandler = $helper->getHandler('Location');

$locationPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($locationPaginationLimit);
$criteria->setStart($start);

$locationCount = $locationHandler->getCount($criteria);
$locationArray = $locationHandler->getAll($criteria);

$id = \Xmf\Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'edit':
        $locationObject = $locationHandler->get(Request::getString('id', ''));
        $form           = $locationObject->getForm();
        $form->display();
        break;

    case 'view':
        //        viewItem();
        $locationPaginationLimit = 1;
        $myid                    = $id;
        //id
        $locationObject = $locationHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($locationPaginationLimit);
        $criteria->setStart($start);
        $location['id'] = $locationObject->getVar('id');
        /** @var \XoopsPersistableObjectHandler $conferenceHandler */
        $conferenceHandler = $helper->getHandler('Conference');

        $location['cid']     = $conferenceHandler->get($locationObject->getVar('cid'))->getVar('title');
        $location['title']   = $locationObject->getVar('title');
        $location['summary'] = $locationObject->getVar('summary');
        $location['image']   = $locationObject->getVar('image');

        //       $GLOBALS['xoopsTpl']->append('location', $location);
        $keywords[] = $locationObject->getVar('title');

        $GLOBALS['xoopsTpl']->assign('location', $location);
        $start = $id;

        // Display Navigation
        if ($locationCount > $locationPaginationLimit) {
            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/location.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($locationCount, $locationPaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();

        if ($locationCount > 0) {
            $GLOBALS['xoopsTpl']->assign('location', []);
            foreach (array_keys($locationArray) as $i) {
                $location['id'] = $locationArray[$i]->getVar('id');
                /** @var \XoopsPersistableObjectHandler $conferenceHandler */
                $conferenceHandler = $helper->getHandler('Conference');

                $location['cid']     = $conferenceHandler->get($locationArray[$i]->getVar('cid'))->getVar('title');
                $location['title']   = $locationArray[$i]->getVar('title');
                $location['summary'] = $locationArray[$i]->getVar('summary');
                $location['image']   = $locationArray[$i]->getVar('image');
                $GLOBALS['xoopsTpl']->append('location', $location);
                $keywords[] = $locationArray[$i]->getVar('title');
                unset($location);
            }
            // Display Navigation
            if ($locationCount > $locationPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/location.php');
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($locationCount, $locationPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords($helper->getConfig('keywords') . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_CONFERENCES_LOCATION_DESC);

$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/location.php');
$GLOBALS['xoopsTpl']->assign('conferences_url', CONFERENCES_URL);
$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));

$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));

$GLOBALS['xoopsTpl']->assign('admin', CONFERENCES_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);

require XOOPS_ROOT_PATH . '/footer.php';
