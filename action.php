<?php
/**
 * adultcontent plugin
 * 
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     S.C. yoo <dryoo@live.com>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');

class action_plugin_adultcontent extends DokuWiki_Action_Plugin {

	var $functions = null;

	function register(&$controller) 
	{
		$controller->register_hook('IO_WIKIPAGE_WRITE', 'BEFORE', $this, 'adultcontent__check');
	}

	function adultcontent__check(&$event, $args) {

        global $ID;
        
		$adult = p_get_metadata($ID, "adult");
		if ($adult == null) $adult=false;
        $regex=$this->getConf('keywords');
    
        echo "<script>alert(\"$regex\");</script>";
		if (preg_match("/$regex/si",$event->data[0][1]))
		{
			$adult=true;
		} else
		{
			$adult=false;
		}
		p_set_metadata($ID, array('adult' => $adult));
		return ;
	}
}