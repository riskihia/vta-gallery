<?php

class Errors extends Controller {
	
	function index()
	{
		
		$this->error404();

	}
	
	function error404()
	{
		$template = $this->loadView('404');
		$template->render();
	}
    
}

?>
