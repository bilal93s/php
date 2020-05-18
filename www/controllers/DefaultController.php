<?php

namespace www\controllers;

use www\core\View;

class DefaultController{
	public function defaultAction()
	{
		// parameter order -> vues, tpl
		$myView = new View("dashboard");
	}
}