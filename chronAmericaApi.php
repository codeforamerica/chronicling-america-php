<?php

class chronAmericaApi extends APIBaseClass{

	public static $api_url = 'http://chroniclingamerica.loc.gov';
	// Modded to do json by default ... even though default output is html, for developers this isn't so helpful	
	public function __construct($url=NULL)
	{
		parent::new_request(($url?$url:self::$api_url));
	}
	
	public function title_search($terms,$page=NULL,$format='json'){
	// also supports json and atom defaults to HTML
		$params =array('terms','page','format');
		// can't use array_combine because if arrays are inequal it returns false
		foreach(func_get_args() as $loc => $arg)
			$data[$params[$loc]] = $arg;
		return self::_request(self::$api_url."/search/titles/results", 'get', array_filter($data));
	}
	
	public function page_search($andtext,$page=NULL,$format='json'){
		$params =array('andtext','page','format');
		foreach(func_get_args() as $loc => $arg)
			$data[$params[$loc]] = $arg;
		return self::_request(self::$api_url."/search/pages/results", 'get', array_filter($data));
	}
	
	public function suggest_titles($q){
	// experimental should auto return JSON
		return self::_request(self::$api_url."/suggest/titles/", 'get', array('q'=>$q));
	}
}