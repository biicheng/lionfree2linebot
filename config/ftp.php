<?php
return array(

    /*
	|--------------------------------------------------------------------------
	| Default FTP Connection Name
	|--------------------------------------------------------------------------
	|
	| Here you may specify which of the FTP connections below you wish
	| to use as your default connection for all ftp work.
	|
	*/

    'default' => 'connection',

    /*
    |--------------------------------------------------------------------------
    | FTP Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the FTP connections setup for your application.
    |
    */

    'connection' => array(
        'host'   => 'files.000webhost.com',
        'port'  => 21,
        'username' => 'linebotimg',
        'password' => '1989@Sweet1219',
        'passive'   => false,
        'secure' => false,
        'root' => 'public_html',

        // '000webhost' => array(
        //     'host'   => 'files.000webhost.com',
        //     'port'  => 21,
        //     'username' => 'linebotimg',
        //     'password' => '1989@Sweet1219',
        //     'passive'   => false,
        //     'secure' => false,
        //     'root' => 'public_html',
        // ),
    ),
);