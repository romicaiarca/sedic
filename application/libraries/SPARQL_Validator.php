<?php
/**
 * 
 */

class SPARQL_Validator {
    
    public function __construct($params) {
        if(!is_array($params))
        {
            log_message('error', print_r('SPARQL_Validator: Please check input parameter list!'));
        }
        foreach($params as $key => $param)
        {
            $this->$key = $param;
        }
    }
    
    public function validate($query) {
        return $this->send_to_validator($query);
    }
    
    public function send_to_validator($query)
    {
        $fields_string = '';
        //set POST variables
        $fields = array(
                    'languageSyntax' => urlencode('SPARQL'),
                    'outputFormat' => urlencode('sparql'),
                    'query' => urlencode($query),
                );

        //url-ify the data for the POST
        foreach($fields as $key=>$value)
        {
            $fields_string .= $key.'='.$value.'&';
        }
        rtrim($fields_string, '&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $this->endpoint);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //execute post
        $response = curl_exec($ch);
        
        // Get response code
        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($response_code == '400')
        {
            $error_body = trim(preg_replace('/(Error 400:)(.*?)(Fuseki.*)/ims', '$2', $response));
            return $error_body;
        }
        else
        {
            return $response;
        }

        //close connection
        curl_close($ch);
    }
}