<?php
/*
 *  Template Class
 *  Creates a template/view object and including HTML into PHP
 */
class Template {
	//Path to template
    protected $template;
    //Variables passed in
    protected $vars = array();

    /*
     * Class Constructor
     */
    public function __construct($template){
        $this->template = $template;
    }

    /*
     * Get template variables
     */
    public function __get($key){
        return $this->vars[$key];
    }

    /*
     * Set template variables
     */
    public function __set($key, $value){
        $this->vars[$key] = $value;
    }

    /*
     * Convert Object To String
     */
    public function __toString(){
    	extract($this->vars);
    	chdir(dirname($this->template));
    	ob_start();//Turn on output buffering

    	include basename($this->template); //include the template into our page

    	return ob_get_clean(); //Gets the current buffer contents and delete current output buffer
    }
}
