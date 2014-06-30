<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Base URL
 *
 * Returns the "base_url" item from your config file
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('print_array'))
{
	function print_array($array)
	{   
                echo "<div style='margin:24px; font-size:12px;  border:1px solid red; padding:24px;'>";
		echo "<pre>";
                print_r($array);
                echo "</pre>";
                echo "</div>";
	}
}

if ( ! function_exists('dump'))
{
	function dump($var)
	{   
                echo "<div style='margin:24px; font-size:12px; border:1px solid red; padding:24px;'>";
		echo "<pre>";
                echo $var;
                echo "</pre>";
                echo "</div>";
	}
}