<?php

//get all modules' system files
$modules = glob( __DIR__ . '/../Modules/*' );
foreach ( $modules as $k => $module_path ) {
    if ( file_exists( $module_path . '/System/' ) ) {
        foreach( glob($module_path . '/System/*.php') as $file ) {
            include_once $file;
        }
    }
}
