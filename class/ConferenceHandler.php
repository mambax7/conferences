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

$moduleDirName = basename(dirname(__DIR__));

$permHelper = new \Xmf\Module\Helper\Permission();

/**
 * Class ConferenceHandler
 */
class ConferenceHandler extends \XoopsPersistableObjectHandler
{
    /**
     * @var Helper
     */
    public $helper;

    /**
     * Constructor
     * @param null|\XoopsDatabase                   $db
     * @param null|\XoopsModules\Conferences\Helper $helper
     */

    public function __construct(\XoopsDatabase $db = null, $helper = null)
    {
        /** @var \XoopsModules\Conferences\Helper $this- >helper */
        $this->helper = $helper;
        parent::__construct($db, 'conferences_conference', Conference::class, 'id', 'title');
    }

    /**
     * @param bool $isNew
     *
     * @return \XoopsObject
     */
    public function create($isNew = true)
    {
        $obj         = parent::create($isNew);
        $obj->helper = $this->helper;

        return $obj;
    }
}
