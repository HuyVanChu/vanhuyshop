/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {

    config.filebrowserBrowseUrl = '../ckfinder/ckfinder.html';
    config.filebrowserUploadUrl = '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    // config.extraPlugins = '../../uploadimage';
    // config.removePlugins = 'image,table,tabletools,horizontalrule';
    // config.removeButtons = 'Anchor,Underline,Strike,Subscript,Superscript';
    // config.format_tags = 'p;h1;h2;pre';
    // Define changes to default configuration here. For example:
    config.language = 'vi';
    config.uiColor = '#edeff1';
};
