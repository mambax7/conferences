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

use Xmf\Request;

require __DIR__ . '/admin_header.php';
xoops_cp_header();
//It recovered the value of argument op in URL$
$op    = \Xmf\Request::getString('op', 'list');
$order = \Xmf\Request::getString('order', 'desc');
$sort  = \Xmf\Request::getString('sort', '');

$adminObject->displayNavigation(basename(__FILE__));
/** @var \Xmf\Module\Helper\Permission $permHelper */
$permHelper = new \Xmf\Module\Helper\Permission();
$uploadDir  = XOOPS_UPLOAD_PATH . '/conferences/tracks/';
$uploadUrl  = XOOPS_UPLOAD_URL . '/conferences/tracks/';

switch ($op) {
    case 'new':
        $adminObject->addItemButton(AM_CONFERENCES_TRACKS_LIST, 'tracks.php', 'list');
        $adminObject->displayButton('left');

        $tracksObject = $tracksHandler->create();
        $form         = $tracksObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('tracks.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 !== \Xmf\Request::getInt('id', 0)) {
            $tracksObject = $tracksHandler->get(Request::getInt('id', 0));
        } else {
            $tracksObject = $tracksHandler->create();
        }
        // Form save fields
        $tracksObject->setVar('cid', Request::getVar('cid', ''));
        $tracksObject->setVar('title', Request::getVar('title', ''));
        $tracksObject->setVar('summary', Request::getText('summary', ''));
        if ($tracksHandler->insert($tracksObject)) {
            redirect_header('tracks.php?op=list', 2, AM_CONFERENCES_FORMOK);
        }

        echo $tracksObject->getHtmlErrors();
        $form = $tracksObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(AM_CONFERENCES_ADD_TRACKS, 'tracks.php?op=new', 'add');
        $adminObject->addItemButton(AM_CONFERENCES_TRACKS_LIST, 'tracks.php', 'list');
        $adminObject->displayButton('left');
        $tracksObject = $tracksHandler->get(Request::getString('id', ''));
        $form         = $tracksObject->getForm();
        $form->display();
        break;

    case 'delete':
        $tracksObject = $tracksHandler->get(Request::getString('id', ''));
        if (1 == \Xmf\Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('tracks.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($tracksHandler->delete($tracksObject)) {
                redirect_header('tracks.php', 3, AM_CONFERENCES_FORMDELOK);
            } else {
                echo $tracksObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'id' => Request::getString('id', ''), 'op' => 'delete',], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(AM_CONFERENCES_FORMSUREDEL, $tracksObject->getVar('title')));
        }
        break;

    case 'clone':

        $id_field = \Xmf\Request::getString('id', '');

        if ($utility::cloneRecord('conferences_tracks', 'id', $id_field)) {
            redirect_header('tracks.php', 3, AM_CONFERENCES_CLONED_OK);
        } else {
            redirect_header('tracks.php', 3, AM_CONFERENCES_CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton(AM_CONFERENCES_ADD_TRACKS, 'tracks.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start                 = \Xmf\Request::getInt('start', 0);
        $tracksPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, title');
        $criteria->setOrder('ASC');
        $criteria->setLimit($tracksPaginationLimit);
        $criteria->setStart($start);
        $tracksTempRows  = $tracksHandler->getCount();
        $tracksTempArray = $tracksHandler->getAll($criteria);
        /*
        //
        //
                            <th class='center width5'>".AM_CONFERENCES_FORM_ACTION."</th>
        //                    </tr>";
        //            $class = "odd";
        */

        // Display Page Navigation
        if ($tracksTempRows > $tracksPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav(
                $tracksTempRows, $tracksPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
            );
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('tracksRows', $tracksTempRows);
        $tracksArray = [];

        //    $fields = explode('|', id:tinyint:4::NOT NULL::primary:ID:0|cid:tinyint:4::NOT NULL:::Conference:1|title:varchar:200::NOT NULL:::Title:2|summary:mediumtext:0::NULL:::Summary:3);
        //    $fieldsCount    = count($fields);

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($tracksPaginationLimit);
        $criteria->setStart($start);

        $tracksCount     = $tracksHandler->getCount($criteria);
        $tracksTempArray = $tracksHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($tracksCount > 0) {
            foreach (array_keys($tracksTempArray) as $i) {
                //        $field = explode(':', $fields[$i]);

                $GLOBALS['xoopsTpl']->assign('selectorid', AM_CONFERENCES_TRACKS_ID);
                $tracksArray['id'] = $tracksTempArray[$i]->getVar('id');

                $GLOBALS['xoopsTpl']->assign('selectorcid', AM_CONFERENCES_TRACKS_CID);
                $tracksArray['cid'] = $conferenceHandler->get($tracksTempArray[$i]->getVar('cid'))->getVar('title');

                $GLOBALS['xoopsTpl']->assign('selectortitle', AM_CONFERENCES_TRACKS_TITLE);
                $tracksArray['title'] = $tracksTempArray[$i]->getVar('title');
                $tracksArray['title'] = $utility::truncateHtml($tracksArray['title'], $helper->getConfig('truncatelength'));

                $GLOBALS['xoopsTpl']->assign('selectorsummary', AM_CONFERENCES_TRACKS_SUMMARY);
                $tracksArray['summary']     = $tracksTempArray[$i]->getVar('summary');
                $tracksArray['edit_delete'] = "<a href='tracks.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='tracks.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='tracks.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('tracksArrays', $tracksArray);
                unset($tracksArray);
            }
            unset($tracksTempArray);
            // Display Navigation
            if ($tracksCount > $tracksPaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav(
                    $tracksCount, $tracksPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
                );
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            //                     echo "<td class='center width5'>

            //                    <a href='tracks.php?op=edit&id=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
            //                    <a href='tracks.php?op=delete&id=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
            //                    </td>";

            //                echo "</tr>";

            //            }

            //            echo "</table><br><br>";

            //        } else {

            //            echo "<table width='100%' cellspacing='1' class='outer'>

            //                    <tr>

            //                     <th class='center width5'>".AM_CONFERENCES_FORM_ACTION."XXX</th>
            //                    </tr><tr><td class='errorMsg' colspan='5'>There are noXXX tracks</td></tr>";
            //            echo "</table><br><br>";

            //-------------------------------------------

            echo $GLOBALS['xoopsTpl']->fetch(
                XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/conferences_admin_tracks.tpl'
            );
        }

        break;
}
require __DIR__ . '/admin_footer.php';
