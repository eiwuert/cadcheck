<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Base URL
 *
 * Returns the "base_url" item from your config file
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('theme_path'))
{
	function theme_path()
	{
		$CI =& get_instance();
		return $CI->config->slash_item('theme_path');
	}
}

if ( ! function_exists('asset_path'))
{
	function asset_path()
	{
		$CI =& get_instance();
		return $CI->config->slash_item('asset_path');
	}
}
