<?php
/**
 * Base Controller class for rendering views
 */
abstract class Controller {
	/**
	 * list of javascript files to include
	 * @var array 
	 */
	protected $_js = array();
	
	/**
	 * list of css files to include
	 * @var array 
	 */
	protected $_css = array();
	
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
	
	public function renderChild($template, $model) {
		include(VIEWS . $template);
	}
	
	public function addJS($file){
		$this->_js[]=$file;
	}
	
	public function addCSS($file) {
		$this->_css[]=$file;
	}
}
