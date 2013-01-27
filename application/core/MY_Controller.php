<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    protected $data = array();
    protected $controller_name;
    protected $action_name;
    protected $current_page = '';
    protected $settings = array();
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Render a layout
     * @param string $template
     * @param string $view_name
     * @param boolean $return_sting
     */
    protected function render($template, $view_name, $return_sting = FALSE)
    {
        $template_path = BASEPATH . '../' . APPPATH . "views/layouts/{$template}.tpl.php";
        $view_path = BASEPATH . '../' . APPPATH . "views/{$view_name}.php";
        if(empty($template) || !file_exists($template_path))
        {
            $error_message = "Incorect or not exist \$template ({$template}.php) file!";
            log_message('error', print_r($error_message, 1));
            show_error($error_message);
        }
        elseif (empty($view_name) || !file_exists($view_path))
        {
            $error_message = "Incorect or not exist \$view_name ({$view_name}.php) file!";
            log_message('error', print_r($error_message, 1));
            show_error($error_message);
        }
        if (empty($this->data['content'])) $this->data['content'] = '';
        
        $this->data['content'] .= $this->load->view($view_name, $this->data, TRUE);
        $this->load->view('layouts/' . $template . '.tpl.php', $this->data);
    }

    /**
     * Add custom JS code from Controller
     * @param string $js_content
     */
    protected function add_custom_js($js_content) {
        if(!empty($js_content))
            $this->data['custom_js'] .= $js_content;
    }

    /**
     * Add custom JS File from Controller
     * @param array $file_path
     */
    protected function add_custom_js_file($file_path) {
        $this->data['arCustomJSfiles'][] = $file_path;
    }

    protected function add_custom_css($css_content) {
        if (!empty($this->data['custom_css'])) {
            $this->data['custom_css'] .= $css_content;
        } else {
            $this->data['custom_css'] = $css_content;
        }
    }

    protected function add_custom_css_file($file_path) {
        $cssFile = array( 'file' => $file_path, );

        $this->data['arCustomCSSfiles'][] = $cssFile;
    }

}
/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
