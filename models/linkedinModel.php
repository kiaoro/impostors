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
    
    public function getCurrentUser() {
        $user  = $this->fetch('GET', '/v1/people/~:(id,firstName,lastName)');
        if (!empty($user)) {
            //$view->set('name', $user->firstName." ".$user->lastName);
            //$view->set('link', $user->publicProfileUrl);
            //$view->set('numConnections', $user->numConnections);
            //$view->set('headline', $user->headline);
            //$picture = $this->fetch('GET', '/v1/people/'.$this->postData['linkedin_id'].'/picture-urls::(original)');
            //$view->set('pictureUrl', (!empty($picture->values[0]) ? $picture->values[0] : $user->pictureUrl));
        } 
        return $user;
    }
    
}

?>
