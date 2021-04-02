<?php
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
  exit;
}


## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = "FIWIKI";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "";
$wgArticlePath = "/wiki/$1";

## The protocol and server name to use in fully-qualified URLs
$wgServer = "https://www.fiwiki.org";
$wgForceHTTPS = true;

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

## The URL paths to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogos = [ '1x' => "$wgResourceBasePath/fiwiki.png" ];

## SMTP
$wgSMTP = [
  'IDHost' => getenv('MW_SMTP_ID'),
  'host' => getenv('MW_SMTP_HOST'),
  'port' => getenv('MW_SMTP_PORT'),
  'username' => getenv('MW_SMTP_USER'),
  'password' => getenv('MW_SMTP_PASS'),
  'auth' => true
];

## Email preferences
$wgEnableEmail = true;
$wgEnableUserEmail = false;

$wgEmergencyContact = getenv('MW_MAIL_SENDER');
$wgPasswordSender = getenv('MW_MAIL_SENDER');

$wgEnotifUserTalk = false;
$wgEnotifWatchlist = false;
$wgEmailAuthentication = true;

## Restrict edit to registered and email confirmed users
$wgEmailConfirmToEdit = true;
$wgGroupPermissions['*']['edit'] = false;

## Database settings
$wgDBtype = "mysql";
$wgDBserver = "database";
$wgDBname = getenv('MYSQL_DATABASE');
$wgDBuser = getenv('MYSQL_USER');
$wgDBpassword = getenv('MYSQL_PASSWORD');

# MySQL specific settings
$wgDBprefix = "";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Shared database table
# This has no effect unless $wgSharedDB is also set.
$wgSharedTables[] = "actor";

## Shared memory settings
$wgMainCacheType = CACHE_ACCEL;
$wgMemCachedServers = [];

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = false;

# Periodically send a pingback to https://www.mediawiki.org/ with basic data
# about this MediaWiki instance. The Wikimedia Foundation shares this data
# with MediaWiki developers to help guide future development efforts.
$wgPingback = false;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale. This should ideally be set to an English
## language locale so that the behaviour of C library functions will
## be consistent with typical installations. Use $wgLanguageCode to
## localise the wiki.
$wgShellLocale = "C.UTF-8";

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publicly accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/data/Names.php
$wgLanguageCode = "es";

$wgSecretKey = getenv('MW_SECRETKEY');

# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = getenv('MW_UPGRADEKEY');

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "https://creativecommons.org/licenses/by-nc-sa/4.0/";
$wgRightsText = "Creative Commons Atribución-NoComercial-CompartirIgual";
$wgRightsIcon = "$wgResourceBasePath/resources/assets/licenses/cc-by-nc-sa.png";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
$wgDefaultSkin = "vector";

## Skins
wfLoadSkin( 'Vector' );

wfLoadExtension( 'MobileFrontend' );
wfLoadSkin( 'MinervaNeue' );
$wgMFDefaultSkinClass = 'SkinMinerva';

## Styling
wfLoadExtension( 'SyntaxHighlight_GeSHi' );

wfLoadExtension( 'SimpleMathJax' );
#$wgSmjUseCDN = false;

## Editors
wfLoadExtension( 'WikiEditor' );

wfLoadExtension( 'VisualEditor' );

## Admin tools
wfLoadExtension( 'ReplaceText' );

wfLoadExtension( 'Nuke' );

wfLoadExtension( 'Renameuser' );

wfLoadExtension( 'UserMerge' );
$wgGroupPermissions['sysop']['usermerge'] = true;

## Captchas
wfLoadExtensions([ 'ConfirmEdit', 'ConfirmEdit/hCaptcha' ]);
$wgHCaptchaSiteKey = getenv('CE_HC_SITEKEY');
$wgHCaptchaSecretKey = getenv('CE_HC_SECRETKEY');
$wgAllowConfirmedEmail = true;
