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
 * Class SpeechtypesForm
 */
class SpeechtypesForm extends \XoopsThemeForm
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

        $title = $this->targetObject->isNew() ? sprintf(AM_CONFERENCES_SPEECHTYPES_ADD) : sprintf(AM_CONFERENCES_SPEECHTYPES_EDIT);
        parent::__construct($title, 'form', xoops_getenv('SCRIPT_NAME'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('id', $this->targetObject->getVar('id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new \XoopsFormLabel(AM_CONFERENCES_SPEECHTYPES_ID, $this->targetObject->getVar('id'), 'id'));
        // Name
        $this->addElement(new \XoopsFormText(AM_CONFERENCES_SPEECHTYPES_NAME, 'name', 50, 255, $this->targetObject->getVar('name')), false);
        // Color
        $this->addElement(new \XoopsFormColorPicker(AM_CONFERENCES_SPEECHTYPES_COLOR, 'color', $this->targetObject->getVar('color')), false);
        // Plenary
        $plenary = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('plenary');
        $this->addElement(new \XoopsFormRadioYN(AM_CONFERENCES_SPEECHTYPES_PLENARY, 'plenary', $plenary), false);
        // Logo
        $logo = $this->targetObject->getVar('logo') ?: 'blank.png';

        $uploadDir   = '/uploads/conferences/speechtypes/';
        $imgtray     = new \XoopsFormElementTray(AM_CONFERENCES_SPEECHTYPES_LOGO, '<br>');
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

        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
