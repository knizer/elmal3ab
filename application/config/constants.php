<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

// Important URLS
define('ROOT', 'http://dev.nteches.com/elwatannews_admin/');
define('ASSETS', ROOT . 'assets/');
define('UPLOADS', ROOT . 'uploads/');
define('IMG_ARCHIVE', UPLOADS . 'image_archive/');
define('VIDEO_UPLOAD', UPLOADS . 'image_archive/');
define('INTERACTIVE_FILES', UPLOADS . 'interactive_files/');
define('USER_PHOTOS', UPLOADS . 'user_photos/');
define('VIDEOS', UPLOADS . 'videos/');

// Important Uploads server paths
define('UPLOADS_PATH', $_SERVER["DOCUMENT_ROOT"] . '/elwatannews_admin/uploads/');
define('IMG_ARCHIVE_PATH', UPLOADS_PATH . 'image_archive/');
define('IMG_ORIGINAL_PATH', IMG_ARCHIVE_PATH . 'original/');
define('IMG_LARGE_PATH', IMG_ARCHIVE_PATH . 'large/');
define('IMG_MEDIUM_PATH', IMG_ARCHIVE_PATH . 'medium/');
define('IMG_PORTRAIT_PATH', IMG_ARCHIVE_PATH . 'portrait/');
define('IMG_SMALL_PATH', IMG_ARCHIVE_PATH . 'small/');
define('IMG_CACHE_PATH', IMG_ARCHIVE_PATH . 'cache/');
define('INTERACTIVE_FILES_PATH', UPLOADS_PATH . 'interactive_files/');
define('USER_PHOTOS_PATH', UPLOADS_PATH . 'user_photos/');
define('VIDEOS_PATH', UPLOADS_PATH . 'videos/');


/* End of file constants.php */
/* Location: ./application/config/constants.php */