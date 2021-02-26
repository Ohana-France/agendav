<?php
// Site title
$app['site.title'] = \getenv('AGENDAV_TITLE');
// Site logo (should be placed in public/img). Optional
$app['site.logo'] = 'agendav_100transp.png';
// Site footer. Optional
$app['site.footer'] = \getenv('AGENDAV_FOOTER');
// Trusted proxy ips
$app['proxies'] = [];
// Database settings
$app['db.options'] = [
    	'dbname' => \getenv('AGENDAV_DB_DATABASE'),
        'user' => \getenv('AGENDAV_DB_USER'),
        'password' => \getenv('AGENDAV_DB_PASSWORD'),
    	'host' => \getenv('AGENDAV_DB_HOST'),
    	'driver' => 'pdo_mysql',
];
$app['csrf.secret'] = \getenv('AGENDAV_CSRF_SECRET');
// Log path
$app['log.path'] = \getenv('AGENDAV_LOG_DIR');
$app['log.level'] = \getenv('AGENDAV_LOG_LEVEL');
// Base URL
$app['caldav.baseurl'] = \getenv('AGENDAV_CALDAV_SERVER');
// Authentication method required by CalDAV server (basic or digest)
$app['caldav.authmethod'] = \getenv('AGENDAV_CALDAV_AUTH_METHOD');
// Whether to show public CalDAV urls
$app['caldav.publicurls'] = true;
// Whether to show public CalDAV urls
$app['caldav.baseurl.public'] = \getenv('AGENDAV_CALDAV_PUBLICURL');
// Default timezone
$app['defaults.timezone'] = \getenv('AGENDAV_TIMEZONE');
// Default languajge
$app['defaults.language'] = \getenv('AGENDAV_LANG');
// Default time format. Options: '12' / '24'
$app['defaults.time.format'] = '24';
/*
 * Default date format. Options:
 *
 * - ymd: YYYY-mm-dd
 * - dmy: dd-mm-YYYY
 * - mdy: mm-dd-YYYY
 */
$app['defaults.date.format'] = 'ymd';
// Default first day of week. Options: 0 (Sunday), 1 (Monday)
$app['defaults.weekstart'] = 1;
// Logout redirection. Optional
$app['logout.redirection'] = '';
// Calendar sharing
$app['calendar.sharing'] = \getenv('AGENDAV_CALENDAR_SHARING');
