/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
    config.language = 'pl';
	// config.uiColor = '#AADC6E';
    config.extraPlugins = 'uploadimage';
    config.extraPlugins = 'filebrowser';
    config.removePlugins = 'easyimage, cloudservices';
    config.removeDialogTabs = 'image:advanced;link:advanced';
    config.filebrowserUploadUrl = $('#CKEDITOR_UPLOAD_URL').val();
    config.filebrowserUploadMethod = 'form'
};
