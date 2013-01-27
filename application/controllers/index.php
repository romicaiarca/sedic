<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $this->render('base_layout', 'layouts/content_base_layout');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */