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
// Admin
define('MI_CONFERENCES_NAME', 'Conferences');
define('MI_CONFERENCES_DESC', 'This module is for managing conferences');
//Menu
define('MI_CONFERENCES_ADMENU1', 'Home');
define('MI_CONFERENCES_ADMENU2', 'Speakers');
define('MI_CONFERENCES_ADMENU3', 'Speeches');
define('MI_CONFERENCES_ADMENU4', 'SpeechType');
define('MI_CONFERENCES_ADMENU5', 'Tracks');
define('MI_CONFERENCES_ADMENU6', 'Conference');
define('MI_CONFERENCES_ADMENU7', 'Location');
define('MI_CONFERENCES_ADMENU8', 'Feedback');
define('MI_CONFERENCES_ADMENU9', 'Migrate');
define('MI_CONFERENCES_ADMENU10', 'About');
//Blocks
define('MI_CONFERENCES_SPEAKERS_BLOCK', 'Speakers block');
define('MI_CONFERENCES_SPEECHES_BLOCK', 'Speeches block');
define('MI_CONFERENCES_SPEECHTYPES_BLOCK', 'Speechtypes block');
define('MI_CONFERENCES_TRACKS_BLOCK', 'Tracks block');
define('MI_CONFERENCES_LOCATION_BLOCK', 'Location block');
//Config
define('MI_CONFERENCES_EDITOR_ADMIN', 'Editor: Admin');
define('MI_CONFERENCES_EDITOR_ADMIN_DESC', 'Select the Editor to use by the Admin');
define('MI_CONFERENCES_EDITOR_USER', 'Editor: User');
define('MI_CONFERENCES_EDITOR_USER_DESC', 'Select the Editor to use by the User');
define('MI_CONFERENCES_KEYWORDS', 'Keywords');
define('MI_CONFERENCES_KEYWORDS_DESC', 'Insert here the keywords (separate by comma)');
define('MI_CONFERENCES_ADMINPAGER', 'Admin: records / page');
define('MI_CONFERENCES_ADMINPAGER_DESC', 'Admin: # of records shown per page');
define('MI_CONFERENCES_USERPAGER', 'User: records / page');
define('MI_CONFERENCES_USERPAGER_DESC', 'User: # of records shown per page');
define('MI_CONFERENCES_MAXSIZE', 'Max size');
define('MI_CONFERENCES_MAXSIZE_DESC', 'Set a number of max size uploads file in byte');
define('MI_CONFERENCES_MIMETYPES', 'Mime Types');
define('MI_CONFERENCES_MIMETYPES_DESC', 'Set the mime types selected');
define('MI_CONFERENCES_IDPAYPAL', 'Paypal ID');
define('MI_CONFERENCES_IDPAYPAL_DESC', 'Insert here your PayPal ID for donactions.');
define('MI_CONFERENCES_ADVERTISE', 'Advertisement Code');
define('MI_CONFERENCES_ADVERTISE_DESC', 'Insert here the advertisement code');
define('MI_CONFERENCES_BOOKMARKS', 'Social Bookmarks');
define('MI_CONFERENCES_BOOKMARKS_DESC', 'Show Social Bookmarks in the form');
define('MI_CONFERENCES_FBCOMMENTS', 'Facebook comments');
define('MI_CONFERENCES_FBCOMMENTS_DESC', 'Allow Facebook comments in the form');
// Notifications
define('MI_CONFERENCES_GLOBAL_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_CATEGORY_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_CATEGORY_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_FILE_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_FILE_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_NEWCATEGORY_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_NEWCATEGORY_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_NEWCATEGORY_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_FILEMODIFY_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_FILEMODIFY_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_FILEMODIFY_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_FILEMODIFY_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_FILEBROKEN_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_FILEBROKEN_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_FILEBROKEN_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_FILEBROKEN_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_FILESUBMIT_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_FILESUBMIT_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_FILESUBMIT_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_FILESUBMIT_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_NEWFILE_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_NEWFILE_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_NEWFILE_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_GLOBAL_NEWFILE_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_CATEGORY_FILESUBMIT_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_CATEGORY_FILESUBMIT_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_CATEGORY_FILESUBMIT_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_CATEGORY_FILESUBMIT_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_CATEGORY_NEWFILE_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_CATEGORY_NEWFILE_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_CATEGORY_NEWFILE_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_CATEGORY_NEWFILE_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_FILE_APPROVE_NOTIFY', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_FILE_APPROVE_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_FILE_APPROVE_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_CONFERENCES_FILE_APPROVE_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');

// Help
define('MI_CONFERENCES_DIRNAME', basename(dirname(dirname(__DIR__))));
define('MI_CONFERENCES_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('MI_CONFERENCES_BACK_2_ADMIN', 'Back to Administration of ');
define('MI_CONFERENCES_OVERVIEW', 'Overview');
// The name of this module
//define('MI_CONFERENCES_NAME', 'YYYYY Module Name');

//define('MI_CONFERENCES_HELP_DIR', __DIR__);

//help multi-page
define('MI_CONFERENCES_DISCLAIMER', 'Disclaimer');
define('MI_CONFERENCES_LICENSE', 'License');
define('MI_CONFERENCES_SUPPORT', 'Support');
//define('MI_CONFERENCES_REQUIREMENTS', 'Requirements');
//define('MI_CONFERENCES_CREDITS', 'Credits');
//define('MI_CONFERENCES_HOWTO', 'How To');
//define('MI_CONFERENCES_UPDATE', 'Update');
//define('MI_CONFERENCES_INSTALL', 'Install');
//define('MI_CONFERENCES_HISTORY', 'History');
//define('MI_CONFERENCES_HELP1', 'YYYYY');
//define('MI_CONFERENCES_HELP2', 'YYYYY');
//define('MI_CONFERENCES_HELP3', 'YYYYY');
//define('MI_CONFERENCES_HELP4', 'YYYYY');
//define('MI_CONFERENCES_HELP5', 'YYYYY');
//define('MI_CONFERENCES_HELP6', 'YYYYY');

// Permissions Groups
define('MI_CONFERENCES_GROUPS', 'Groups access');
define('MI_CONFERENCES_GROUPS_DESC', 'Select general access permission for groups.');
define('MI_CONFERENCES_ADMINGROUPS', 'Admin Group Permissions');
define('MI_CONFERENCES_ADMINGROUPS_DESC', 'Which groups have access to tools and permissions page');

//define('MI_CONFERENCES_SHOW_SAMPLE_BUTTON', 'Import Sample Button?');
//define('MI_CONFERENCES_SHOW_SAMPLE_BUTTON_DESC', 'If yes, the "Add Sample Data" button will be visible to the Admin. It is Yes as a default for first installation.');

