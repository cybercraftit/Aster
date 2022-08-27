<?php
$modules = Module::all();

foreach ( glob(dirname(__FILE__) . '/*.php' ) as $filename) {
    if ( realpath( $filename ) !== __FILE__ ) include $filename;
}

//get all modules' system files
foreach ( $modules as $module => $module_data ) {
    if ( file_exists( $module_data->getPath() . '/System/' ) ) {
        foreach( glob($module_data->getPath() . '/System/*.php') as $file ) {
            include_once $file;
        }
    }
}

