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
$moduleDirName      = basename(__DIR__);
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

$modversion = [
    'version'             => 2.0,
    'module_status'       => 'Beta 1',
    'release_date'        => '2020/11/29',
    'name'                => MI_CONFERENCES_NAME,
    'description'         => MI_CONFERENCES_DESC,
    'release'             => '2020-01-01',
    'author'              => 'XOOPS Development Team',
    'author_mail'         => 'name@site.com',
    'author_website_url'  => 'https://xoops.org',
    'author_website_name' => 'XOOPS Project',
    'credits'             => 'XOOPS Development Team',
    //    'license' => 'GPL 2.0 or later',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html',

    'release_info' => 'release_info',
    'release_file' => XOOPS_URL . "/modules/{$moduleDirName}/docs/release_info file",

    'manual'              => 'Installation.txt',
    'manual_file'         => XOOPS_URL . "/modules/{$moduleDirName}/docs/link to manual file",
    'min_php'             => '7.1',
    'min_xoops'           => '2.5.10',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.5'],
    'image'               => 'assets/images/logoModule.png',
    'dirname'             => $moduleDirName,
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',
    //About
    'demo_site_url'       => 'https://xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'https://xoops.org/modules/newbb',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    // Admin system menu
    'system_menu'         => 1,
    // Admin things
    'hasAdmin'            => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    // Menu
    'hasMain'             => 1,
    // Scripts to run upon installation or update
    'onInstall'           => 'include/oninstall.php',
    'onUpdate'            => 'include/onupdate.php',
    'onUninstall'         => 'include/onuninstall.php',
    // ------------------- Mysql -----------------------------
    'sqlfile'             => ['mysql' => 'sql/mysql.sql'],
    // ------------------- Tables ----------------------------
    'tables'              => [
        $moduleDirName . '_' . 'speakers',
        $moduleDirName . '_' . 'speeches',
        $moduleDirName . '_' . 'speechtypes',
        $moduleDirName . '_' . 'tracks',
        $moduleDirName . '_' . 'conference',
        $moduleDirName . '_' . 'location',
    ],
];
// ------------------- Search -----------------------------//
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'conferences_search';
//  ------------------- Comments -----------------------------//
$modversion['hasComments']          = 1;
$modversion['comments']['itemName'] = 'com_id';
$modversion['comments']['pageName'] = 'comments.php';
// Comment callback functions
$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'conferencesCommentsApprove';
$modversion['comments']['callback']['update']  = 'conferencesCommentsUpdate';
//  ------------------- Templates -----------------------------//
$modversion['templates'][] = ['file' => 'conferences_header.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'conferences_index.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'conferences_speakers.tpl', 'description' => ''];

$modversion['templates'][] = ['file' => 'conferences_speakers_list0.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'conferences_speeches.tpl', 'description' => ''];

$modversion['templates'][] = ['file' => 'conferences_speeches_list0.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'conferences_speechtypes.tpl', 'description' => ''];

$modversion['templates'][] = ['file' => 'conferences_speechtypes_list0.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'conferences_tracks.tpl', 'description' => ''];

$modversion['templates'][] = ['file' => 'conferences_tracks_list0.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'conferences_conference.tpl', 'description' => ''];

$modversion['templates'][] = ['file' => 'conferences_conference_list0.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'conferences_location.tpl', 'description' => ''];

$modversion['templates'][] = ['file' => 'conferences_location_list0.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'conferences_footer.tpl', 'description' => ''];

$modversion['templates'][] = ['file' => 'admin/conferences_admin_about.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'admin/conferences_admin_help.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'admin/conferences_admin_location.tpl', 'description' => ''];

// ------------------- Help files ------------------- //
$modversion['help']        = 'page=help';
$modversion['helpsection'] = [
    ['name' => MI_CONFERENCES_OVERVIEW, 'link' => 'page=help'],
    ['name' => MI_CONFERENCES_DISCLAIMER, 'link' => 'page=disclaimer'],
    ['name' => MI_CONFERENCES_LICENSE, 'link' => 'page=license'],
    ['name' => MI_CONFERENCES_SUPPORT, 'link' => 'page=support'],

    //    ['name' => MI_CONFERENCES_HELP1, 'link' => 'page=help1'],
    //    ['name' => MI_CONFERENCES_HELP2, 'link' => 'page=help2']
    //    ['name' => MI_CONFERENCES_HELP3, 'link' => 'page=help3'],
    //    ['name' => MI_CONFERENCES_HELP4, 'link' => 'page=help4'],
    //    ['name' => MI_CONFERENCES_HOWTO, 'link' => 'page=__howto'],
    //    ['name' => MI_CONFERENCES_REQUIREMENTS, 'link' => 'page=__requirements'],
    //    ['name' => MI_CONFERENCES_CREDITS, 'link' => 'page=__credits'],

];

// ------------------- Blocks -----------------------------//
$modversion['blocks'][] = [
    'file'        => 'speakers.php',
    'name'        => MI_CONFERENCES_SPEAKERS_BLOCK,
    'description' => '',
    'show_func'   => 'showConferencesSpeakers',
    'edit_func'   => 'editConferencesSpeakers',
    'options'     => '|5|25|0',
    'template'    => 'conferences_speakers_block.tpl',
];

$modversion['blocks'][] = [
    'file'        => 'speeches.php',
    'name'        => MI_CONFERENCES_SPEECHES_BLOCK,
    'description' => '',
    'show_func'   => 'showConferencesSpeeches',
    'edit_func'   => 'editConferencesSpeeches',
    'options'     => '|5|25|0',
    'template'    => 'conferences_speeches_block.tpl',
];

$modversion['blocks'][] = [
    'file'        => 'speechtypes.php',
    'name'        => MI_CONFERENCES_SPEECHTYPES_BLOCK,
    'description' => '',
    'show_func'   => 'showConferencesSpeechtypes',
    'edit_func'   => 'editConferencesSpeechtypes',
    'options'     => '|5|25|0',
    'template'    => 'conferences_speechtypes_block.tpl',
];

$modversion['blocks'][] = [
    'file'        => 'tracks.php',
    'name'        => MI_CONFERENCES_TRACKS_BLOCK,
    'description' => '',
    'show_func'   => 'showConferencesTracks',
    'edit_func'   => 'editConferencesTracks',
    'options'     => '|5|25|0',
    'template'    => 'conferences_tracks_block.tpl',
];

$modversion['blocks'][] = [
    'file'        => 'location.php',
    'name'        => MI_CONFERENCES_LOCATION_BLOCK,
    'description' => '',
    'show_func'   => 'showConferencesLocation',
    'edit_func'   => 'editConferencesLocation',
    'options'     => '|5|25|0',
    'template'    => 'conferences_location_block.tpl',
];

// ------------------- Config Options -----------------------------//
xoops_load('xoopseditorhandler');
$editorHandler          = \XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'conferencesEditorAdmin',
    'title'       => 'MI_CONFERENCES_EDITOR_ADMIN',
    'description' => 'MI_CONFERENCES_EDITOR_DESC_ADMIN',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => array_flip($editorHandler->getList()),
    'default'     => 'tinymce',
];

$modversion['config'][] = [
    'name'        => 'conferencesEditorUser',
    'title'       => 'MI_CONFERENCES_EDITOR_USER',
    'description' => 'MI_CONFERENCES_EDITOR_DESC_USER',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => array_flip($editorHandler->getList()),
    'default'     => 'dhtmltextarea',
];

// -------------- Get groups --------------
/** @var \XoopsMemberHandler $memberHandler */
$memberHandler = xoops_getHandler('member');
$xoopsGroups   = $memberHandler->getGroupList();
foreach ($xoopsGroups as $key => $group) {
    $groups[$group] = $key;
}
$modversion['config'][] = [
    'name'        => 'groups',
    'title'       => 'MI_CONFERENCES_GROUPS',
    'description' => 'MI_CONFERENCES_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'options'     => $groups,
    'default'     => $groups,
];

// -------------- Get Admin groups --------------
$criteria = new \CriteriaCompo ();
$criteria->add(new \Criteria ('group_type', 'Admin'));
/** @var \XoopsMemberHandler $memberHandler */
$memberHandler    = xoops_getHandler('member');
$adminXoopsGroups = $memberHandler->getGroupList($criteria);
foreach ($adminXoopsGroups as $key => $adminGroup) {
    $admin_groups[$adminGroup] = $key;
}
$modversion['config'][] = [
    'name'        => 'admin_groups',
    'title'       => 'MI_CONFERENCES_ADMINGROUPS',
    'description' => 'MI_CONFERENCES_ADMINGROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'options'     => $admin_groups,
    'default'     => $admin_groups,
];

$modversion['config'][] = [
    'name'        => 'keywords',
    'title'       => 'MI_CONFERENCES_KEYWORDS',
    'description' => 'MI_CONFERENCES_KEYWORDS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'conferences,speakers, speeches, speechtypes, tracks, location',
];

// --------------Uploads : maxsize of image --------------
$modversion['config'][] = [
    'name'        => 'maxsize',
    'title'       => 'MI_CONFERENCES_MAXSIZE',
    'description' => 'MI_CONFERENCES_MAXSIZE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 5000000,
];

// --------------Uploads : mimetypes of image --------------
$modversion['config'][] = [
    'name'        => 'mimetypes',
    'title'       => 'MI_CONFERENCES_MIMETYPES',
    'description' => 'MI_CONFERENCES_MIMETYPES_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['image/gif', 'image/jpeg', 'image/jpg', 'image/png'],
    'options'     => [
        'bmp'   => 'image/bmp',
        'gif'   => 'image/gif',
        'pjpeg' => 'image/pjpeg',
        'jpeg'  => 'image/jpeg',
        'jpg'   => 'image/jpg',
        'jpe'   => 'image/jpe',
        'png'   => 'image/png',
    ],
];

$modversion['config'][] = [
    'name'        => 'adminpager',
    'title'       => 'MI_CONFERENCES_ADMINPAGER',
    'description' => 'MI_CONFERENCES_ADMINPAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];

$modversion['config'][] = [
    'name'        => 'userpager',
    'title'       => 'MI_CONFERENCES_USERPAGER',
    'description' => 'MI_CONFERENCES_USERPAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];

$modversion['config'][] = [
    'name'        => 'advertise',
    'title'       => 'MI_CONFERENCES_ADVERTISE',
    'description' => 'MI_CONFERENCES_ADVERTISE_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => '',
];

$modversion['config'][] = [
    'name'        => 'bookmarks',
    'title'       => 'MI_CONFERENCES_BOOKMARKS',
    'description' => 'MI_CONFERENCES_BOOKMARKS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];

$modversion['config'][] = [
    'name'        => 'fbcomments',
    'title'       => 'MI_CONFERENCES_FBCOMMENTS',
    'description' => 'MI_CONFERENCES_FBCOMMENTS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];

// Truncate Max. length 
$modversion['config'][] = [
    'name'        => 'truncatelength',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'TRUNCATE_LENGTH',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'TRUNCATE_LENGTH_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 100,
];

/**
 * Make Sample button visible?
 */
$modversion['config'][] = [
    'name'        => 'displaySampleButton',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

/**
 * Show Developer Tools?
 */
$modversion['config'][] = [
    'name'        => 'displayDeveloperTools',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];

// -------------- Notifications conferences --------------
$modversion['hasNotification']             = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'conferences_notify_iteminfo';

$modversion['notification']['category'][] = [
    'name'           => 'global',
    'title'          => MI_CONFERENCES_GLOBAL_NOTIFY,
    'description'    => MI_CONFERENCES_GLOBAL_NOTIFY_DESC,
    'subscribe_from' => ['index.php', 'viewcat.php', 'singlefile.php'],
];

$modversion['notification']['category'][] = [
    'name'           => 'category',
    'title'          => MI_CONFERENCES_CATEGORY_NOTIFY,
    'description'    => MI_CONFERENCES_CATEGORY_NOTIFY_DESC,
    'subscribe_from' => ['viewcat.php', 'singlefile.php'],
    'item_name'      => 'cid',
    'allow_bookmark' => 1,
];

$modversion['notification']['category'][] = [
    'name'           => 'file',
    'title'          => MI_CONFERENCES_FILE_NOTIFY,
    'description'    => MI_CONFERENCES_FILE_NOTIFY_DESC,
    'subscribe_from' => 'singlefile.php',
    'item_name'      => 'lid',
    'allow_bookmark' => 1,
];

$modversion['notification']['event'][] = [
    'name'          => 'new_category',
    'category'      => 'global',
    'title'         => MI_CONFERENCES_GLOBAL_NEWCATEGORY_NOTIFY,
    'caption'       => MI_CONFERENCES_GLOBAL_NEWCATEGORY_NOTIFY_CAPTION,
    'description'   => MI_CONFERENCES_GLOBAL_NEWCATEGORY_NOTIFY_DESC,
    'mail_template' => 'global_newcategory_notify',
    'mail_subject'  => MI_CONFERENCES_GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'file_modify',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => MI_CONFERENCES_GLOBAL_FILEMODIFY_NOTIFY,
    'caption'       => MI_CONFERENCES_GLOBAL_FILEMODIFY_NOTIFY_CAPTION,
    'description'   => MI_CONFERENCES_GLOBAL_FILEMODIFY_NOTIFY_DESC,
    'mail_template' => 'global_filemodify_notify',
    'mail_subject'  => MI_CONFERENCES_GLOBAL_FILEMODIFY_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'file_broken',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => MI_CONFERENCES_GLOBAL_FILEBROKEN_NOTIFY,
    'caption'       => MI_CONFERENCES_GLOBAL_FILEBROKEN_NOTIFY_CAPTION,
    'description'   => MI_CONFERENCES_GLOBAL_FILEBROKEN_NOTIFY_DESC,
    'mail_template' => 'global_filebroken_notify',
    'mail_subject'  => MI_CONFERENCES_GLOBAL_FILEBROKEN_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'file_submit',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => MI_CONFERENCES_GLOBAL_FILESUBMIT_NOTIFY,
    'caption'       => MI_CONFERENCES_GLOBAL_FILESUBMIT_NOTIFY_CAPTION,
    'description'   => MI_CONFERENCES_GLOBAL_FILESUBMIT_NOTIFY_DESC,
    'mail_template' => 'global_filesubmit_notify',
    'mail_subject'  => MI_CONFERENCES_GLOBAL_FILESUBMIT_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'new_file',
    'category'      => 'global',
    'title'         => MI_CONFERENCES_GLOBAL_NEWFILE_NOTIFY,
    'caption'       => MI_CONFERENCES_GLOBAL_NEWFILE_NOTIFY_CAPTION,
    'description'   => MI_CONFERENCES_GLOBAL_NEWFILE_NOTIFY_DESC,
    'mail_template' => 'global_newfile_notify',
    'mail_subject'  => MI_CONFERENCES_GLOBAL_NEWFILE_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'file_submit',
    'category'      => 'category',
    'admin_only'    => 1,
    'title'         => MI_CONFERENCES_CATEGORY_FILESUBMIT_NOTIFY,
    'caption'       => MI_CONFERENCES_CATEGORY_FILESUBMIT_NOTIFY_CAPTION,
    'description'   => MI_CONFERENCES_CATEGORY_FILESUBMIT_NOTIFY_DESC,
    'mail_template' => 'category_filesubmit_notify',
    'mail_subject'  => MI_CONFERENCES_CATEGORY_FILESUBMIT_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'new_file',
    'category'      => 'category',
    'title'         => MI_CONFERENCES_CATEGORY_NEWFILE_NOTIFY,
    'caption'       => MI_CONFERENCES_CATEGORY_NEWFILE_NOTIFY_CAPTION,
    'description'   => MI_CONFERENCES_CATEGORY_NEWFILE_NOTIFY_DESC,
    'mail_template' => 'category_newfile_notify',
    'mail_subject'  => MI_CONFERENCES_CATEGORY_NEWFILE_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'approve',
    'category'      => 'file',
    'admin_only'    => 1,
    'title'         => MI_CONFERENCES_FILE_APPROVE_NOTIFY,
    'caption'       => MI_CONFERENCES_FILE_APPROVE_NOTIFY_CAPTION,
    'description'   => MI_CONFERENCES_FILE_APPROVE_NOTIFY_DESC,
    'mail_template' => 'file_approve_notify',
    'mail_subject'  => MI_CONFERENCES_FILE_APPROVE_NOTIFY_SUBJECT,
];
