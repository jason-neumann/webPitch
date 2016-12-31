<?php
/**
 * Base Controller class for rendering views
 */
abstract class Controller {
	/**
	 * list of javascript files to include
	 * @var array 
	 */
	private $_js = array();
	
	/**
	 * list of css files to include
	 * @var array 
	 */
	private $_css = array();
	
	/**
	 * the main
	 * @var string 
	 */
	protected $_view = '';
	
	public function render() {
		include(VIEWS . 'header.phtml');
		include($this->_view);
		include(VIEWS . 'footer.phtml');
	}
	
	public function addJS($file){
		$this->_js[]=$file;
	}
}
