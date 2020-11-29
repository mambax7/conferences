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

use XoopsModules\Conferences;

require dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

/** @var \XoopsDatabase $db */
/** @var   \XoopsModules\Conferences\Helper $helper */
/** @var \XoopsModules\Conferences\Utility $utility */

$db      = \XoopsDatabaseFactory::getDatabaseConnection();
$helper  = \XoopsModules\Conferences\Helper::getInstance();
$utility = new \XoopsModules\Conferences\Utility();
//$configurator = new \XoopsModules\Conferences\Common\Configurator();

$helper->loadLanguage('common');

//handlers/** @var \XoopsPersistableObjectHandler $speakersHandler */
$speakersHandler = $helper->getHandler('Speakers');
/** @var \XoopsPersistableObjectHandler $speechesHandler */
$speechesHandler = $helper->getHandler('Speeches');
/** @var \XoopsPersistableObjectHandler $speechtypesHandler */
$speechtypesHandler = $helper->getHandler('Speechtypes');
/** @var \XoopsPersistableObjectHandler $tracksHandler */
$tracksHandler = $helper->getHandler('Tracks');
/** @var \XoopsPersistableObjectHandler $conferenceHandler */
$conferenceHandler = $helper->getHandler('Conference');
/** @var \XoopsPersistableObjectHandler $locationHandler */
$locationHandler = $helper->getHandler('Location');

$pathIcon16 = Xmf\Module\Admin::iconUrl('', 16);
$pathIcon32 = Xmf\Module\Admin::iconUrl('', 32);
//$pathModIcon16 = $helper->getConfig('modicons16');
//$pathModIcon32 = $helper->getConfig('modicons32');

if (!defined($moduleDirNameUpper . '_CONSTANTS_DEFINED')) {
    define($moduleDirNameUpper . '_DIRNAME', basename(dirname(__DIR__)));
    define($moduleDirNameUpper . '_ROOT_PATH', XOOPS_ROOT_PATH . '/modules/' . $moduleDirName);
    define($moduleDirNameUpper . '_PATH', XOOPS_ROOT_PATH . '/modules/' . $moduleDirName);
    define($moduleDirNameUpper . '_URL', XOOPS_URL . '/modules/' . $moduleDirName);
    define($moduleDirNameUpper . '_IMAGES_URL', constant($moduleDirNameUpper . '_URL') . '/assets/images/');
    define($moduleDirNameUpper . '_IMAGES_PATH', constant($moduleDirNameUpper . '_ROOT_PATH') . '/assets/images/');
    define($moduleDirNameUpper . '_ADMIN_URL', constant($moduleDirNameUpper . '_URL') . '/admin/');
    define($moduleDirNameUpper . '_ADMIN_PATH', constant($moduleDirNameUpper . '_ROOT_PATH') . '/admin/');
    define($moduleDirNameUpper . '_ADMIN', constant($moduleDirNameUpper . '_URL') . '/admin/index.php');
    //    define($moduleDirNameUpper . '_AUTHOR_LOGOIMG', constant($moduleDirNameUpper . '_URL') . '/assets/images/logoModule.png');
    define($moduleDirNameUpper . '_UPLOAD_URL', XOOPS_UPLOAD_URL . '/' . $moduleDirName); // WITHOUT Trailing slash
    define($moduleDirNameUpper . '_UPLOAD_PATH', XOOPS_UPLOAD_PATH . '/' . $moduleDirName); // WITHOUT Trailing slash
    define($moduleDirNameUpper . '_CAT_IMAGES_URL', XOOPS_UPLOAD_URL . ' / ' . constant($moduleDirNameUpper . '_DIRNAME') . '/images/category');
    define($moduleDirNameUpper . '_CAT_IMAGES_PATH', XOOPS_UPLOAD_PATH . '/' . constant($moduleDirNameUpper . '_DIRNAME') . ' / images / category');
    define($moduleDirNameUpper . '_CACHE_PATH', XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/');
    define($moduleDirNameUpper . '_AUTHOR_LOGOIMG', $pathIcon32 . '/xoopsmicrobutton.gif');
    define($moduleDirNameUpper . '_CONSTANTS_DEFINED', 1);
}

//define option du module
//define($moduleDirNameUpper. '_DISPLAY_CAT', $helper->getConfig('$mod_name_cat_display', 'none'));

//require dirname(__DIR__) . '/include/seo_functions.php';
//require dirname(__DIR__) . '/class/PageNav.php';

//require XOOPS_ROOT_PATH . '/class/tree.php';

//require dirname(__DIR__) . '/class/Tree.php';
//require dirname(__DIR__) . '/class/FormSelect.php';

// Load only if module is installed
//if (is_object($helper->getModule())) {
//    // Find if the user is admin of the module
//    $publisherIsAdmin = publisher\Utility::userIsAdmin();
//    // get current page
//    $publisherCurrentPage = publisher\Utility::getCurrentPage();
//}

$icons = [
    'edit'    => "<img src='" . $pathIcon16 . "/edit.png'  alt=" . _EDIT . "' align='middle'>",
    'delete'  => "<img src='" . $pathIcon16 . "/delete.png' alt='" . _DELETE . "' align='middle'>",
    'clone'   => "<img src='" . $pathIcon16 . "/editcopy.png' alt='" . _CLONE . "' align='middle'>",
    'preview' => "<img src='" . $pathIcon16 . "/view.png' alt='" . _PREVIEW . "' align='middle'>",
    'print'   => "<img src='" . $pathIcon16 . "/printer.png' alt='" . _CLONE . "' align='middle'>",
    'pdf'     => "<img src='" . $pathIcon16 . "/pdf.png' alt='" . _CLONE . "' align='middle'>",
    'add'     => "<img src='" . $pathIcon16 . "/add.png' alt='" . _ADD . "' align='middle'>",
    '0'       => "<img src='" . $pathIcon16 . "/0.png' alt='" . 0 . "' align='middle'>",
    '1'       => "<img src='" . $pathIcon16 . "/1.png' alt='" . 1 . "' align='middle'>",
];

$debug = false;

// MyTextSanitizer object
$myts = \MyTextSanitizer::getInstance();

if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof \XoopsTpl)) {
    require_once $GLOBALS['xoops']->path('class/template.php');
    $GLOBALS['xoopsTpl'] = new \XoopsTpl();
}

$GLOBALS['xoopsTpl']->assign('mod_url', XOOPS_URL . '/modules/' . $moduleDirName);
// Local icons path
if (is_object($helper->getModule())) {
    $pathModIcon16 = $helper->getConfig('modicons16');
    $pathModIcon32 = $helper->getConfig('modicons32');

    $GLOBALS['xoopsTpl']->assign('pathModIcon16', XOOPS_URL . '/modules/' . $moduleDirName . '/' . $pathModIcon16);
    $GLOBALS['xoopsTpl']->assign('pathModIcon32', $pathModIcon32);
}
