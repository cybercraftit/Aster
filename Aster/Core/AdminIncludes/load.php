<?php
$modules = Module::all();

foreach ( glob(dirname(__FILE__) . '/*.php' ) as $filename) {
    if ( realpath( $filename ) !== __FILE__ ) include $filename;
}

//get module includes
foreach ( $modules as $module => $module_data ) {
    if ( file_exists( $module_data->getPath() . '/AdminIncludes/' ) ) {
        foreach( glob($module_data->getPath() . '/AdminIncludes/*.php') as $file ) {
            include_once $file;
        }
    }
}
