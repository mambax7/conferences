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

//Index
define('AM_CONFERENCES_STATISTICS', 'Conferences statistics');
define('AM_CONFERENCES_THEREARE_SPEAKERS', "There are <span class='bold'>%s</span> Speakers in the database");
define('AM_CONFERENCES_THEREARE_SPEECHES', "There are <span class='bold'>%s</span> Speeches in the database");
define('AM_CONFERENCES_THEREARE_SPEECHTYPE', "There are <span class='bold'>%s</span> SpeechType in the database");
define('AM_CONFERENCES_THEREARE_TRACKS', "There are <span class='bold'>%s</span> Tracks in the database");
define('AM_CONFERENCES_THEREARE_CONFERENCE', "There are <span class='bold'>%s</span> Conference in the database");
define('AM_CONFERENCES_THEREARE_LOCATION', "There are <span class='bold'>%s</span> Location in the database");
//Buttons
define('AM_CONFERENCES_ADD_SPEAKERS', 'Add new Speakers');
define('AM_CONFERENCES_SPEAKERS_LIST', 'List of Speakers');
define('AM_CONFERENCES_ADD_SPEECHES', 'Add new Speeches');
define('AM_CONFERENCES_SPEECHES_LIST', 'List of Speeches');
define('AM_CONFERENCES_ADD_SPEECHTYPES', 'Add new SpeechType');
define('AM_CONFERENCES_SPEECHTYPES_LIST', 'List of SpeechType');
define('AM_CONFERENCES_ADD_TRACKS', 'Add new Tracks');
define('AM_CONFERENCES_TRACKS_LIST', 'List of Tracks');
define('AM_CONFERENCES_ADD_CONFERENCE', 'Add new Conference');
define('AM_CONFERENCES_CONFERENCE_LIST', 'List of Conference');
define('AM_CONFERENCES_ADD_LOCATION', 'Add new Location');
define('AM_CONFERENCES_LOCATION_LIST', 'List of Location');
//General
define('AM_CONFERENCES_FORMOK', 'Registered successfull');
define('AM_CONFERENCES_FORMDELOK', 'Deleted successfull');
define('AM_CONFERENCES_FORMSUREDEL', "Are you sure to Delete: <span class='bold red'>%s</span></b>");
define('AM_CONFERENCES_FORMSURERENEW', "Are you sure to Renew: <span class='bold red'>%s</span></b>");
define('AM_CONFERENCES_FORMUPLOAD', 'Upload');
define('AM_CONFERENCES_FORMIMAGE_PATH', 'File presents in %s');
define('AM_CONFERENCES_FORM_ACTION', 'Action');
define('AM_CONFERENCES_SELECT', 'Select action for selected item(s)');
define('AM_CONFERENCES_SELECTED_DELETE', 'Delete selected item(s)');
define('AM_CONFERENCES_SELECTED_ACTIVATE', 'Activate selected item(s)');
define('AM_CONFERENCES_SELECTED_DEACTIVATE', 'De-activate selected item(s)');
define('AM_CONFERENCES_SELECTED_ERROR', 'You selected nothing to delete');
define('AM_CONFERENCES_CLONED_OK', 'Record cloned successfully');
define('AM_CONFERENCES_CLONED_FAILED', 'Cloning of the record has failed');

// Speakers
define('AM_CONFERENCES_SPEAKERS_ADD', 'Add a speakers');
define('AM_CONFERENCES_SPEAKERS_EDIT', 'Edit speakers');
define('AM_CONFERENCES_SPEAKERS_DELETE', 'Delete speakers');
define('AM_CONFERENCES_SPEAKERS_ID', 'ID');
define('AM_CONFERENCES_SPEAKERS_NAME', 'Name');
define('AM_CONFERENCES_SPEAKERS_EMAIL', 'Email');
define('AM_CONFERENCES_SPEAKERS_DESCRIP', 'Description');
define('AM_CONFERENCES_SPEAKERS_LOCATION', 'Location');
define('AM_CONFERENCES_SPEAKERS_COMPANY', 'Company');
define('AM_CONFERENCES_SPEAKERS_PHOTO', 'Photo');
define('AM_CONFERENCES_SPEAKERS_URL', 'Url');
define('AM_CONFERENCES_SPEAKERS_HITS', 'Hits');
// Speeches
define('AM_CONFERENCES_SPEECHES_ADD', 'Add a speeches');
define('AM_CONFERENCES_SPEECHES_EDIT', 'Edit speeches');
define('AM_CONFERENCES_SPEECHES_DELETE', 'Delete speeches');
define('AM_CONFERENCES_SPEECHES_ID', 'ID');
define('AM_CONFERENCES_SPEECHES_TYPEID', 'SpeechType');
define('AM_CONFERENCES_SPEECHES_TITLE', 'Title');
define('AM_CONFERENCES_SPEECHES_SUMMARY', 'Summary');
define('AM_CONFERENCES_SPEECHES_STIME', 'StartTime');
define('AM_CONFERENCES_SPEECHES_ETIME', 'EndTime');
define('AM_CONFERENCES_SPEECHES_DURATION', 'Duration');
define('AM_CONFERENCES_SPEECHES_SPEAKERID', 'Speaker');
define('AM_CONFERENCES_SPEECHES_CID', 'Conference');
define('AM_CONFERENCES_SPEECHES_TID', 'Track');
define('AM_CONFERENCES_SPEECHES_SLIDES1', 'Slides1');
define('AM_CONFERENCES_SPEECHES_SLIDES2', 'Slides2');
define('AM_CONFERENCES_SPEECHES_SLIDES3', 'Slides3');
define('AM_CONFERENCES_SPEECHES_SLIDES4', 'Slides4');
// Speechtypes
define('AM_CONFERENCES_SPEECHTYPES_ADD', 'Add a speechtypes');
define('AM_CONFERENCES_SPEECHTYPES_EDIT', 'Edit speechtypes');
define('AM_CONFERENCES_SPEECHTYPES_DELETE', 'Delete speechtypes');
define('AM_CONFERENCES_SPEECHTYPES_ID', 'ID');
define('AM_CONFERENCES_SPEECHTYPES_NAME', 'Name');
define('AM_CONFERENCES_SPEECHTYPES_COLOR', 'Color');
define('AM_CONFERENCES_SPEECHTYPES_PLENARY', 'Plenary');
define('AM_CONFERENCES_SPEECHTYPES_LOGO', 'Logo');
// Tracks
define('AM_CONFERENCES_TRACKS_ADD', 'Add a tracks');
define('AM_CONFERENCES_TRACKS_EDIT', 'Edit tracks');
define('AM_CONFERENCES_TRACKS_DELETE', 'Delete tracks');
define('AM_CONFERENCES_TRACKS_ID', 'ID');
define('AM_CONFERENCES_TRACKS_CID', 'Conference');
define('AM_CONFERENCES_TRACKS_TITLE', 'Title');
define('AM_CONFERENCES_TRACKS_SUMMARY', 'Summary');
// Conference
define('AM_CONFERENCES_CONFERENCE_ADD', 'Add a conference');
define('AM_CONFERENCES_CONFERENCE_EDIT', 'Edit conference');
define('AM_CONFERENCES_CONFERENCE_DELETE', 'Delete conference');
define('AM_CONFERENCES_CONFERENCE_ID', 'ID');
define('AM_CONFERENCES_CONFERENCE_TITLE', 'Title');
define('AM_CONFERENCES_CONFERENCE_SUBTITLE', 'Subtitle');
define('AM_CONFERENCES_CONFERENCE_SUBSUBTITLE', 'Subsubtitle');
define('AM_CONFERENCES_CONFERENCE_SDATE', 'StartDate');
define('AM_CONFERENCES_CONFERENCE_EDATE', 'EndDate');
define('AM_CONFERENCES_CONFERENCE_SUMMARY', 'Summary');
define('AM_CONFERENCES_CONFERENCE_ISDEFAULT', 'IsDefault');
define('AM_CONFERENCES_CONFERENCE_LOGO', 'Logo');
// Location
define('AM_CONFERENCES_LOCATION_ADD', 'Add a location');
define('AM_CONFERENCES_LOCATION_EDIT', 'Edit location');
define('AM_CONFERENCES_LOCATION_DELETE', 'Delete location');
define('AM_CONFERENCES_LOCATION_ID', 'ID');
define('AM_CONFERENCES_LOCATION_CID', 'Conference');
define('AM_CONFERENCES_LOCATION_TITLE', 'Title');
define('AM_CONFERENCES_LOCATION_SUMMARY', 'Summary');
define('AM_CONFERENCES_LOCATION_IMAGE', 'Image');
//Blocks.php
//Permissions
define('AM_CONFERENCES_PERMISSIONS_GLOBAL', 'Global permissions');
define('AM_CONFERENCES_PERMISSIONS_GLOBAL_DESC', 'Only users in the group that you select may global this');
define('AM_CONFERENCES_PERMISSIONS_GLOBAL_4', 'Rate from user');
define('AM_CONFERENCES_PERMISSIONS_GLOBAL_8', 'Submit from user side');
define('AM_CONFERENCES_PERMISSIONS_GLOBAL_16', 'Auto approve');
define('AM_CONFERENCES_PERMISSIONS_APPROVE', 'Permissions to approve');
define('AM_CONFERENCES_PERMISSIONS_APPROVE_DESC', 'Only users in the group that you select may approve this');
define('AM_CONFERENCES_PERMISSIONS_VIEW', 'Permissions to view');
define('AM_CONFERENCES_PERMISSIONS_VIEW_DESC', 'Only users in the group that you select may view this');
define('AM_CONFERENCES_PERMISSIONS_SUBMIT', 'Permissions to submit');
define('AM_CONFERENCES_PERMISSIONS_SUBMIT_DESC', 'Only users in the group that you select may submit this');
define('AM_CONFERENCES_PERMISSIONS_GPERMUPDATED', 'Permissions have been changed successfully');
define('AM_CONFERENCES_PERMISSIONS_NOPERMSSET', 'Permission cannot be set: No location created yet! Please create a location first.');

//Errors
define('AM_CONFERENCES_UPGRADEFAILED0', "Update failed - couldn't rename field '%s'");
define('AM_CONFERENCES_UPGRADEFAILED1', "Update failed - couldn't add new fields");
define('AM_CONFERENCES_UPGRADEFAILED2', "Update failed - couldn't rename table '%s'");
define('AM_CONFERENCES_ERROR_COLUMN', 'Could not create column in database : %s');
define('AM_CONFERENCES_ERROR_BAD_XOOPS', 'This module requires XOOPS %s+ (%s installed)');
define('AM_CONFERENCES_ERROR_BAD_PHP', 'This module requires PHP version %s+ (%s installed)');
define('AM_CONFERENCES_ERROR_TAG_REMOVAL', 'Could not remove tags from Tag Module');
//directories
define('AM_CONFERENCES_AVAILABLE', "<span style='color : #008000;'>Available. </span>");
define('AM_CONFERENCES_NOTAVAILABLE', "<span style='color : #ff0000;'>is not available. </span>");
define('AM_CONFERENCES_NOTWRITABLE', "<span style='color : #ff0000;'>" . ' should have permission ( %1$d ), but it has ( %2$d )' . '</span>');
define('AM_CONFERENCES_CREATETHEDIR', 'Create it');
define('AM_CONFERENCES_SETMPERM', 'Set the permission');
define('AM_CONFERENCES_DIRCREATED', 'The directory has been created');
define('AM_CONFERENCES_DIRNOTCREATED', 'The directory can not be created');
define('AM_CONFERENCES_PERMSET', 'The permission has been set');
define('AM_CONFERENCES_PERMNOTSET', 'The permission can not be set');
define('AM_CONFERENCES_VIDEO_EXPIREWARNING', 'The publishing date is after expiration date!!!');
//Sample Data
define('AM_CONFERENCES_ADD_SAMPLEDATA', 'Import Sample Data (will delete ALL current data)');
define('AM_CONFERENCES_SAMPLEDATA_SUCCESS', 'Sample Date uploaded successfully');

define('AM_CONFERENCES_MAINTAINEDBY', 'is maintained by the');
