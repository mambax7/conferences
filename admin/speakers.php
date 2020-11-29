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
$uploadDir  = XOOPS_UPLOAD_PATH . '/conferences/speakers/';
$uploadUrl  = XOOPS_UPLOAD_URL . '/conferences/speakers/';

switch ($op) {
    case 'new':
        $adminObject->addItemButton(AM_CONFERENCES_SPEAKERS_LIST, 'speakers.php', 'list');
        $adminObject->displayButton('left');

        $speakersObject = $speakersHandler->create();
        $form           = $speakersObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('speakers.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 !== \Xmf\Request::getInt('id', 0)) {
            $speakersObject = $speakersHandler->get(Request::getInt('id', 0));
        } else {
            $speakersObject = $speakersHandler->create();
        }
        // Form save fields
        $speakersObject->setVar('name', Request::getVar('name', ''));
        $speakersObject->setVar('email', Request::getVar('email', ''));
        $speakersObject->setVar('descrip', Request::getText('descrip', ''));
        $speakersObject->setVar('location', Request::getText('location', ''));
        $speakersObject->setVar('company', Request::getText('company', ''));

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/conferences/speakers/';
        $uploader  = new \XoopsMediaUploader(
            $uploadDir, $helper->getConfig('mimetypes'), $helper->getConfig('maxsize'), null, null
        );
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {
            //$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '' , $_FILES['attachedfile']['name']);
            //$imgName = str_replace(' ', '', $_POST['photo']).'.'.$extension;

            $uploader->setPrefix('photo_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $speakersObject->setVar('photo', $uploader->getSavedFileName());
            }
        } else {
            $speakersObject->setVar('photo', Request::getVar('photo', ''));
        }

        $speakersObject->setVar('url', Request::getVar('url', ''));
        $speakersObject->setVar('hits', Request::getVar('hits', ''));
        if ($speakersHandler->insert($speakersObject)) {
            redirect_header('speakers.php?op=list', 2, AM_CONFERENCES_FORMOK);
        }

        echo $speakersObject->getHtmlErrors();
        $form = $speakersObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(AM_CONFERENCES_ADD_SPEAKERS, 'speakers.php?op=new', 'add');
        $adminObject->addItemButton(AM_CONFERENCES_SPEAKERS_LIST, 'speakers.php', 'list');
        $adminObject->displayButton('left');
        $speakersObject = $speakersHandler->get(Request::getString('id', ''));
        $form           = $speakersObject->getForm();
        $form->display();
        break;

    case 'delete':
        $speakersObject = $speakersHandler->get(Request::getString('id', ''));
        if (1 == \Xmf\Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('speakers.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($speakersHandler->delete($speakersObject)) {
                redirect_header('speakers.php', 3, AM_CONFERENCES_FORMDELOK);
            } else {
                echo $speakersObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'id' => Request::getString('id', ''), 'op' => 'delete',], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(AM_CONFERENCES_FORMSUREDEL, $speakersObject->getVar('name')));
        }
        break;

    case 'clone':

        $id_field = \Xmf\Request::getString('id', '');

        if ($utility::cloneRecord('conferences_speakers', 'id', $id_field)) {
            redirect_header('speakers.php', 3, AM_CONFERENCES_CLONED_OK);
        } else {
            redirect_header('speakers.php', 3, AM_CONFERENCES_CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton(AM_CONFERENCES_ADD_SPEAKERS, 'speakers.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start                   = \Xmf\Request::getInt('start', 0);
        $speakersPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, name');
        $criteria->setOrder('ASC');
        $criteria->setLimit($speakersPaginationLimit);
        $criteria->setStart($start);
        $speakersTempRows  = $speakersHandler->getCount();
        $speakersTempArray = $speakersHandler->getAll($criteria);
        /*
        //
        //
                            <th class='center width5'>".AM_CONFERENCES_FORM_ACTION."</th>
        //                    </tr>";
        //            $class = "odd";
        */

        // Display Page Navigation
        if ($speakersTempRows > $speakersPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav(
                $speakersTempRows, $speakersPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
            );
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('speakersRows', $speakersTempRows);
        $speakersArray = [];

        //    $fields = explode('|', id:int:5::NOT NULL::primary:ID:0|name:varchar:80::NOT NULL::primary:Name:1|email:varchar:100::NULL:::Email:2|descrip:mediumtext:0::NULL:::Description:3|location:varchar:100::NULL:::Location:4|company:varchar:100::NULL:::Company:5|photo:varchar:200::NULL:::Photo:6|url:varchar:200::NULL:::Url:7|hits:int:5::NULL:0::Hits:8);
        //    $fieldsCount    = count($fields);

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($speakersPaginationLimit);
        $criteria->setStart($start);

        $speakersCount     = $speakersHandler->getCount($criteria);
        $speakersTempArray = $speakersHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($speakersCount > 0) {
            foreach (array_keys($speakersTempArray) as $i) {
                //        $field = explode(':', $fields[$i]);

                $GLOBALS['xoopsTpl']->assign('selectorid', AM_CONFERENCES_SPEAKERS_ID);
                $speakersArray['id'] = $speakersTempArray[$i]->getVar('id');

                $GLOBALS['xoopsTpl']->assign('selectorname', AM_CONFERENCES_SPEAKERS_NAME);
                $speakersArray['name'] = $speakersTempArray[$i]->getVar('name');

                $GLOBALS['xoopsTpl']->assign('selectoremail', AM_CONFERENCES_SPEAKERS_EMAIL);
                $speakersArray['email'] = $speakersTempArray[$i]->getVar('email');

                $GLOBALS['xoopsTpl']->assign('selectordescrip', AM_CONFERENCES_SPEAKERS_DESCRIP);
                $speakersArray['descrip'] = $speakersTempArray[$i]->getVar('descrip');

                $GLOBALS['xoopsTpl']->assign('selectorlocation', AM_CONFERENCES_SPEAKERS_LOCATION);
                $speakersArray['location'] = $speakersTempArray[$i]->getVar('location');

                $GLOBALS['xoopsTpl']->assign('selectorcompany', AM_CONFERENCES_SPEAKERS_COMPANY);
                $speakersArray['company'] = $speakersTempArray[$i]->getVar('company');

                $GLOBALS['xoopsTpl']->assign('selectorphoto', AM_CONFERENCES_SPEAKERS_PHOTO);
                $speakersArray['photo'] = "<img src='" . $uploadUrl . $speakersTempArray[$i]->getVar('photo') . "' name='" . 'name' . "' id=" . 'id' . " alt='' style='max-width:100px'>";

                $GLOBALS['xoopsTpl']->assign('selectorurl', AM_CONFERENCES_SPEAKERS_URL);
                $speakersArray['url'] = $speakersTempArray[$i]->getVar('url');

                $GLOBALS['xoopsTpl']->assign('selectorhits', AM_CONFERENCES_SPEAKERS_HITS);
                $speakersArray['hits']        = $speakersTempArray[$i]->getVar('hits');
                $speakersArray['edit_delete'] = "<a href='speakers.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='speakers.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='speakers.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('speakersArrays', $speakersArray);
                unset($speakersArray);
            }
            unset($speakersTempArray);
            // Display Navigation
            if ($speakersCount > $speakersPaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav(
                    $speakersCount, $speakersPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
                );
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            //                     echo "<td class='center width5'>

            //                    <a href='speakers.php?op=edit&id=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
            //                    <a href='speakers.php?op=delete&id=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
            //                    </td>";

            //                echo "</tr>";

            //            }

            //            echo "</table><br><br>";

            //        } else {

            //            echo "<table width='100%' cellspacing='1' class='outer'>

            //                    <tr>

            //                     <th class='center width5'>".AM_CONFERENCES_FORM_ACTION."XXX</th>
            //                    </tr><tr><td class='errorMsg' colspan='10'>There are noXXX speakers</td></tr>";
            //            echo "</table><br><br>";

            //-------------------------------------------

            echo $GLOBALS['xoopsTpl']->fetch(
                XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/conferences_admin_speakers.tpl'
            );
        }

        break;
}
require __DIR__ . '/admin_footer.php';
