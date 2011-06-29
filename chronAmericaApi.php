<?php

class chronAmericaApi extends APIBaseClass{

	public static $api_url = 'http://chroniclingamerica.loc.gov';
	// Modded to do json by default ... even though default output is html, for developers this isn't so helpful	
	public function __construct($url=NULL)
	{
		parent::new_request(($url?$url:self::$api_url));
	}
	
	private function filter_params($params,$args){
	// abstracts the method calls to turn most method arguments into query parameters, provided an array with
	// the names of the keys in (data) correspondence to the method call order
		foreach($args as $loc => $arg)
			$data[$params[$loc]] = $arg;
		return $data;	
	}
	
	public function title_search($terms,$format='json',$page=NULL){
	// also supports json and atom defaults to HTML
		// can't use array_combine because if arrays are inequal it returns false
		$data = self::filter_params(array('terms','format','page'),func_get_args() );

		return self::_request("/search/titles/results", 'GET', array_filter($data));
	}
	
	public function page_search($andtext,$format='json',$page=NULL){
		$data = self::filter_params(array('terms','page','format'),func_get_args() );
		return self::_request("/search/titles/results", 'get', array_filter($data));
	}
	
	public function suggest_titles($q){
	// experimental should auto return JSON
		return self::_request("/suggest/titles/", 'get', array('q'=>$q));
	}
}