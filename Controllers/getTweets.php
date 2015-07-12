<?php

namespace Controllers;

use \config\Config as Config;
use \libs\TwitterAPIExchange;
use \libs\Rest as Rest;
/**
 * 
 * Fetch tweets from twitter api
 */

class getTweets {
   
    /**
     * 
     * @param Array $requestParams contains all the request parameters
     */
    
    public function get($requestParams) {
       
        
        $hashTag = empty($requestParams['hash_tag']) ? 'custserv' : $requestParams['hash_tag'];
        $count = empty($requestParams['result']) ? 20 : $requestParams['result'];
        $retweet = empty($requestParams['retweet']) ? 0 : $requestParams['retweet'];
        
        /* Request url and parameters . */
        
        $url = "https://api.twitter.com/1.1/search/tweets.json";
        $requestMethod = "GET";
        $getfield = "?q=#$hashTag&count=$count";
        
        /* Access token for twitter api. */
        
        $settings = array(
            'oauth_access_token' => Config::OAUTH_ACCESS_TOKEN,
            'oauth_access_token_secret' => Config::OAUTH_SECRET,
            'consumer_key' => Config::CONSUMER_KEY,
            'consumer_secret' => Config::CONSUMER_SECRET
        );
       
      
        $twitter = new TwitterAPIExchange($settings);
        
        $tweets = json_decode($twitter->setGetfield($getfield)
                        ->buildOauth($url, $requestMethod)
                        ->performRequest(), $assoc = TRUE);
      
        
        $i = 0;
        foreach ($tweets['statuses'] as  $value) {
            if ($value['retweet_count'] >= $retweet) {
                $Tweets[$i]['retweet_count'] = $value['retweet_count'];
                $Tweets[$i]['text'] = $value['text'];
                $i++;
            }
        }
        
        
        // Send Response
        
        $response = array("status" => "Success", "Tweets" => $Tweets);
        $response = array("Success" => $response);
        Rest::response($response,200);
        
    }
    
    
}