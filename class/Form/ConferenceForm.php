<?php

declare(strict_types=1);

namespace XoopsModules\Conferences\Form;

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
use XoopsModules\Conferences;

require_once dirname(dirname(__DIR__)) . '/include/common.php';

$moduleDirName = basename(dirname(dirname(__DIR__)));
//$helper = Conferences\Helper::getInstance();
$permHelper = new \Xmf\Module\Helper\Permission();

xoops_load('XoopsFormLoader');

/**
 * Class ConferenceForm
 */
class ConferenceForm extends \XoopsThemeForm
{
    public $targetObject;
    public $helper;

    /**
     * Constructor
     *
     * @param $target
     */
    public function __construct($target)
    {
        $this->helper       = $target->helper;
        $this->targetObject = $target;

        $title = $this->targetObject->isNew() ? sprintf(AM_CONFERENCES_CONFERENCE_ADD) : sprintf(AM_CONFERENCES_CONFERENCE_EDIT);
        parent::__construct($title, 'form', xoops_getenv('SCRIPT_NAME'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('id', $this->targetObject->getVar('id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new \XoopsFormLabel(AM_CONFERENCES_CONFERENCE_ID, $this->targetObject->getVar('id'), 'id'));
        // Title
        $this->addElement(new \XoopsFormText(AM_CONFERENCES_CONFERENCE_TITLE, 'title', 50, 255, $this->targetObject->getVar('title')), false);
        // Subtitle
        $this->addElement(new \XoopsFormText(AM_CONFERENCES_CONFERENCE_SUBTITLE, 'subtitle', 50, 255, $this->targetObject->getVar('subtitle')), false);
        // Subsubtitle
        $this->addElement(new \XoopsFormText(AM_CONFERENCES_CONFERENCE_SUBSUBTITLE, 'subsubtitle', 50, 255, $this->targetObject->getVar('subsubtitle')), false);
        // Sdate
        $this->addElement(new \XoopsFormTextDateSelect(AM_CONFERENCES_CONFERENCE_SDATE, 'sdate', 0, formatTimestamp($this->targetObject->getVar('sdate'), 's')));
        // Edate
        $this->addElement(new \XoopsFormTextDateSelect(AM_CONFERENCES_CONFERENCE_EDATE, 'edate', 0, formatTimestamp($this->targetObject->getVar('edate'), 's')));
        // Summary
        if (class_exists('XoopsFormEditor')) {
            $editorOptions           = [];
            $editorOptions['name']   = 'summary';
            $editorOptions['value']  = $this->targetObject->getVar('summary', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';
            //$editorOptions['editor'] = xoops_getModuleOption('conferences_editor', 'conferences');
            //$this->addElement( new \XoopsFormEditor(AM_CONFERENCES_CONFERENCE_SUMMARY, 'summary', $editorOptions), false  );
            if ($this->helper->isUserAdmin()) {
                $descEditor = new \XoopsFormEditor(AM_CONFERENCES_CONFERENCE_SUMMARY, $this->helper->getConfig('conferencesEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor(AM_CONFERENCES_CONFERENCE_SUMMARY, $this->helper->getConfig('conferencesEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea(AM_CONFERENCES_CONFERENCE_SUMMARY, 'description', $this->targetObject->getVar('description', 'e'), 5, 50);
        }
        $this->addElement($descEditor);
        // Isdefault
        $isdefault = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('isdefault');
        $this->addElement(new \XoopsFormRadioYN(AM_CONFERENCES_CONFERENCE_ISDEFAULT, 'isdefault', $isdefault), false);
        // Logo
        $logo = $this->targetObject->getVar('logo') ?: 'blank.png';

        $uploadDir   = '/uploads/conferences/conference/';
        $imgtray     = new \XoopsFormElementTray(AM_CONFERENCES_CONFERENCE_LOGO, '<br>');
        $imgpath     = sprintf(AM_CONFERENCES_FORMIMAGE_PATH, $uploadDir);
        $imageselect = new \XoopsFormSelect($imgpath, 'logo', $logo);
        $imageArray  = \XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadDir);
        foreach ($imageArray as $image) {
            $imageselect->addOption((string)$image, $image);
        }
        $imageselect->setExtra("onchange='showImgSelected(\"image_logo\", \"logo\", \"" . $uploadDir . '", "", "' . XOOPS_URL . "\")'");
        $imgtray->addElement($imageselect);
        $imgtray->addElement(new \XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadDir . '/' . $logo . "' name='image_logo' id='image_logo' alt='' style='max-width:300px' >"));
        $fileseltray = new \XoopsFormElementTray('', '<br>');
        $fileseltray->addElement(new \XoopsFormFile(AM_CONFERENCES_FORMUPLOAD, 'logo', $this->helper->getConfig('maxsize')));
        $fileseltray->addElement(new \XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);

        //permissions
        /** @var \XoopsMemberHandler $memberHandler */
        $memberHandler = xoops_getHandler('member');
        $groupList     = $memberHandler->getGroupList();
        /** @var \XoopsGroupPermHandler $grouppermHandler */
        $grouppermHandler = xoops_getHandler('groupperm');
        //$fullList = array_keys ($groupList);

        //========================================================================

        $mid            = $GLOBALS['xoopsModule']->mid();
        $groupIdAdmin   = 0;
        $groupNameAdmin = '';

        // create admin checkbox
        foreach ($groupList as $groupId => $groupName) {
            if (XOOPS_GROUP_ADMIN == $groupId) {
                $groupIdAdmin   = $groupId;
                $groupNameAdmin = $groupName;
            }
        }

        $selectPermAdmin = new \XoopsFormCheckBox('', 'admin', XOOPS_GROUP_ADMIN);
        $selectPermAdmin->addOption($groupIdAdmin, $groupNameAdmin);
        $selectPermAdmin->setExtra("disabled='disabled'"); //comment it out, if you want to allow to remove permissions for the admin

        // ********************************************************
        // permission view items
        $cat_gperms_read     = $grouppermHandler->getGroupIds('conferences_view', $this->targetObject->getVar('id'), $mid);
        $arr_cat_gperms_read = $this->targetObject->isNew() ? '0' : $cat_gperms_read;

        $permsTray = new \XoopsFormElementTray(AM_CONFERENCES_PERMISSIONS_VIEW, '');

        $selectAllReadCheckbox = new \XoopsFormCheckBox('', 'adminbox1', 1);
        $selectAllReadCheckbox->addOption('allbox', _AM_SYSTEM_ALL);
        $selectAllReadCheckbox->setExtra(" onclick='xoopsCheckGroup(\"form\", \"adminbox1\" , \"groupsRead[]\");' ");
        $selectAllReadCheckbox->setClass('xo-checkall');
        $permsTray->addElement($selectAllReadCheckbox);

        // checkbox webmaster
        $permsTray->addElement($selectPermAdmin, false);
        // checkboxes other groups
        //$selectPerm = new \XoopsFormCheckBox('', 'cat_gperms_read', $arr_cat_gperms_read);
        //$selectPerm = new \XoopsFormCheckBox('', 'groupsRead[]', $this->targetObject->getGroupsRead());
        $selectPerm = new \XoopsFormCheckBox('', 'groupsRead[]', $arr_cat_gperms_read);
        foreach ($groupList as $groupId => $groupName) {
            if (XOOPS_GROUP_ADMIN != $groupId) {
                $selectPerm->addOption($groupId, $groupName);
            }
        }
        $permsTray->addElement($selectPerm, false);
        $this->addElement($permsTray, false);
        unset($permsTray, $selectPerm);

        // ********************************************************
        // permission submit item
        $cat_gperms_create     = $grouppermHandler->getGroupIds('conferences_submit', $this->targetObject->getVar('id'), $mid);
        $arr_cat_gperms_create = $this->targetObject->isNew() ? '0' : $cat_gperms_create;

        $permsTray = new \XoopsFormElementTray(AM_CONFERENCES_PERMISSIONS_SUBMIT, '');

        $selectAllSubmitCheckbox = new \XoopsFormCheckBox('', 'adminbox2', 1);
        $selectAllSubmitCheckbox->addOption('allbox', _AM_SYSTEM_ALL);
        $selectAllSubmitCheckbox->setExtra(" onclick='xoopsCheckGroup(\"form\", \"adminbox2\" , \"groupsSubmit[]\");' ");
        $selectAllSubmitCheckbox->setClass('xo-checkall');
        $permsTray->addElement($selectAllSubmitCheckbox);

        // checkbox webmaster
        $permsTray->addElement($selectPermAdmin, false);
        // checkboxes other groups
        //$selectPerm = new \XoopsFormCheckBox('', 'cat_gperms_create', $arr_cat_gperms_create);
        $selectPerm = new \XoopsFormCheckBox('', 'groupsSubmit[]', $arr_cat_gperms_create);
        foreach ($groupList as $groupId => $groupName) {
            if (XOOPS_GROUP_ADMIN != $groupId) {
                $selectPerm->addOption($groupId, $groupName);
            }
        }
        $permsTray->addElement($selectPerm, false);
        $this->addElement($permsTray, false);
        unset($permsTray, $selectPerm);

        // ********************************************************
        // permission approve items
        $cat_gperms_admin     = $grouppermHandler->getGroupIds('conferences_approve', $this->targetObject->getVar('id'), $mid);
        $arr_cat_gperms_admin = $this->targetObject->isNew() ? '0' : $cat_gperms_admin;

        $permsTray = new \XoopsFormElementTray(AM_CONFERENCES_PERMISSIONS_APPROVE, '');

        $selectAllModerateCheckbox = new \XoopsFormCheckBox('', 'adminbox3', 1);
        $selectAllModerateCheckbox->addOption('allbox', _AM_SYSTEM_ALL);
        $selectAllModerateCheckbox->setExtra(" onclick='xoopsCheckGroup(\"form\", \"adminbox3\" , \"groupsModeration[]\");' ");
        $selectAllModerateCheckbox->setClass('xo-checkall');
        $permsTray->addElement($selectAllModerateCheckbox);

        // checkbox webmaster
        $permsTray->addElement($selectPermAdmin, false);
        // checkboxes other groups
        //$selectPerm = new \XoopsFormCheckBox('', 'cat_gperms_admin', $arr_cat_gperms_admin);
        $selectPerm = new \XoopsFormCheckBox('', 'groupsModeration[]', $arr_cat_gperms_admin);
        foreach ($groupList as $groupId => $groupName) {
            if (XOOPS_GROUP_ADMIN != $groupId && XOOPS_GROUP_ANONYMOUS != $groupId) {
                $selectPerm->addOption($groupId, $groupName);
            }
        }
        $permsTray->addElement($selectPerm, false);
        $this->addElement($permsTray, false);
        unset($permsTray, $selectPerm);

        //=========================================================================
        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
