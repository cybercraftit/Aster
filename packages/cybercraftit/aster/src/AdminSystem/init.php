<?php

//get all modules' admin system files
$modules = glob( __DIR__ . '/../Modules/*' );
foreach ( $modules as $k => $module_path ) {
    if ( file_exists( $module_path . '/AdminSystem/' ) ) {
        foreach( glob($module_path . '/AdminSystem/*.php') as $file ) {
            include_once $file;
        }
    }
}

