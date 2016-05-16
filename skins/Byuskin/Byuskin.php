<?php

if ( function_exists( 'wfLoadSkin' ) ) {
	wfLoadSkin( 'Byuskin' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	
	/* wfWarn(
		'Deprecated PHP entry point used for CologneBlue skin. Please use wfLoadSkin instead, ' .
		'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	); */
	return true;
} else {
	die( 'This version of the byu skin requires MediaWiki 1.25+' );
}
