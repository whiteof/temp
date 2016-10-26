<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver; 
 
return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => PDOMySqlDriver::class,
                'params' => [
                    'host'     => 'its-yrkmysqlt01.med.cornell.edu',                    
                    'user'     => 'itsapi_app_dev',
                    'password' => 'jhh37hysFjDSX',
                    'dbname'   => 'itsapi_dev',
                ]
            ],            
        ],        
    ],
];
