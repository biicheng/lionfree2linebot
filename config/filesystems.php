<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'permissions' => [
                'file' => [
                    'public' => 0664,
                    'private' => 0600,
                ],
                'dir' => [
                    'public' => 0775,
                    'private' => 0700,
                ],
            ],
        ],
        'article' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('../public'),
            'url' => env('APP_URL').'/public',
            'visibility' => 'public',
        ],

        'updateImg' => [
            'driver' => 'local',
            'root' => storage_path('../public'),
            'url' => env('APP_URL').'/public',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            #20220505 add 'cache'=>[]
            'cache' => [
                'store' => 'memcached',
                'expire' => 600,
                'prefix' => 'cache-prefix',
            ],
        ],

        #20220513 add 'ftp'=>[]
        'ftp' => [
            'driver' => 'ftp',
            'host' => env('FTP_HOST'),//'files.000webhost.com',
            'username' => env('FTP_USER'),//'linebotimg',
            'password' => env('FTP_PW'),//'1989@Sweet1219',
         
            // Optional FTP Settings...
            'port' => env('FTP_PORT'),//21,
            'root' => env('FTP_ROOT'),//'/public_html',
            'passive' => false,//true,
            // 'ssl' => true,
            'timeout' => 100,
        ],
        
        #20220513 add 'sftp'=>[]    
        'sftp' => [
            'driver' => 'sftp',
            'host' => 'files.000webhost.com',
            'username' => 'linebotimg',
            'password' => '1989@Sweet1219',
         
            // Settings for SSH key based authentication...
            // 'privateKey' => '/path/to/privateKey',
            // 'password' => 'encryption-password',
         
            // Optional SFTP Settings...
            'port' => 21,
            'root' => '/public_html/img',
            'timeout' => 100,
        ],

    ],

    #20220513 add
    'links' => [
        public_path('storage') => storage_path('app/public'),
        public_path('images') => storage_path('app/images'),
    ],

];
