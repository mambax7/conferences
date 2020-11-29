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
 * Class SpeechesForm
 */
class SpeechesForm extends \XoopsThemeForm
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

        $title = $this->targetObject->isNew() ? sprintf(AM_CONFERENCES_SPEECHES_ADD) : sprintf(AM_CONFERENCES_SPEECHES_EDIT);
        parent::__construct($title, 'form', xoops_getenv('SCRIPT_NAME'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('id', $this->targetObject->getVar('id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new \XoopsFormLabel(AM_CONFERENCES_SPEECHES_ID, $this->targetObject->getVar('id'), 'id'));
        // Typeid
        //$speechtypesHandler = $this->helper->getHandler('Speechtypes');
        //$db     = \XoopsDatabaseFactory::getDatabaseConnection();
        /** @var \XoopsPersistableObjectHandler $speechtypesHandler */
        $speechtypesHandler = $this->helper->getHandler('Speechtypes');

        $speechtypes_id_select = new \XoopsFormSelect(AM_CONFERENCES_SPEECHES_TYPEID, 'typeid', $this->targetObject->getVar('typeid'));
        $speechtypes_id_select->addOptionArray($speechtypesHandler->getList());
        $this->addElement($speechtypes_id_select, false);
        // Title
        $this->addElement(new \XoopsFormText(AM_CONFERENCES_SPEECHES_TITLE, 'title', 50, 255, $this->targetObject->getVar('title')), false);
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
            //$this->addElement( new \XoopsFormEditor(AM_CONFERENCES_SPEECHES_SUMMARY, 'summary', $editorOptions), false  );
            if ($this->helper->isUserAdmin()) {
                $descEditor = new \XoopsFormEditor(AM_CONFERENCES_SPEECHES_SUMMARY, $this->helper->getConfig('conferencesEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor(AM_CONFERENCES_SPEECHES_SUMMARY, $this->helper->getConfig('conferencesEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea(AM_CONFERENCES_SPEECHES_SUMMARY, 'description', $this->targetObject->getVar('description', 'e'), 5, 50);
        }
        $this->addElement($descEditor);
        // Stime
        $this->addElement(new \XoopsFormDateTime(AM_CONFERENCES_SPEECHES_STIME, 'stime', 0, $this->targetObject->getVar('stime')));
        // Etime
        $this->addElement(new \XoopsFormDateTime(AM_CONFERENCES_SPEECHES_ETIME, 'etime', 0, $this->targetObject->getVar('etime')));
        // Duration
        $this->addElement(new \XoopsFormText(AM_CONFERENCES_SPEECHES_DURATION, 'duration', 50, 255, $this->targetObject->getVar('duration')), false);
        // Speakerid
        //$speakersHandler = $this->helper->getHandler('Speakers');
        //$db     = \XoopsDatabaseFactory::getDatabaseConnection();
        /** @var \XoopsPersistableObjectHandler $speakersHandler */
        $speakersHandler = $this->helper->getHandler('Speakers');

        $speakers_id_select = new \XoopsFormSelect(AM_CONFERENCES_SPEECHES_SPEAKERID, 'speakerid', $this->targetObject->getVar('speakerid'));
        $speakers_id_select->addOptionArray($speakersHandler->getList());
        $this->addElement($speakers_id_select, false);
        // Cid
        //$conferenceHandler = $this->helper->getHandler('Conference');
        //$db     = \XoopsDatabaseFactory::getDatabaseConnection();
        /** @var \XoopsPersistableObjectHandler $conferenceHandler */
        $conferenceHandler = $this->helper->getHandler('Conference');

        $conference_id_select = new \XoopsFormSelect(AM_CONFERENCES_SPEECHES_CID, 'cid', $this->targetObject->getVar('cid'));
        $conference_id_select->addOptionArray($conferenceHandler->getList());
        $this->addElement($conference_id_select, false);
        // Tid
        //$tracksHandler = $this->helper->getHandler('Tracks');
        //$db     = \XoopsDatabaseFactory::getDatabaseConnection();
        /** @var \XoopsPersistableObjectHandler $tracksHandler */
        $tracksHandler = $this->helper->getHandler('Tracks');

        $tracks_id_select = new \XoopsFormSelect(AM_CONFERENCES_SPEECHES_TID, 'tid', $this->targetObject->getVar('tid'));
        $tracks_id_select->addOptionArray($tracksHandler->getList());
        $this->addElement($tracks_id_select, false);
        // Slides1
        $slides1 = $this->targetObject->getVar('slides1') ?: 'blank.png';

        $uploadDir   = '/uploads/conferences/speeches/';
        $imgtray     = new \XoopsFormElementTray(AM_CONFERENCES_SPEECHES_SLIDES1, '<br>');
        $imgpath     = sprintf(AM_CONFERENCES_FORMIMAGE_PATH, $uploadDir);
        $imageselect = new \XoopsFormSelect($imgpath, 'slides1', $slides1);
        $imageArray  = \XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadDir);
        foreach ($imageArray as $image) {
            $imageselect->addOption((string)$image, $image);
        }
        $imageselect->setExtra("onchange='showImgSelected(\"image_slides1\", \"slides1\", \"" . $uploadDir . '", "", "' . XOOPS_URL . "\")'");
        $imgtray->addElement($imageselect);
        $imgtray->addElement(new \XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadDir . '/' . $slides1 . "' name='image_slides1' id='image_slides1' alt='' style='max-width:300px' >"));
        $fileseltray = new \XoopsFormElementTray('', '<br>');
        $fileseltray->addElement(new \XoopsFormFile(AM_CONFERENCES_FORMUPLOAD, 'slides1', $this->helper->getConfig('maxsize')));
        $fileseltray->addElement(new \XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);
        // Slides2
        $slides2 = $this->targetObject->getVar('slides2') ?: 'blank.png';

        $uploadDir   = '/uploads/conferences/speeches/';
        $imgtray     = new \XoopsFormElementTray(AM_CONFERENCES_SPEECHES_SLIDES2, '<br>');
        $imgpath     = sprintf(AM_CONFERENCES_FORMIMAGE_PATH, $uploadDir);
        $imageselect = new \XoopsFormSelect($imgpath, 'slides2', $slides2);
        $imageArray  = \XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadDir);
        foreach ($imageArray as $image) {
            $imageselect->addOption((string)$image, $image);
        }
        $imageselect->setExtra("onchange='showImgSelected(\"image_slides2\", \"slides2\", \"" . $uploadDir . '", "", "' . XOOPS_URL . "\")'");
        $imgtray->addElement($imageselect);
        $imgtray->addElement(new \XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadDir . '/' . $slides2 . "' name='image_slides2' id='image_slides2' alt='' style='max-width:300px' >"));
        $fileseltray = new \XoopsFormElementTray('', '<br>');
        $fileseltray->addElement(new \XoopsFormFile(AM_CONFERENCES_FORMUPLOAD, 'slides2', $this->helper->getConfig('maxsize')));
        $fileseltray->addElement(new \XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);
        // Slides3
        $slides3 = $this->targetObject->getVar('slides3') ?: 'blank.png';

        $uploadDir   = '/uploads/conferences/speeches/';
        $imgtray     = new \XoopsFormElementTray(AM_CONFERENCES_SPEECHES_SLIDES3, '<br>');
        $imgpath     = sprintf(AM_CONFERENCES_FORMIMAGE_PATH, $uploadDir);
        $imageselect = new \XoopsFormSelect($imgpath, 'slides3', $slides3);
        $imageArray  = \XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadDir);
        foreach ($imageArray as $image) {
            $imageselect->addOption((string)$image, $image);
        }
        $imageselect->setExtra("onchange='showImgSelected(\"image_slides3\", \"slides3\", \"" . $uploadDir . '", "", "' . XOOPS_URL . "\")'");
        $imgtray->addElement($imageselect);
        $imgtray->addElement(new \XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadDir . '/' . $slides3 . "' name='image_slides3' id='image_slides3' alt='' style='max-width:300px' >"));
        $fileseltray = new \XoopsFormElementTray('', '<br>');
        $fileseltray->addElement(new \XoopsFormFile(AM_CONFERENCES_FORMUPLOAD, 'slides3', $this->helper->getConfig('maxsize')));
        $fileseltray->addElement(new \XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);
        // Slides4
        $slides4 = $this->targetObject->getVar('slides4') ?: 'blank.png';

        $uploadDir   = '/uploads/conferences/speeches/';
        $imgtray     = new \XoopsFormElementTray(AM_CONFERENCES_SPEECHES_SLIDES4, '<br>');
        $imgpath     = sprintf(AM_CONFERENCES_FORMIMAGE_PATH, $uploadDir);
        $imageselect = new \XoopsFormSelect($imgpath, 'slides4', $slides4);
        $imageArray  = \XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadDir);
        foreach ($imageArray as $image) {
            $imageselect->addOption((string)$image, $image);
        }
        $imageselect->setExtra("onchange='showImgSelected(\"image_slides4\", \"slides4\", \"" . $uploadDir . '", "", "' . XOOPS_URL . "\")'");
        $imgtray->addElement($imageselect);
        $imgtray->addElement(new \XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadDir . '/' . $slides4 . "' name='image_slides4' id='image_slides4' alt='' style='max-width:300px' >"));
        $fileseltray = new \XoopsFormElementTray('', '<br>');
        $fileseltray->addElement(new \XoopsFormFile(AM_CONFERENCES_FORMUPLOAD, 'slides4', $this->helper->getConfig('maxsize')));
        $fileseltray->addElement(new \XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);

        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
