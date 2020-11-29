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
$uploadDir  = XOOPS_UPLOAD_PATH . '/conferences/speechtypes/';
$uploadUrl  = XOOPS_UPLOAD_URL . '/conferences/speechtypes/';

switch ($op) {
    case 'new':
        $adminObject->addItemButton(AM_CONFERENCES_SPEECHTYPES_LIST, 'speechtypes.php', 'list');
        $adminObject->displayButton('left');

        $speechtypesObject = $speechtypesHandler->create();
        $form              = $speechtypesObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('speechtypes.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 !== \Xmf\Request::getInt('id', 0)) {
            $speechtypesObject = $speechtypesHandler->get(Request::getInt('id', 0));
        } else {
            $speechtypesObject = $speechtypesHandler->create();
        }
        // Form save fields
        $speechtypesObject->setVar('name', Request::getVar('name', ''));
        $speechtypesObject->setVar('color', Request::getVar('color', ''));
        $speechtypesObject->setVar('plenary', ((1 == \Xmf\Request::getInt('plenary', 0)) ? '1' : '0'));

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/conferences/speechtypes/';
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
                $speechtypesObject->setVar('logo', $uploader->getSavedFileName());
            }
        } else {
            $speechtypesObject->setVar('logo', Request::getVar('logo', ''));
        }

        if ($speechtypesHandler->insert($speechtypesObject)) {
            redirect_header('speechtypes.php?op=list', 2, AM_CONFERENCES_FORMOK);
        }

        echo $speechtypesObject->getHtmlErrors();
        $form = $speechtypesObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(AM_CONFERENCES_ADD_SPEECHTYPES, 'speechtypes.php?op=new', 'add');
        $adminObject->addItemButton(AM_CONFERENCES_SPEECHTYPES_LIST, 'speechtypes.php', 'list');
        $adminObject->displayButton('left');
        $speechtypesObject = $speechtypesHandler->get(Request::getString('id', ''));
        $form              = $speechtypesObject->getForm();
        $form->display();
        break;

    case 'delete':
        $speechtypesObject = $speechtypesHandler->get(Request::getString('id', ''));
        if (1 == \Xmf\Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('speechtypes.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($speechtypesHandler->delete($speechtypesObject)) {
                redirect_header('speechtypes.php', 3, AM_CONFERENCES_FORMDELOK);
            } else {
                echo $speechtypesObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'id' => Request::getString('id', ''), 'op' => 'delete',], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(AM_CONFERENCES_FORMSUREDEL, $speechtypesObject->getVar('name')));
        }
        break;

    case 'clone':

        $id_field = \Xmf\Request::getString('id', '');

        if ($utility::cloneRecord('conferences_speechtypes', 'id', $id_field)) {
            redirect_header('speechtypes.php', 3, AM_CONFERENCES_CLONED_OK);
        } else {
            redirect_header('speechtypes.php', 3, AM_CONFERENCES_CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton(AM_CONFERENCES_ADD_SPEECHTYPES, 'speechtypes.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start                      = \Xmf\Request::getInt('start', 0);
        $speechtypesPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, name');
        $criteria->setOrder('ASC');
        $criteria->setLimit($speechtypesPaginationLimit);
        $criteria->setStart($start);
        $speechtypesTempRows  = $speechtypesHandler->getCount();
        $speechtypesTempArray = $speechtypesHandler->getAll($criteria);
        /*
        //
        //
                            <th class='center width5'>".AM_CONFERENCES_FORM_ACTION."</th>
        //                    </tr>";
        //            $class = "odd";
        */

        // Display Page Navigation
        if ($speechtypesTempRows > $speechtypesPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav(
                $speechtypesTempRows, $speechtypesPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
            );
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('speechtypesRows', $speechtypesTempRows);
        $speechtypesArray = [];

        //    $fields = explode('|', id:tinyint:4::NOT NULL::primary:ID:0|name:varchar:50::NOT NULL::primary:Name:1|color:varchar:7::NULL:::Color:2|plenary:tinyint:4::NULL:0::Plenary:3|logo:varchar:50::NULL:::Logo:4);
        //    $fieldsCount    = count($fields);

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($speechtypesPaginationLimit);
        $criteria->setStart($start);

        $speechtypesCount     = $speechtypesHandler->getCount($criteria);
        $speechtypesTempArray = $speechtypesHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($speechtypesCount > 0) {
            foreach (array_keys($speechtypesTempArray) as $i) {
                //        $field = explode(':', $fields[$i]);

                $GLOBALS['xoopsTpl']->assign('selectorid', AM_CONFERENCES_SPEECHTYPES_ID);
                $speechtypesArray['id'] = $speechtypesTempArray[$i]->getVar('id');

                $GLOBALS['xoopsTpl']->assign('selectorname', AM_CONFERENCES_SPEECHTYPES_NAME);
                $speechtypesArray['name'] = $speechtypesTempArray[$i]->getVar('name');

                $GLOBALS['xoopsTpl']->assign('selectorcolor', AM_CONFERENCES_SPEECHTYPES_COLOR);
                $speechtypesArray['color'] = $speechtypesTempArray[$i]->getVar('color');

                $GLOBALS['xoopsTpl']->assign('selectorplenary', AM_CONFERENCES_SPEECHTYPES_PLENARY);
                $speechtypesArray['plenary'] = $speechtypesTempArray[$i]->getVar('plenary');

                $GLOBALS['xoopsTpl']->assign('selectorlogo', AM_CONFERENCES_SPEECHTYPES_LOGO);
                $speechtypesArray['logo']        = "<img src='" . $uploadUrl . $speechtypesTempArray[$i]->getVar('logo') . "' name='" . 'name' . "' id=" . 'id' . " alt='' style='max-width:100px'>";
                $speechtypesArray['edit_delete'] = "<a href='speechtypes.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='speechtypes.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='speechtypes.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('speechtypesArrays', $speechtypesArray);
                unset($speechtypesArray);
            }
            unset($speechtypesTempArray);
            // Display Navigation
            if ($speechtypesCount > $speechtypesPaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav(
                    $speechtypesCount, $speechtypesPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
                );
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            //                     echo "<td class='center width5'>

            //                    <a href='speechtypes.php?op=edit&id=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
            //                    <a href='speechtypes.php?op=delete&id=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
            //                    </td>";

            //                echo "</tr>";

            //            }

            //            echo "</table><br><br>";

            //        } else {

            //            echo "<table width='100%' cellspacing='1' class='outer'>

            //                    <tr>

            //                     <th class='center width5'>".AM_CONFERENCES_FORM_ACTION."XXX</th>
            //                    </tr><tr><td class='errorMsg' colspan='6'>There are noXXX speechtypes</td></tr>";
            //            echo "</table><br><br>";

            //-------------------------------------------

            echo $GLOBALS['xoopsTpl']->fetch(
                XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/conferences_admin_speechtypes.tpl'
            );
        }

        break;
}
require __DIR__ . '/admin_footer.php';
