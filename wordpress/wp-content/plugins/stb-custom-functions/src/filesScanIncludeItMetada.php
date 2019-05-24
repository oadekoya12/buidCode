<?php
$filesdir = __DIR__. '/../../../uploads/files';

// $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($filesdir), RecursiveIteratorIterator::SELF_FIRST);
// foreach($objects as $file){
//   if ($file->getFilename() != '.' && $file->getFilename() != '..' && $file->isFile() == TRUE){
    // echo $file->getFilename() . PHP_EOL;
    // echo $file->getPathname() . PHP_EOL;
    // echo $file->getPerms() . PHP_EOL;
    // echo $file->getInode() . PHP_EOL;
    // echo $file->getSize() . PHP_EOL;
    // echo $file->getATime() . PHP_EOL;
    // echo $file->getMTime() . PHP_EOL;
    // echo $file->getCTime() . PHP_EOL;
    // echo $file->getType() . PHP_EOL;
    // echo $file->getPathInfo() . PHP_EOL;
    // echo $file->__toString() . PHP_EOL;
    // var_dump(get_class_methods($file));
//   }
// }

$wpincludedir =  __DIR__. '/../../../../wp-includes';
// shell_exec( 'ls -a ' . $wpincludedir );
if(is_dir($wpincludedir)){
  // echo 'is a directory';
  // include_once $wpincludedir . '/load.php';
  // include_once $wpincludedir . '/functions.php';
}
// $ABSPATH = global ABSPATH
// $WPINC = global WPINC;
// echo global $ABSPATH . $WPINC . '/load.php';
// echo $ABSPATH . $WPINC . '/functions.php';
//D:\www\www\wordpress_stage\wwwroot\wordpress/wp-includes/load.php
//D:\www\www\wordpress_stage\wwwroot\wordpress/wp-includes/functions.php
