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
 * Class LocationForm
 */
class LocationForm extends \XoopsThemeForm
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

        $title = $this->targetObject->isNew() ? sprintf(AM_CONFERENCES_LOCATION_ADD) : sprintf(AM_CONFERENCES_LOCATION_EDIT);
        parent::__construct($title, 'form', xoops_getenv('SCRIPT_NAME'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('id', $this->targetObject->getVar('id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new \XoopsFormLabel(AM_CONFERENCES_LOCATION_ID, $this->targetObject->getVar('id'), 'id'));
        // Cid
        //$conferenceHandler = $this->helper->getHandler('Conference');
        //$db     = \XoopsDatabaseFactory::getDatabaseConnection();
        /** @var \XoopsPersistableObjectHandler $conferenceHandler */
        $conferenceHandler = $this->helper->getHandler('Conference');

        $conference_id_select = new \XoopsFormSelect(AM_CONFERENCES_LOCATION_CID, 'cid', $this->targetObject->getVar('cid'));
        $conference_id_select->addOptionArray($conferenceHandler->getList());
        $this->addElement($conference_id_select, false);
        // Title
        $this->addElement(new \XoopsFormText(AM_CONFERENCES_LOCATION_TITLE, 'title', 50, 255, $this->targetObject->getVar('title')), false);
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
            //$this->addElement( new \XoopsFormEditor(AM_CONFERENCES_LOCATION_SUMMARY, 'summary', $editorOptions), false  );
            if ($this->helper->isUserAdmin()) {
                $descEditor = new \XoopsFormEditor(AM_CONFERENCES_LOCATION_SUMMARY, $this->helper->getConfig('conferencesEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor(AM_CONFERENCES_LOCATION_SUMMARY, $this->helper->getConfig('conferencesEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea(AM_CONFERENCES_LOCATION_SUMMARY, 'description', $this->targetObject->getVar('description', 'e'), 5, 50);
        }
        $this->addElement($descEditor);
        // Image
        $image = $this->targetObject->getVar('image') ?: 'blank.png';

        $uploadDir   = '/uploads/conferences/location/';
        $imgtray     = new \XoopsFormElementTray(AM_CONFERENCES_LOCATION_IMAGE, '<br>');
        $imgpath     = sprintf(AM_CONFERENCES_FORMIMAGE_PATH, $uploadDir);
        $imageselect = new \XoopsFormSelect($imgpath, 'image', $image);
        $imageArray  = \XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadDir);
        foreach ($imageArray as $image) {
            $imageselect->addOption((string)$image, $image);
        }
        $imageselect->setExtra("onchange='showImgSelected(\"image_image\", \"image\", \"" . $uploadDir . '", "", "' . XOOPS_URL . "\")'");
        $imgtray->addElement($imageselect);
        $imgtray->addElement(new \XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadDir . '/' . $image . "' name='image_image' id='image_image' alt='' style='max-width:300px' >"));
        $fileseltray = new \XoopsFormElementTray('', '<br>');
        $fileseltray->addElement(new \XoopsFormFile(AM_CONFERENCES_FORMUPLOAD, 'image', $this->helper->getConfig('maxsize')));
        $fileseltray->addElement(new \XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);

        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
