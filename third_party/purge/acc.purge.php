<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once PATH_THIRD.'purge/config.php';

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */
 
// ------------------------------------------------------------------------
 
/**
 * Purge Accessory
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Accessory
 * @author		Kevin Cupp
 * @link		http://kevincupp.com
 */
 
class Purge_acc
{	
	public $name        = PURGE_NAME;
	public $id          = 'purge';
	public $version     = PURGE_VERSION;
	public $description = 'Provides a place to manually send a purge request to Varnish.';
	public $sections    = array();
	
	/**
	 * Set Sections
	 */
	public function set_sections()
	{
		$EE =& get_instance();
		
		$data['request_url'] = html_entity_decode(BASE.AMP.'C=addons_accessories'.AMP.'M=process_request'.AMP.'accessory=purge'.AMP.'method=process_purge_request');
		
		$this->sections['Purge Varnish'] = $EE->load->view('accessory_purge_varnish', $data, TRUE);
	}
	
	/**
	 * Handles AJAX request from control panel accessory to send purge request to Varnish
	 */
	public function process_purge_request()
	{
		if (AJAX_REQUEST)
		{
			
			
			
			$EE =& get_instance();
			$EE->load->helper('varnish');
			$urls = $EE->config->item('varnish_site_url');
  			$port = $EE->config->item('varnish_port');
  		
			if ( ! is_array($urls))
			{
				$urls = array($urls);
			}
			
			$resp = ''; //if using multiple varnish servers, collect responses in here seperated by line break
			
			foreach ($urls as $url)
			{
				if(strlen($resp)>0) $resp .= "\n"; //if already captured other responses put in a line break
				
				if($_POST['purge_url'] != '')
					$_url = preg_replace('/\/$/','',$url).'/'.preg_replace('/^\//','',$_POST['purge_url']); //handle trailing and beginning slashes
				else 
					$_url = $url;
					
				$resp .= send_purge_request($_url, $port); //depending on curl to send varnish's response or an error
							
			}
			
			die($resp); //we die here instead of return to cut of template debugging 
		}
	}
}
 
/* End of file acc.purge.php */
/* Location: /system/expressionengine/third_party/purge/acc.purge.php */
