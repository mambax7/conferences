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
/**
 * CommentsUpdate
 *
 * @param mixed $itemId
 * @param mixed $commentCount
 * @return bool
 */
function conferencesCommentsUpdate($itemId, $commentCount)
{
    /** @var \XoopsModules\Conferences\Helper $helper */
    $helper = \XoopsModules\Conferences\Helper::getInstance();
    /** @var \XoopsPersistableObjectHandler $helper- >getHandler('Location') */
    if (!$helper->getHandler('Location')->updateAll('comments', (int)$commentCount, new \Criteria('lid', (int)$itemId))) {
        return false;
    }
    return true;
}

/**
 * CommentsApprove
 *
 * @param string $comment
 * @return void
 */
function conferencesCommentsApprove(&$comment)
{
    // notification mail here
}
