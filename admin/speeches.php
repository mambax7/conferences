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
$uploadDir  = XOOPS_UPLOAD_PATH . '/conferences/speeches/';
$uploadUrl  = XOOPS_UPLOAD_URL . '/conferences/speeches/';

switch ($op) {
    case 'new':
        $adminObject->addItemButton(AM_CONFERENCES_SPEECHES_LIST, 'speeches.php', 'list');
        $adminObject->displayButton('left');

        $speechesObject = $speechesHandler->create();
        $form           = $speechesObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('speeches.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 !== \Xmf\Request::getInt('id', 0)) {
            $speechesObject = $speechesHandler->get(Request::getInt('id', 0));
        } else {
            $speechesObject = $speechesHandler->create();
        }
        // Form save fields
        $speechesObject->setVar('typeid', Request::getVar('typeid', ''));
        $speechesObject->setVar('title', Request::getVar('title', ''));
        $speechesObject->setVar('summary', Request::getText('summary', ''));
        $resDate     = Request::getArray('stime', [], 'POST');
        $dateTimeObj = \DateTime::createFromFormat(_SHORTDATESTRING, $resDate['date']);
        $dateTimeObj->setTime(0, 0, 0);
        $speechesObject->setVar('stime', $dateTimeObj->getTimestamp() + $resDate['time']);
        $resDate     = Request::getArray('etime', [], 'POST');
        $dateTimeObj = \DateTime::createFromFormat(_SHORTDATESTRING, $resDate['date']);
        $dateTimeObj->setTime(0, 0, 0);
        $speechesObject->setVar('etime', $dateTimeObj->getTimestamp() + $resDate['time']);
        $speechesObject->setVar('duration', Request::getVar('duration', ''));
        $speechesObject->setVar('speakerid', Request::getVar('speakerid', ''));
        $speechesObject->setVar('cid', Request::getVar('cid', ''));
        $speechesObject->setVar('tid', Request::getVar('tid', ''));

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/conferences/speeches/';
        $uploader  = new \XoopsMediaUploader(
            $uploadDir, $helper->getConfig('mimetypes'), $helper->getConfig('maxsize'), null, null
        );
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {
            //$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '' , $_FILES['attachedfile']['name']);
            //$imgName = str_replace(' ', '', $_POST['slides1']).'.'.$extension;

            $uploader->setPrefix('slides1_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $speechesObject->setVar('slides1', $uploader->getSavedFileName());
            }
        } else {
            $speechesObject->setVar('slides1', Request::getVar('slides1', ''));
        }

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/conferences/speeches/';
        $uploader  = new \XoopsMediaUploader(
            $uploadDir, $helper->getConfig('mimetypes'), $helper->getConfig('maxsize'), null, null
        );
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {
            //$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '' , $_FILES['attachedfile']['name']);
            //$imgName = str_replace(' ', '', $_POST['slides2']).'.'.$extension;

            $uploader->setPrefix('slides2_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $speechesObject->setVar('slides2', $uploader->getSavedFileName());
            }
        } else {
            $speechesObject->setVar('slides2', Request::getVar('slides2', ''));
        }

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/conferences/speeches/';
        $uploader  = new \XoopsMediaUploader(
            $uploadDir, $helper->getConfig('mimetypes'), $helper->getConfig('maxsize'), null, null
        );
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {
            //$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '' , $_FILES['attachedfile']['name']);
            //$imgName = str_replace(' ', '', $_POST['slides3']).'.'.$extension;

            $uploader->setPrefix('slides3_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $speechesObject->setVar('slides3', $uploader->getSavedFileName());
            }
        } else {
            $speechesObject->setVar('slides3', Request::getVar('slides3', ''));
        }

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/conferences/speeches/';
        $uploader  = new \XoopsMediaUploader(
            $uploadDir, $helper->getConfig('mimetypes'), $helper->getConfig('maxsize'), null, null
        );
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {
            //$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '' , $_FILES['attachedfile']['name']);
            //$imgName = str_replace(' ', '', $_POST['slides4']).'.'.$extension;

            $uploader->setPrefix('slides4_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $speechesObject->setVar('slides4', $uploader->getSavedFileName());
            }
        } else {
            $speechesObject->setVar('slides4', Request::getVar('slides4', ''));
        }

        if ($speechesHandler->insert($speechesObject)) {
            redirect_header('speeches.php?op=list', 2, AM_CONFERENCES_FORMOK);
        }

        echo $speechesObject->getHtmlErrors();
        $form = $speechesObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(AM_CONFERENCES_ADD_SPEECHES, 'speeches.php?op=new', 'add');
        $adminObject->addItemButton(AM_CONFERENCES_SPEECHES_LIST, 'speeches.php', 'list');
        $adminObject->displayButton('left');
        $speechesObject = $speechesHandler->get(Request::getString('id', ''));
        $form           = $speechesObject->getForm();
        $form->display();
        break;

    case 'delete':
        $speechesObject = $speechesHandler->get(Request::getString('id', ''));
        if (1 == \Xmf\Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('speeches.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($speechesHandler->delete($speechesObject)) {
                redirect_header('speeches.php', 3, AM_CONFERENCES_FORMDELOK);
            } else {
                echo $speechesObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'id' => Request::getString('id', ''), 'op' => 'delete',], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(AM_CONFERENCES_FORMSUREDEL, $speechesObject->getVar('title')));
        }
        break;

    case 'clone':

        $id_field = \Xmf\Request::getString('id', '');

        if ($utility::cloneRecord('conferences_speeches', 'id', $id_field)) {
            redirect_header('speeches.php', 3, AM_CONFERENCES_CLONED_OK);
        } else {
            redirect_header('speeches.php', 3, AM_CONFERENCES_CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton(AM_CONFERENCES_ADD_SPEECHES, 'speeches.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start                   = \Xmf\Request::getInt('start', 0);
        $speechesPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, title');
        $criteria->setOrder('ASC');
        $criteria->setLimit($speechesPaginationLimit);
        $criteria->setStart($start);
        $speechesTempRows  = $speechesHandler->getCount();
        $speechesTempArray = $speechesHandler->getAll($criteria);
        /*
        //
        //
                            <th class='center width5'>".AM_CONFERENCES_FORM_ACTION."</th>
        //                    </tr>";
        //            $class = "odd";
        */

        // Display Page Navigation
        if ($speechesTempRows > $speechesPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav(
                $speechesTempRows, $speechesPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
            );
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('speechesRows', $speechesTempRows);
        $speechesArray = [];

        //    $fields = explode('|', id:int:5::NOT NULL::primary:ID:0|typeid:tinyint:4::NULL:1::SpeechType:1|title:varchar:120::NOT NULL::primary:Title:2|summary:mediumtext:0::NULL:::Summary:3|stime:int:11::NULL:::StartTime:4|etime:int:11::NULL:::EndTime:5|duration:int:11::NULL:::Duration:6|speakerid:int:5::NOT NULL:::Speaker:7|cid:tinyint:4::NULL:::Conference:8|tid:tinyint:4::NULL:::Track:9|slides1:varchar:200::NULL:::Slides1:10|slides2:varchar:200::NULL:::Slides2:11|slides3:varchar:200::NULL:::Slides3:12|slides4:varchar:200::NULL:::Slides4:13);
        //    $fieldsCount    = count($fields);

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($speechesPaginationLimit);
        $criteria->setStart($start);

        $speechesCount     = $speechesHandler->getCount($criteria);
        $speechesTempArray = $speechesHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($speechesCount > 0) {
            foreach (array_keys($speechesTempArray) as $i) {
                //        $field = explode(':', $fields[$i]);

                $GLOBALS['xoopsTpl']->assign('selectorid', AM_CONFERENCES_SPEECHES_ID);
                $speechesArray['id'] = $speechesTempArray[$i]->getVar('id');

                $GLOBALS['xoopsTpl']->assign('selectortypeid', AM_CONFERENCES_SPEECHES_TYPEID);
                $speechesArray['typeid'] = $speechtypesHandler->get($speechesTempArray[$i]->getVar('typeid'))->getVar('name');

                $GLOBALS['xoopsTpl']->assign('selectortitle', AM_CONFERENCES_SPEECHES_TITLE);
                $speechesArray['title'] = $speechesTempArray[$i]->getVar('title');
                $speechesArray['title'] = $utility::truncateHtml($speechesArray['title'], $helper->getConfig('truncatelength'));

                $GLOBALS['xoopsTpl']->assign('selectorsummary', AM_CONFERENCES_SPEECHES_SUMMARY);
                $speechesArray['summary'] = $speechesTempArray[$i]->getVar('summary');

                $GLOBALS['xoopsTpl']->assign('selectorstime', AM_CONFERENCES_SPEECHES_STIME);
                $speechesArray['stime'] = formatTimestamp($speechesTempArray[$i]->getVar('stime'), 's');

                $GLOBALS['xoopsTpl']->assign('selectoretime', AM_CONFERENCES_SPEECHES_ETIME);
                $speechesArray['etime'] = formatTimestamp($speechesTempArray[$i]->getVar('etime'), 's');

                $GLOBALS['xoopsTpl']->assign('selectorduration', AM_CONFERENCES_SPEECHES_DURATION);
                $speechesArray['duration'] = $speechesTempArray[$i]->getVar('duration');

                $GLOBALS['xoopsTpl']->assign('selectorspeakerid', AM_CONFERENCES_SPEECHES_SPEAKERID);
                $speechesArray['speakerid'] = $speakersHandler->get($speechesTempArray[$i]->getVar('speakerid'))->getVar('name');

                $GLOBALS['xoopsTpl']->assign('selectorcid', AM_CONFERENCES_SPEECHES_CID);
                $speechesArray['cid'] = $conferenceHandler->get($speechesTempArray[$i]->getVar('cid'))->getVar('title');

                $GLOBALS['xoopsTpl']->assign('selectortid', AM_CONFERENCES_SPEECHES_TID);
                $speechesArray['tid'] = $tracksHandler->get($speechesTempArray[$i]->getVar('tid'))->getVar('title');

                $GLOBALS['xoopsTpl']->assign('selectorslides1', AM_CONFERENCES_SPEECHES_SLIDES1);
                $speechesArray['slides1'] = "<img src='" . $uploadUrl . $speechesTempArray[$i]->getVar('slides1') . "' name='" . 'name' . "' id=" . 'id' . " alt='' style='max-width:100px'>";

                $GLOBALS['xoopsTpl']->assign('selectorslides2', AM_CONFERENCES_SPEECHES_SLIDES2);
                $speechesArray['slides2'] = "<img src='" . $uploadUrl . $speechesTempArray[$i]->getVar('slides2') . "' name='" . 'name' . "' id=" . 'id' . " alt='' style='max-width:100px'>";

                $GLOBALS['xoopsTpl']->assign('selectorslides3', AM_CONFERENCES_SPEECHES_SLIDES3);
                $speechesArray['slides3'] = "<img src='" . $uploadUrl . $speechesTempArray[$i]->getVar('slides3') . "' name='" . 'name' . "' id=" . 'id' . " alt='' style='max-width:100px'>";

                $GLOBALS['xoopsTpl']->assign('selectorslides4', AM_CONFERENCES_SPEECHES_SLIDES4);
                $speechesArray['slides4']     = "<img src='" . $uploadUrl . $speechesTempArray[$i]->getVar('slides4') . "' name='" . 'name' . "' id=" . 'id' . " alt='' style='max-width:100px'>";
                $speechesArray['edit_delete'] = "<a href='speeches.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='speeches.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='speeches.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('speechesArrays', $speechesArray);
                unset($speechesArray);
            }
            unset($speechesTempArray);
            // Display Navigation
            if ($speechesCount > $speechesPaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav(
                    $speechesCount, $speechesPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
                );
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            //                     echo "<td class='center width5'>

            //                    <a href='speeches.php?op=edit&id=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
            //                    <a href='speeches.php?op=delete&id=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
            //                    </td>";

            //                echo "</tr>";

            //            }

            //            echo "</table><br><br>";

            //        } else {

            //            echo "<table width='100%' cellspacing='1' class='outer'>

            //                    <tr>

            //                     <th class='center width5'>".AM_CONFERENCES_FORM_ACTION."XXX</th>
            //                    </tr><tr><td class='errorMsg' colspan='15'>There are noXXX speeches</td></tr>";
            //            echo "</table><br><br>";

            //-------------------------------------------

            echo $GLOBALS['xoopsTpl']->fetch(
                XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/conferences_admin_speeches.tpl'
            );
        }

        break;
}
require __DIR__ . '/admin_footer.php';
