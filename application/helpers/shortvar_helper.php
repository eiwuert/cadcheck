<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Base URL
 *
 * Returns the "base_url" item from your config file
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('sitetitle'))
{
	function sitetitle()
	{
		$CI =& get_instance();
                echo $CI->config->item('title','site');
	}
}
if ( ! function_exists('sitesubtitle'))
{
	function sitesubtitle()
	{
		$CI =& get_instance();
                echo $CI->config->item('sub_title','site');
	}
}

if ( ! function_exists('isadmin'))
{
	function isadmin()
	{
		$CI =& get_instance();
                if($CI->session->userdata('permission')=='admin') {
                    return true;
                } else {
                    return false;
                }
	}
}

if ( ! function_exists('issystem'))
{
	function issystem()
	{
		$CI =& get_instance();
                if($CI->session->userdata('permission')=='system') {
                    return true;
                } else {
                    return false;
                }
	}
}
if ( ! function_exists('menusegment'))
{
	function menusegment()
	{
		$CI =& get_instance();
		return $CI->uri->segment(1);
	}
}

if ( ! function_exists('menusubsegment'))
{
	function menusubsegment()
	{
		$CI =& get_instance();
		return $CI->uri->segment(2);
	}
}


if ( ! function_exists('timetodate'))
{
        function timetodate($timestamp)
        {
                if($timestamp=='') {
                    return '';
                } else {
                    return date('m-d-y H:i:s',$timestamp);
                }
        }
}

if ( ! function_exists('timetoextdate'))
{
        function timetoextdate($timestamp)
        {
                if($timestamp=='') {
                    return '';
                } else {
                    return date('m-d-y H:i:s',$timestamp);
                }
        }
}

if ( ! function_exists('get_role_title'))
{
        function get_role_title($role)
        {
                
                switch($role) {
                    
                    
                    case 'user':
                        return 'User';
                        break;
                    case 'system':
                        return 'System Manager';
                        break;
                    case 'admin':
                        return 'Super Admin';
                        break;
                    default:
                        return 'Undefined';
                        break;
                    
                }
            
                return $string;
                
        }
}

if ( ! function_exists('txstatustostring'))
{
        function txstatustostring($status)
        {
                
                switch($status) {
                    
                    
                    case 0:
                        $string['name'] = 'Pending';
                        $string['color'] = 'red';
                        break;
                    case 1:
                        $string['name'] = 'Sent';
                        $string['color'] = 'orange';
                        break;
                    case 2:
                        $string['name'] = 'Settled';
                        $string['color'] = 'green';
                        break;
                    case 3:
                        $string['name'] = 'Failed';
                        $string['color'] = 'red';
                        break;
                    case 4:
                        $string['name'] = 'Returned';
                        $string['color'] = 'red';
                        break;
                    default:
                        $string['name'] = 'N/A';
                        $string['color'] = 'black';
                        break;
                    
                }
            
                return $string;
                
        }
}


if ( ! function_exists('batchstatustostring'))
{
        function batchstatustostring($status)
        {
                
                switch($status) {
                    
                    case 0:
                        $string['name'] = 'Not submitted';
                        $string['color'] = 'red';
                        break;
                    case 1:
                        $string['name'] = 'Submitted';
                        $string['color'] = 'orange';
                        break;
                    case 2:
                        $string['name'] = 'Settled';
                        $string['color'] = 'green';
                        break;
                    default:
                        $string['name'] = 'N/A';
                        $string['color'] = 'black';
                        break;
                    
                }
            
                return $string;
                
        }
}

if ( ! function_exists('report_downloads'))
{
	function report_downloads()
	{
		$CI =& get_instance();
                return $CI->Report_model->get_unviewed_downloads();
	}
}