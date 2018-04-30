<?php


	define( 'EWF_SETUP_PAGE'			, 'functions.php');											# page containing set up
	define( 'EWF_SETUP_THEME_DOMAIN'	, 'integrity-wp');											# translation domain
	define( 'EWF_SETUP_THNAME'			, 'bitpub');												# theme options short name
	define( 'EWF_SETUP_TITLE'			, 'Integrity WordPress');									# wordpress menu title
	define( 'EWF_SETUP_THEME_NAME'		, 'Integrity Wordpress');									# wordpress menu title
	define( 'EWF_SETUP_VC_GROUP'		, __('Integrity Components', EWF_SETUP_THEME_DOMAIN));		# visual composer group components
	define( 'EWF_SETUP_THEME_VERSION'	, '1.0.1');													# theme version
	
	
	include_once ('framework/framework-setup.php');

?>