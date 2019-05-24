<?php

/*

Plugin Name: STB custom Functions
Plugin URI: https://pods.io/
Description: Aggregate All STB custom Functions here
Version: 1.0.0
Author: STB Development Team
Author URI: https://www.stb.gov

*/
foreach (glob(__DIR__.'/src/*.php') as $filename)
{
    include_once $filename;
}
