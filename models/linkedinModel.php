<?php

class LinkedinModel extends Model {
    
    private $_accessToken;

    public function __construct($accessToken) {
        parent::__construct();
        $this->_accessToken = $accessToken; 
    }
    
    public function fetch($method, $resource, $body='') {
        $params = array('oauth2_access_token' => $this->_accessToken, 'format' => 'json');
        // Need to use HTTPS
        $url = 'https://api.linkedin.com'.$resource.'?'.http_build_query($params);
        // Tell streams to make a (GET, POST, PUT, or DELETE) request
        $context = stream_context_create(array('http' => array('method' => $method)));
        $response = file_get_contents($url, false, $context);
        return json_decode($response);
    }
    
    public function getCurrentUser($fullProfile=false) {
        if ($fullProfile) {
            $fields = array(
                "id", 
                "first-name", 
                "last-name", 
                "location", 
                "industry", 
                "num-connections", 
                "positions", 
                "picture-url", 
                "email-address", 
                "interests", 
                //"languages", 
                //"skills", 
                //"three-current-positions", 
                //"three-past-positions", 
                //"num-recommenders", 
                //"recommendations-received", 
            );
            $user = $this->fetch('GET', '/v1/people/~:('.implode(",", $fields).')');
        } else {
            $user = $this->fetch('GET', '/v1/people/~:(id,first-name,last-name,location)');
        }
        print_r($user);
        return $user;
    }
    
    public function getConnection($id) {
        $connection = $this->fetch('GET', '/v1/people/id='.$id.":(first-name,last-name,location,interests)");
        print_r($connection);
        return $connection;
    }
    
    public function getCurrentUserConnections() {
        $connections = $this->fetch('GET', '/v1/people/~/connections');
        print_r($connections);
        return $connections->values;
    }
    
}

?>
