/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'basicstyles', groups: [ 'basicstyles' ] },
 		{ items: [ 'NumberedList', 'BulletedList'] },
 		{ items: [ 'Link', 'Unlink' ] }
	];
	config.height = 150;

	config.removeButtons = 'Underline,Subscript,Superscript,Strike';
};
