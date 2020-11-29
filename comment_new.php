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
use XoopsModules\Conferences;

require dirname(dirname(__DIR__)) . '/mainfile.php';
//require XOOPS_ROOT_PATH.'/modules/conferences/class/location.php';
$com_itemid = \Xmf\Request::getInt('com_itemid', 0);
if ($com_itemid > 0) {
    /** @var \XoopsPersistableObjectHandler $locationHandler */
    $locationHandler = $helper->getHandler('Location');

    $location       = $locationHandler->get($com_itemid);
    $com_replytitle = $location->getVar('title');
    require XOOPS_ROOT_PATH . '/include/comment_new.php';
}
