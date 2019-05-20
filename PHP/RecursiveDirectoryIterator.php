<?php
$path = realpath(__DIR__ . '../..');
$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
foreach($objects as $file){
  // $result[] = dirname(substr($file->__toString(), $prefix_length));
  // var_dump(get_class_methods($file->getPath));

  if ($file->getFilename() != '.' && $file->getFilename() != '..' && $file->isFile() == TRUE){
    echo $file->getFilename() . PHP_EOL;
    echo $file->getPathname() . PHP_EOL;
    echo $file->getPerms() . PHP_EOL;
    // echo $file->getInode() . PHP_EOL;
    echo $file->getSize() . PHP_EOL;
    echo $file->getATime() . PHP_EOL;
    echo $file->getMTime() . PHP_EOL;
    echo $file->getCTime() . PHP_EOL;
    echo $file->getType() . PHP_EOL;
    echo $file->getPathInfo() . PHP_EOL;
    // echo $file->__toString() . PHP_EOL;
    // var_dump(get_class_methods($file));
  }

  // if($file->isDir()){
  //    $result[] = dirname(substr($file->__toString(), $prefix_length));
  // }
}
// echo $path;
// var_dump(get_class_methods($objects));
// var_dump($result);
