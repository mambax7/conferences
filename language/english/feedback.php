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
$moduleDirName      = basename(dirname(dirname(__DIR__)));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

define('CO_' . $moduleDirNameUpper . '_' . 'FB_FORM_TITLE', 'Send a feedback');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_RECIPIENT', 'Recipient');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_NAME', 'Name');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_NAME_PLACEHOLER', 'Please enter your name');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_SITE', 'Website');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_SITE_PLACEHOLER', 'Please enter your website');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_MAIL', 'Email');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_MAIL_PLACEHOLER', 'Please enter your email');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE', 'Type of feedback');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_SUGGESTION', 'Suggestions');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_BUGS', 'Bugs');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_TESTIMONIAL', 'Testimonials');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_FEATURES', 'Features');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_OTHERS', 'Misc');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_CONTENT', 'Feedback content');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_SEND_FOR', 'Feedback for module ');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_SEND_SUCCESS', 'Feedback successfully sent');
define('CO_' . $moduleDirNameUpper . '_' . 'FB_SEND_ERROR', 'An errror occured when feedback was sent!');
