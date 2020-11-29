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
$uploadDir  = XOOPS_UPLOAD_PATH . '/conferences/conference/';
$uploadUrl  = XOOPS_UPLOAD_URL . '/conferences/conference/';

switch ($op) {
    case 'new':
        $adminObject->addItemButton(AM_CONFERENCES_CONFERENCE_LIST, 'conference.php', 'list');
        $adminObject->displayButton('left');

        $conferenceObject = $conferenceHandler->create();
        $form             = $conferenceObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('conference.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 !== \Xmf\Request::getInt('id', 0)) {
            $conferenceObject = $conferenceHandler->get(Request::getInt('id', 0));
        } else {
            $conferenceObject = $conferenceHandler->create();
        }
        // Form save fields
        $conferenceObject->setVar('title', Request::getVar('title', ''));
        $conferenceObject->setVar('subtitle', Request::getVar('subtitle', ''));
        $conferenceObject->setVar('subsubtitle', Request::getVar('subsubtitle', ''));
        $dateTimeObj = \DateTime::createFromFormat(_SHORTDATESTRING, Request::getString('sdate', '', 'POST'));

        $conferenceObject->setVar('sdate', $dateTimeObj->getTimestamp());
        $dateTimeObj = \DateTime::createFromFormat(_SHORTDATESTRING, Request::getString('edate', '', 'POST'));

        $conferenceObject->setVar('edate', $dateTimeObj->getTimestamp());
        $conferenceObject->setVar('summary', Request::getText('summary', ''));
        $conferenceObject->setVar('isdefault', ((1 == \Xmf\Request::getInt('isdefault', 0)) ? '1' : '0'));

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/conferences/conference/';
        $uploader  = new \XoopsMediaUploader(
            $uploadDir, $helper->getConfig('mimetypes'), $helper->getConfig('maxsize'), null, null
        );
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {
            //$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '' , $_FILES['attachedfile']['name']);
            //$imgName = str_replace(' ', '', $_POST['logo']).'.'.$extension;

            $uploader->setPrefix('logo_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $conferenceObject->setVar('logo', $uploader->getSavedFileName());
            }
        } else {
            $conferenceObject->setVar('logo', Request::getVar('logo', ''));
        }

        //Permissions
        //===============================================================

        $mid = $GLOBALS['xoopsModule']->mid();
        /** @var \XoopsGroupPermHandler $grouppermHandler */
        $grouppermHandler = xoops_getHandler('groupperm');
        $id               = \Xmf\Request::getInt('id', 0);

        /**
         * @param $myArray
         * @param $permissionGroup
         * @param $id
         * @param $grouppermHandler
         * @param $permissionName
         * @param $mid
         */
        function setPermissions($myArray, $permissionGroup, $id, $grouppermHandler, $permissionName, $mid)
        {
            $permissionArray = $myArray;
            if ($id > 0) {
                $sql = 'DELETE FROM `' . $GLOBALS['xoopsDB']->prefix('group_permission') . "` WHERE `gperm_name` = '" . $permissionName . "' AND `gperm_itemid`= $id;";
                $GLOBALS['xoopsDB']->query($sql);
            }
            //admin
            $gperm = $grouppermHandler->create();
            $gperm->setVar('gperm_groupid', XOOPS_GROUP_ADMIN);
            $gperm->setVar('gperm_name', $permissionName);
            $gperm->setVar('gperm_modid', $mid);
            $gperm->setVar('gperm_itemid', $id);
            $grouppermHandler->insert($gperm);
            unset($gperm);
            //non-Admin groups
            if (is_array($permissionArray)) {
                foreach ($permissionArray as $key => $cat_groupperm) {
                    if ($cat_groupperm > 0) {
                        $gperm = $grouppermHandler->create();
                        $gperm->setVar('gperm_groupid', $cat_groupperm);
                        $gperm->setVar('gperm_name', $permissionName);
                        $gperm->setVar('gperm_modid', $mid);
                        $gperm->setVar('gperm_itemid', $id);
                        $grouppermHandler->insert($gperm);
                        unset($gperm);
                    }
                }
            } elseif ($permissionArray > 0) {
                $gperm = $grouppermHandler->create();
                $gperm->setVar('gperm_groupid', $permissionArray);
                $gperm->setVar('gperm_name', $permissionName);
                $gperm->setVar('gperm_modid', $mid);
                $gperm->setVar('gperm_itemid', $id);
                $grouppermHandler->insert($gperm);
                unset($gperm);
            }
        }

        //setPermissions for View items
        $permissionGroup   = 'groupsRead';
        $permissionName    = 'conferences_view';
        $permissionArray   = \Xmf\Request::getArray($permissionGroup, '');
        $permissionArray[] = XOOPS_GROUP_ADMIN;
        //setPermissions($permissionArray, $permissionGroup, $id, $grouppermHandler, $permissionName, $mid);
        $permHelper->savePermissionForItem($permissionName, $id, $permissionArray);

        //setPermissions for Submit items
        $permissionGroup   = 'groupsSubmit';
        $permissionName    = 'conferences_submit';
        $permissionArray   = \Xmf\Request::getArray($permissionGroup, '');
        $permissionArray[] = XOOPS_GROUP_ADMIN;
        //setPermissions($permissionArray, $permissionGroup, $id, $grouppermHandler, $permissionName, $mid);
        $permHelper->savePermissionForItem($permissionName, $id, $permissionArray);

        //setPermissions for Approve items
        $permissionGroup   = 'groupsModeration';
        $permissionName    = 'conferences_approve';
        $permissionArray   = \Xmf\Request::getArray($permissionGroup, '');
        $permissionArray[] = XOOPS_GROUP_ADMIN;
        //setPermissions($permissionArray, $permissionGroup, $id, $grouppermHandler, $permissionName, $mid);
        $permHelper->savePermissionForItem($permissionName, $id, $permissionArray);

        /*
                    //Form conferences_view
                    $arr_conferences_view = \Xmf\Request::getArray('cat_gperms_read');
                    if ($id > 0) {
                        $sql
                            =
                            'DELETE FROM `' . $GLOBALS['xoopsDB']->prefix('group_permission') . "` WHERE `gperm_name`='conferences_view' AND `gperm_itemid`=$id;";
                        $GLOBALS['xoopsDB']->query($sql);
                    }
                    //admin
                    $gperm = $grouppermHandler->create();
                    $gperm->setVar('gperm_groupid', XOOPS_GROUP_ADMIN);
                    $gperm->setVar('gperm_name', 'conferences_view');
                    $gperm->setVar('gperm_modid', $mid);
                    $gperm->setVar('gperm_itemid', $id);
                    $grouppermHandler->insert($gperm);
                    unset($gperm);
                    if (is_array($arr_conferences_view)) {
                        foreach ($arr_conferences_view as $key => $cat_groupperm) {
                            $gperm = $grouppermHandler->create();
                            $gperm->setVar('gperm_groupid', $cat_groupperm);
                            $gperm->setVar('gperm_name', 'conferences_view');
                            $gperm->setVar('gperm_modid', $mid);
                            $gperm->setVar('gperm_itemid', $id);
                            $grouppermHandler->insert($gperm);
                            unset($gperm);
                        }
                    } else {
                        $gperm = $grouppermHandler->create();
                        $gperm->setVar('gperm_groupid', $arr_conferences_view);
                        $gperm->setVar('gperm_name', 'conferences_view');
                        $gperm->setVar('gperm_modid', $mid);
                        $gperm->setVar('gperm_itemid', $id);
                        $grouppermHandler->insert($gperm);
                        unset($gperm);
                    }
        */

        //===============================================================

        if ($conferenceHandler->insert($conferenceObject)) {
            redirect_header('conference.php?op=list', 2, AM_CONFERENCES_FORMOK);
        }

        echo $conferenceObject->getHtmlErrors();
        $form = $conferenceObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(AM_CONFERENCES_ADD_CONFERENCE, 'conference.php?op=new', 'add');
        $adminObject->addItemButton(AM_CONFERENCES_CONFERENCE_LIST, 'conference.php', 'list');
        $adminObject->displayButton('left');
        $conferenceObject = $conferenceHandler->get(Request::getString('id', ''));
        $form             = $conferenceObject->getForm();
        $form->display();
        break;

    case 'delete':
        $conferenceObject = $conferenceHandler->get(Request::getString('id', ''));
        if (1 == \Xmf\Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('conference.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($conferenceHandler->delete($conferenceObject)) {
                redirect_header('conference.php', 3, AM_CONFERENCES_FORMDELOK);
            } else {
                echo $conferenceObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'id' => Request::getString('id', ''), 'op' => 'delete',], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(AM_CONFERENCES_FORMSUREDEL, $conferenceObject->getVar('title')));
        }
        break;

    case 'clone':

        $id_field = \Xmf\Request::getString('id', '');

        if ($utility::cloneRecord('conferences_conference', 'id', $id_field)) {
            redirect_header('conference.php', 3, AM_CONFERENCES_CLONED_OK);
        } else {
            redirect_header('conference.php', 3, AM_CONFERENCES_CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton(AM_CONFERENCES_ADD_CONFERENCE, 'conference.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start                     = \Xmf\Request::getInt('start', 0);
        $conferencePaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, title');
        $criteria->setOrder('ASC');
        $criteria->setLimit($conferencePaginationLimit);
        $criteria->setStart($start);
        $conferenceTempRows  = $conferenceHandler->getCount();
        $conferenceTempArray = $conferenceHandler->getAll($criteria);
        /*
        //
        //
                            <th class='center width5'>".AM_CONFERENCES_FORM_ACTION."</th>
        //                    </tr>";
        //            $class = "odd";
        */

        // Display Page Navigation
        if ($conferenceTempRows > $conferencePaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav(
                $conferenceTempRows, $conferencePaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
            );
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('conferenceRows', $conferenceTempRows);
        $conferenceArray = [];

        //    $fields = explode('|', id:tinyint:4::NOT NULL::primary:ID:0|title:varchar:200::NOT NULL:::Title:1|subtitle:varchar:200::NOT NULL:::Subtitle:2|subsubtitle:varchar:200::NOT NULL:::Subsubtitle:3|sdate:int:11::NULL:::StartDate:4|edate:int:11::NULL:::EndDate:5|summary:mediumtext:0::NULL:::Summary:6|isdefault:tinyint:1::NULL:0::IsDefault:7|logo:varchar:50::NULL:::Logo:8);
        //    $fieldsCount    = count($fields);

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($conferencePaginationLimit);
        $criteria->setStart($start);

        $conferenceCount     = $conferenceHandler->getCount($criteria);
        $conferenceTempArray = $conferenceHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($conferenceCount > 0) {
            foreach (array_keys($conferenceTempArray) as $i) {
                //        $field = explode(':', $fields[$i]);

                $GLOBALS['xoopsTpl']->assign('selectorid', AM_CONFERENCES_CONFERENCE_ID);
                $conferenceArray['id'] = $conferenceTempArray[$i]->getVar('id');

                $GLOBALS['xoopsTpl']->assign('selectortitle', AM_CONFERENCES_CONFERENCE_TITLE);
                $conferenceArray['title'] = $conferenceTempArray[$i]->getVar('title');
                $conferenceArray['title'] = $utility::truncateHtml($conferenceArray['title'], $helper->getConfig('truncatelength'));

                $GLOBALS['xoopsTpl']->assign('selectorsubtitle', AM_CONFERENCES_CONFERENCE_SUBTITLE);
                $conferenceArray['subtitle'] = $conferenceTempArray[$i]->getVar('subtitle');
                $conferenceArray['subtitle'] = $utility::truncateHtml($conferenceArray['subtitle'], $helper->getConfig('truncatelength'));

                $GLOBALS['xoopsTpl']->assign('selectorsubsubtitle', AM_CONFERENCES_CONFERENCE_SUBSUBTITLE);
                $conferenceArray['subsubtitle'] = $conferenceTempArray[$i]->getVar('subsubtitle');
                $conferenceArray['subsubtitle'] = $utility::truncateHtml($conferenceArray['subsubtitle'], $helper->getConfig('truncatelength'));

                $GLOBALS['xoopsTpl']->assign('selectorsdate', AM_CONFERENCES_CONFERENCE_SDATE);
                $conferenceArray['sdate'] = formatTimestamp($conferenceTempArray[$i]->getVar('sdate'), 's');

                $GLOBALS['xoopsTpl']->assign('selectoredate', AM_CONFERENCES_CONFERENCE_EDATE);
                $conferenceArray['edate'] = formatTimestamp($conferenceTempArray[$i]->getVar('edate'), 's');

                $GLOBALS['xoopsTpl']->assign('selectorsummary', AM_CONFERENCES_CONFERENCE_SUMMARY);
                $conferenceArray['summary'] = $conferenceTempArray[$i]->getVar('summary');

                $GLOBALS['xoopsTpl']->assign('selectorisdefault', AM_CONFERENCES_CONFERENCE_ISDEFAULT);
                $conferenceArray['isdefault'] = $conferenceTempArray[$i]->getVar('isdefault');

                $GLOBALS['xoopsTpl']->assign('selectorlogo', AM_CONFERENCES_CONFERENCE_LOGO);
                $conferenceArray['logo']        = "<img src='" . $uploadUrl . $conferenceTempArray[$i]->getVar('logo') . "' name='" . 'name' . "' id=" . 'id' . " alt='' style='max-width:100px'>";
                $conferenceArray['edit_delete'] = "<a href='conference.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='conference.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='conference.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('conferenceArrays', $conferenceArray);
                unset($conferenceArray);
            }
            unset($conferenceTempArray);
            // Display Navigation
            if ($conferenceCount > $conferencePaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav(
                    $conferenceCount, $conferencePaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
                );
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            //                     echo "<td class='center width5'>

            //                    <a href='conference.php?op=edit&id=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
            //                    <a href='conference.php?op=delete&id=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
            //                    </td>";

            //                echo "</tr>";

            //            }

            //            echo "</table><br><br>";

            //        } else {

            //            echo "<table width='100%' cellspacing='1' class='outer'>

            //                    <tr>

            //                     <th class='center width5'>".AM_CONFERENCES_FORM_ACTION."XXX</th>
            //                    </tr><tr><td class='errorMsg' colspan='10'>There are noXXX conference</td></tr>";
            //            echo "</table><br><br>";

            //-------------------------------------------

            echo $GLOBALS['xoopsTpl']->fetch(
                XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/conferences_admin_conference.tpl'
            );
        }

        break;
}
require __DIR__ . '/admin_footer.php';
