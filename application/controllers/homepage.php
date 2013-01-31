<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//TODO fixes sparql_connection on line 446
require_once APPPATH . 'libraries/sparql_connection.php';

class Homepage extends MY_Controller {
    private $query, $db, $endpoint;
    public function __construct() {
        parent::__construct();
        
        $this->query = 'PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
                        PREFIX owl: <http://www.w3.org/2002/07/owl#>
                        PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
                        PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
                        PREFIX sedic: <http://www.semanticweb.org/sedic#>';
        $this->endpoint = 'http://localhost:3030/ds/query';
    }
    
    public function index()
    {
        $this->render('base_layout', 'layouts/content_base_layout');
    }
    
    public function ax_plants()
    {
        $result = array();
        $query = ' SELECT DISTINCT ?plants WHERE { ?plants rdf:type sedic:Plante . }';
        $data = $this->_query($query, 'plants');
        $output = $this->load->view('tabs/list', array('list_type' => 'plants', 'items' => $data), true);
        echo $output;
    }
    
    public function ax_disease()
    {
        $result = array();
        
        $query = ' SELECT ?disease WHERE { { ?disease rdf:type sedic:Afectiune . } UNION { ?disease rdf:type sedic:Simptoma . } }';
        $data = $this->_query($query, 'disease');
        
        $output = $this->load->view('tabs/list', array('list_type' => 'disease', 'items' => $data), TRUE);
        echo $output;
    }
    
    public function search()
    {
        $data = array();
        $search_term = url_title($this->input->get('term', TRUE), '_');
        $query_plants = "SELECT DISTINCT ?plants WHERE { ?plants rdf:type sedic:Plante FILTER ( REGEX (STR (?plants ), '{$search_term}', 'i' ) ) }";
        $query_disease = "SELECT DISTINCT ?disease WHERE { { ?disease rdf:type sedic:Afectiune . } UNION { ?disease rdf:type sedic:Simptoma . } FILTER ( REGEX (STR (?disease ), '{$search_term}', 'i' ) ) }";
        $data_disease = $this->_query($query_plants, 'plants');
        foreach($data_disease as $data_item)
        {
            $data[] = array('label' => $data_item, 'category' => 'Plante');
        }
        $data_disease = $this->_query($query_disease, 'disease');
        foreach($data_disease as $data_item)
        {
            $data[] = array('label' => $data_item, 'category' => 'Afectiuni');
        }
        echo json_encode($data);
        exit;
    }
    
    private function _query($query, $field = FALSE) {
        $this->db = sparql_connect($this->endpoint);
        if( !$this->db )
        {
            $error = $this->db->errno() . ": " . $this->db->error();
            log_message('error', print_r($error, 1));
            $this->load->view('layouts/error_message', Array('message' => 'Database connaction problem!'));
            exit;
        }
        sparql_ns('sedic', 'http://www.semanticweb.org/sedic#');
        
        $result = $this->db->query( $this->query . ' ' . $query );
        return ($field !== FALSE) ? prepare_result($result, $field) : $result;
    } 
    
    public function get_details()
    {
        $where_search = strtolower(trim($this->input->get('where_search', TRUE)));
        $term = url_title(ucfirst(strtolower(trim($this->input->get('term', TRUE)))), "_");
        if(empty($term))
        {
            $response = array('success' => FALSE, 'message' => 'No input recived!');
            $this->load->view('layouts/error_message', Array());
            exit;
        }
        if (in_array($where_search, array('plante', 'plants')))
        {
            $data = $this->_search_for_plants($term);
        }
        else if (in_array($where_search, array('afectiuni', 'disease')))
        {
            $data = $this->_search_for_disease($term);
        }
        if (!empty($data))
        {
            if (in_array($where_search, array('plante', 'plants')))
                $this->load->view('layouts/plants_search_result', array('data' => $data));
            else if (in_array($where_search, array('afectiuni', 'disease')))
                $this->load->view('layouts/disease_search_result', array('data' => $data));
            else
                $this->load->view('layouts/error_message', Array());
        }
        else
        {
            $this->load->view('layouts/error_message', Array());
        }
    }
    
    private function _search_for_disease($term)
    {
        $query = "SELECT DISTINCT ?disease WHERE { { ?disease sedic:trateaza sedic:{$term} . } UNION { sedic:{$term}  sedic:esteTratataDe ?disease . } UNION { sedic:{$term} sedic:areSimptoma ?value . } UNION { ?value sedic:esteSimptomaPentru sedic:{$term} . }  { SELECT *  WHERE { { ?disease sedic:trateaza ?value . } UNION { ?value sedic:esteTratataDe ?disease . } } } } ";
        $results = $this->_query($this->query . $query);
        log_message('error', print_r($results, 1));
        $data = array();
        $data['se_trateaza'] = prepare_result($results, 'disease');
        //get simptoms
        $query = "SELECT DISTINCT ?disease WHERE { { sedic:{$term} sedic:areSimptoma ?disease. } UNION { ?disease sedic:esteSimptomaPentru sedic:{$term} . } }";
        $results = $this->_query($this->query . $query);
        $data['termen_cautat'] = $term;
        $data['are_simptome'] = prepare_result($results, 'disease');
        return $data;
    }
    
    private function _search_for_plants($term)
    {
        $query = "SELECT DISTINCT * WHERE { sedic:{$term} rdf:type sedic:Plante . sedic:{$term} sedic:denumirePopulara ?denumire_populara . sedic:{$term} sedic:denumireStiintifica ?denumire_stiintifica . sedic:{$term} sedic:modPreparare ?mod_preparare . sedic:{$term} sedic:urlImagine ?url_imagine }";
        $results = $this->_query($query);
        $data = array();
        while ( $row = $results->fetch_array() )
        {
            foreach($row as $key => $value) {
                if(strpos($key, '.type') === FALSE && strpos($key, '.datatype') === FALSE)
                {
                    $data[$key] = $value;
                }
            }
        }
        $data['termen_cautat'] = trim($this->input->get('term', TRUE));
        if (!empty($data)) {
            $query_trateaza = 'SELECT DISTINCT ?afectiuni WHERE { { sedic:Menta sedic:trateaza ?afectiuni . } UNION { ?afectiuni sedic:esteTratataDe sedic:Menta } } ORDER BY ?afectiuni';
            $result_trateaza = $this->_query($query_trateaza);
            $data['afectiuni_tratate'] = prepare_result($result_trateaza, 'afectiuni');
        }
        return $data;
    }
    
    public function about()
    {
        $data['content'] = $this->load->view('layouts/about', TRUE, TRUE);
        $this->load->view('layouts/template_static_pages', $data);
    }
    public function contact() {
        $data['content'] = $this->load->view('layouts/contact', TRUE, TRUE);
        $this->load->view('layouts/template_static_pages', $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */