<?php

declare(strict_types=1);

namespace XoopsModules\Conferences;

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

use XoopsModules\Conferences;
use XoopsModules\Conferences\Form;

//$permHelper = new \Xmf\Module\Helper\Permission();

/**
 * Class Speakers
 */
class Speakers extends \XoopsObject
{
    public $helper, $permHelper;

    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
        //        /** @var  Conferences\Helper $helper */
        //        $this->helper = Conferences\Helper::getInstance();
        $this->permHelper = new \Xmf\Module\Helper\Permission();

        $this->initVar('id', XOBJ_DTYPE_INT);
        $this->initVar('name', XOBJ_DTYPE_TXTBOX);
        $this->initVar('email', XOBJ_DTYPE_TXTBOX);
        $this->initVar('descrip', XOBJ_DTYPE_OTHER);
        $this->initVar('location', XOBJ_DTYPE_TXTBOX);
        $this->initVar('company', XOBJ_DTYPE_TXTBOX);
        $this->initVar('photo', XOBJ_DTYPE_TXTBOX);
        $this->initVar('url', XOBJ_DTYPE_TXTBOX);
        $this->initVar('hits', XOBJ_DTYPE_INT);
    }

    /**
     * Get form
     *
     * @param null
     * @return Conferences\Form\SpeakersForm
     */
    public function getForm()
    {
        $form = new Form\SpeakersForm($this);
        return $form;
    }

    /**
     * @return array|null
     */
    public function getGroupsRead()
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('id'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit()
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('id'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration()
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('id'));
    }
}

