<?php

//get module includes
$modules = glob( __DIR__ . '/../Modules/*' );
foreach ( $modules as $k => $module_path ) {
    if ( file_exists( $module_path . '/Includes/' ) ) {
        foreach( glob($module_path . '/Includes/*.php') as $file ) {
            include_once $file;
        }
    }
}
