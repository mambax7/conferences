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
        $GLOBALS['xoopsOption']['template_main'] = 'conferences_conference.tpl';
    } else {
        $GLOBALS['xoopsOption']['template_main'] = 'conferences_conference_list0.tpl';
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
/** @var \XoopsPersistableObjectHandler $conferenceHandler */
$conferenceHandler = $helper->getHandler('Conference');

$conferencePaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($conferencePaginationLimit);
$criteria->setStart($start);

$conferenceCount = $conferenceHandler->getCount($criteria);
$conferenceArray = $conferenceHandler->getAll($criteria);

$id = \Xmf\Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'edit':
        $conferenceObject = $conferenceHandler->get(Request::getString('id', ''));
        $form             = $conferenceObject->getForm();
        $form->display();
        break;

    case 'view':
        //        viewItem();
        $conferencePaginationLimit = 1;
        $myid                      = $id;
        //id
        $conferenceObject = $conferenceHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($conferencePaginationLimit);
        $criteria->setStart($start);
        $conference['id']          = $conferenceObject->getVar('id');
        $conference['title']       = $conferenceObject->getVar('title');
        $conference['subtitle']    = $conferenceObject->getVar('subtitle');
        $conference['subsubtitle'] = $conferenceObject->getVar('subsubtitle');
        $conference['sdate']       = formatTimestamp($conferenceObject->getVar('sdate'), 's');
        $conference['edate']       = formatTimestamp($conferenceObject->getVar('edate'), 's');
        $conference['summary']     = $conferenceObject->getVar('summary');
        $conference['isdefault']   = $conferenceObject->getVar('isdefault');
        $conference['logo']        = $conferenceObject->getVar('logo');

        //       $GLOBALS['xoopsTpl']->append('conference', $conference);
        $keywords[] = $conferenceObject->getVar('title');

        $GLOBALS['xoopsTpl']->assign('conference', $conference);
        $start = $id;

        // Display Navigation
        if ($conferenceCount > $conferencePaginationLimit) {
            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/conference.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($conferenceCount, $conferencePaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();

        if ($conferenceCount > 0) {
            $GLOBALS['xoopsTpl']->assign('conference', []);
            foreach (array_keys($conferenceArray) as $i) {
                $conference['id']          = $conferenceArray[$i]->getVar('id');
                $conference['title']       = $conferenceArray[$i]->getVar('title');
                $conference['title']       = $utility::truncateHtml($conference['title'], $helper->getConfig('truncatelength'));
                $conference['subtitle']    = $conferenceArray[$i]->getVar('subtitle');
                $conference['subtitle']    = $utility::truncateHtml($conference['subtitle'], $helper->getConfig('truncatelength'));
                $conference['subsubtitle'] = $conferenceArray[$i]->getVar('subsubtitle');
                $conference['subsubtitle'] = $utility::truncateHtml($conference['subsubtitle'], $helper->getConfig('truncatelength'));
                $conference['sdate']       = formatTimestamp($conferenceArray[$i]->getVar('sdate'), 's');
                $conference['edate']       = formatTimestamp($conferenceArray[$i]->getVar('edate'), 's');
                $conference['summary']     = $conferenceArray[$i]->getVar('summary');
                $conference['isdefault']   = $conferenceArray[$i]->getVar('isdefault');
                $conference['logo']        = $conferenceArray[$i]->getVar('logo');
                $GLOBALS['xoopsTpl']->append('conference', $conference);
                $keywords[] = $conferenceArray[$i]->getVar('title');
                unset($conference);
            }
            // Display Navigation
            if ($conferenceCount > $conferencePaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/conference.php');
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($conferenceCount, $conferencePaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords($helper->getConfig('keywords') . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_CONFERENCES_CONFERENCE_DESC);

$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', CONFERENCES_URL . '/conference.php');
$GLOBALS['xoopsTpl']->assign('conferences_url', CONFERENCES_URL);
$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));

$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));

$GLOBALS['xoopsTpl']->assign('admin', CONFERENCES_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);

require XOOPS_ROOT_PATH . '/footer.php';
