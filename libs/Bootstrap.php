<?php

namespace libs;

use \Controllers\getTweets as getTweets;
/**
 * Bootstrap
 * 
 * Route request to controller and it's method
 * 
 */

class Bootstrap {

    public function __construct() {
        Rest::init();
        self::router();
    }
    
    /**
     * Takes care of Routing
     */
    private function router() {
        /* Get all request variables */
                    
        $requestParams = Rest::getRequestParams();
        
       
        $filename = $requestParams['url'];
        
        
        $request = Rest::getRequestMethod();
         
        
        $class = new getTweets();
       
                //$class = new $requestParams['url']();
                
                switch ($request) {
                    case 'GET':
                        $class->get($requestParams);
                        break;
                    case 'POST':
                        $class->post($requestParams);
                    case 'PUT':
                        $class->put($requestParams);
                    case 'DELETE':
                        $class->delete($requestParams);
                    default:
                        throw new \InvalidArgumentException("Method not allowed");
                        break;
                }
            
        }
        

}

?>