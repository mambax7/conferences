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
$uploadDir  = XOOPS_UPLOAD_PATH . '/conferences/location/';
$uploadUrl  = XOOPS_UPLOAD_URL . '/conferences/location/';

switch ($op) {
    case 'new':
        $adminObject->addItemButton(AM_CONFERENCES_LOCATION_LIST, 'location.php', 'list');
        $adminObject->displayButton('left');

        $locationObject = $locationHandler->create();
        $form           = $locationObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('location.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 !== \Xmf\Request::getInt('id', 0)) {
            $locationObject = $locationHandler->get(Request::getInt('id', 0));
        } else {
            $locationObject = $locationHandler->create();
        }
        // Form save fields
        $locationObject->setVar('cid', Request::getVar('cid', ''));
        $locationObject->setVar('title', Request::getVar('title', ''));
        $locationObject->setVar('summary', Request::getText('summary', ''));

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/conferences/location/';
        $uploader  = new \XoopsMediaUploader(
            $uploadDir, $helper->getConfig('mimetypes'), $helper->getConfig('maxsize'), null, null
        );
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {
            //$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '' , $_FILES['attachedfile']['name']);
            //$imgName = str_replace(' ', '', $_POST['image']).'.'.$extension;

            $uploader->setPrefix('image_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $locationObject->setVar('image', $uploader->getSavedFileName());
            }
        } else {
            $locationObject->setVar('image', Request::getVar('image', ''));
        }

        if ($locationHandler->insert($locationObject)) {
            redirect_header('location.php?op=list', 2, AM_CONFERENCES_FORMOK);
        }

        echo $locationObject->getHtmlErrors();
        $form = $locationObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(AM_CONFERENCES_ADD_LOCATION, 'location.php?op=new', 'add');
        $adminObject->addItemButton(AM_CONFERENCES_LOCATION_LIST, 'location.php', 'list');
        $adminObject->displayButton('left');
        $locationObject = $locationHandler->get(Request::getString('id', ''));
        $form           = $locationObject->getForm();
        $form->display();
        break;

    case 'delete':
        $locationObject = $locationHandler->get(Request::getString('id', ''));
        if (1 == \Xmf\Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('location.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($locationHandler->delete($locationObject)) {
                redirect_header('location.php', 3, AM_CONFERENCES_FORMDELOK);
            } else {
                echo $locationObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'id' => Request::getString('id', ''), 'op' => 'delete',], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(AM_CONFERENCES_FORMSUREDEL, $locationObject->getVar('title')));
        }
        break;

    case 'clone':

        $id_field = \Xmf\Request::getString('id', '');

        if ($utility::cloneRecord('conferences_location', 'id', $id_field)) {
            redirect_header('location.php', 3, AM_CONFERENCES_CLONED_OK);
        } else {
            redirect_header('location.php', 3, AM_CONFERENCES_CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton(AM_CONFERENCES_ADD_LOCATION, 'location.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start                   = \Xmf\Request::getInt('start', 0);
        $locationPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, title');
        $criteria->setOrder('ASC');
        $criteria->setLimit($locationPaginationLimit);
        $criteria->setStart($start);
        $locationTempRows  = $locationHandler->getCount();
        $locationTempArray = $locationHandler->getAll($criteria);
        /*
        //
        //
                            <th class='center width5'>".AM_CONFERENCES_FORM_ACTION."</th>
        //                    </tr>";
        //            $class = "odd";
        */

        // Display Page Navigation
        if ($locationTempRows > $locationPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav(
                $locationTempRows, $locationPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
            );
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('locationRows', $locationTempRows);
        $locationArray = [];

        //    $fields = explode('|', id:tinyint:4::NOT NULL::primary:ID:0|cid:tinyint:4::NOT NULL:::Conference:1|title:varchar:200::NOT NULL:::Title:2|summary:mediumtext:0::NULL:::Summary:3|image:varchar:50::NULL:::Image:4);
        //    $fieldsCount    = count($fields);

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($locationPaginationLimit);
        $criteria->setStart($start);

        $locationCount     = $locationHandler->getCount($criteria);
        $locationTempArray = $locationHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($locationCount > 0) {
            foreach (array_keys($locationTempArray) as $i) {
                //        $field = explode(':', $fields[$i]);

                $GLOBALS['xoopsTpl']->assign('selectorid', AM_CONFERENCES_LOCATION_ID);
                $locationArray['id'] = $locationTempArray[$i]->getVar('id');

                $GLOBALS['xoopsTpl']->assign('selectorcid', AM_CONFERENCES_LOCATION_CID);
                $locationArray['cid'] = $conferenceHandler->get($locationTempArray[$i]->getVar('cid'))->getVar('title');

                $GLOBALS['xoopsTpl']->assign('selectortitle', AM_CONFERENCES_LOCATION_TITLE);
                $locationArray['title'] = $locationTempArray[$i]->getVar('title');

                $GLOBALS['xoopsTpl']->assign('selectorsummary', AM_CONFERENCES_LOCATION_SUMMARY);
                $locationArray['summary'] = $locationTempArray[$i]->getVar('summary');

                $GLOBALS['xoopsTpl']->assign('selectorimage', AM_CONFERENCES_LOCATION_IMAGE);
                $locationArray['image']       = "<img src='" . $uploadUrl . $locationTempArray[$i]->getVar('image') . "' name='" . 'name' . "' id=" . 'id' . " alt='' style='max-width:100px'>";
                $locationArray['edit_delete'] = "<a href='location.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='location.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='location.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('locationArrays', $locationArray);
                unset($locationArray);
            }
            unset($locationTempArray);
            // Display Navigation
            if ($locationCount > $locationPaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav(
                    $locationCount, $locationPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
                );
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            //                     echo "<td class='center width5'>

            //                    <a href='location.php?op=edit&id=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
            //                    <a href='location.php?op=delete&id=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
            //                    </td>";

            //                echo "</tr>";

            //            }

            //            echo "</table><br><br>";

            //        } else {

            //            echo "<table width='100%' cellspacing='1' class='outer'>

            //                    <tr>

            //                     <th class='center width5'>".AM_CONFERENCES_FORM_ACTION."XXX</th>
            //                    </tr><tr><td class='errorMsg' colspan='6'>There are noXXX location</td></tr>";
            //            echo "</table><br><br>";

            //-------------------------------------------

            echo $GLOBALS['xoopsTpl']->fetch(
                XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/conferences_admin_location.tpl'
            );
        }

        break;
}
require __DIR__ . '/admin_footer.php';
