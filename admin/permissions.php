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

use Xmf\Module\Admin;

require __DIR__ . '/admin_header.php';
xoops_cp_header();
require XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
if ('' != \Xmf\Request::getString('submit', '')) {
    redirect_header(XOOPS_URL . '/modules/' . $GLOBALS['xoopsModule']->dirname() . '/admin/permissions.php', 1, AM_CONFERENCES_PERMISSIONS_GPERMUPDATED);
}
// Check admin have access to this page
/*$group = $GLOBALS['xoopsUser']->getGroups ();
$groups = xoops_getModuleOption ( 'admin_groups', $thisDirname );
if (count ( array_intersect ( $group, $groups ) ) <= 0) {
    redirect_header ( 'index.php', 3, _NOPERM );
}*/
$adminObject->displayNavigation(basename(__FILE__));

$permission                = \Xmf\Request::getInt('permission', 1, 'POST');
$selected                  = ['', '', '', '',];
$selected[$permission - 1] = ' selected';

echo "
<form method='post' name='fselperm' action='permissions.php'>
    <table border=0>
        <tr>
            <td>
                <select name='permission' onChange='document.fselperm.submit()'>
                    <option value='1'" . $selected[0] . '>' . AM_CONFERENCES_PERMISSIONS_GLOBAL . "</option>
                    <option value='2'" . $selected[1] . '>' . AM_CONFERENCES_PERMISSIONS_APPROVE . "</option>
                    <option value='3'" . $selected[2] . '>' . AM_CONFERENCES_PERMISSIONS_SUBMIT . "</option>
                    <option value='4'" . $selected[3] . '>' . AM_CONFERENCES_PERMISSIONS_VIEW . '</option>
                </select>
            </td>
        </tr>
    </table>
</form>';

$module_id = $GLOBALS['xoopsModule']->getVar('mid');
switch ($permission) {
    case 1:
        $formTitle   = AM_CONFERENCES_PERMISSIONS_GLOBAL;
        $permName    = 'conferences_ac';
        $permDesc    = AM_CONFERENCES_PERMISSIONS_GLOBAL_DESC;
        $globalPerms = [
            '4'  => AM_CONFERENCES_PERMISSIONS_GLOBAL_4,
            '8'  => AM_CONFERENCES_PERMISSIONS_GLOBAL_8,
            '16' => AM_CONFERENCES_PERMISSIONS_GLOBAL_16,
        ];
        break;
    case 2:
        $formTitle = AM_CONFERENCES_PERMISSIONS_APPROVE;
        $permName  = 'conferences_approve';
        $permDesc  = AM_CONFERENCES_PERMISSIONS_APPROVE_DESC;
        break;
    case 3:
        $formTitle = AM_CONFERENCES_PERMISSIONS_SUBMIT;
        $permName  = 'conferences_submit';
        $permDesc  = AM_CONFERENCES_PERMISSIONS_SUBMIT_DESC;
        break;
    case 4:
        $formTitle = AM_CONFERENCES_PERMISSIONS_VIEW;
        $permName  = 'conferences_view';
        $permDesc  = AM_CONFERENCES_PERMISSIONS_VIEW_DESC;
        break;
}

$permform = new \XoopsGroupPermForm($formTitle, $module_id, $permName, $permDesc, 'admin/permissions.php');
if (1 == $permission) {
    foreach ($globalPerms as $perm_id => $perm_name) {
        $permform->addItem($perm_id, $perm_name);
    }
    echo $permform->render();
    echo '<br><br>';
} else {
    $criteria = new \CriteriaCompo();
    $criteria->setSort('title');
    $criteria->setOrder('ASC');
    $conference_count = $conferenceHandler->getCount($criteria);
    $conferenceArray  = $conferenceHandler->getObjects($criteria);
    unset($criteria);
    foreach (array_keys($conferenceArray) as $i) {
        $permform->addItem($conferenceArray[$i]->getVar('id'), $conferenceArray[$i]->getVar('title'));
    }
    // Check if conference exist before rendering the form and redirect, if there aren't conference
    if ($conference_count > 0) {
        echo $permform->render();
        echo '<br><br>';
    } else {
        redirect_header('conference.php?op=new', 3, AM_CONFERENCES_PERMISSIONS_NOPERMSSET);
        //exit ();
    }
}
unset($permform);
require __DIR__ . '/admin_footer.php';
