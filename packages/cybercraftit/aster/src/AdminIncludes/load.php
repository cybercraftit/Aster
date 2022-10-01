<?php

//get module admin includes
$modules = glob( __DIR__ . '/../Modules/*' );
foreach ( $modules as $k => $module_path ) {
    if ( file_exists( $module_path . '/AdminIncludes/' ) ) {
        foreach( glob($module_path . '/AdminIncludes/*.php') as $file ) {
            include_once $file;
        }
    }
}
