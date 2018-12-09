<?php require_once('system/PrivateAreas.php');

# Here you should put your code to protect methods and controllers

/**
 * Methods: 
 * PrivateAreas::privateMethods(array());
 * PrivateAreas::privateControllers(array())
*/

# Apenas quem está logado no sistema pode acessar esse Controller
if ( ! Session::getSession('id_usuario')) {
	PrivateAreas::privateControllers(
		array(
			'dashboard',
			'viewData'
	))->redirect('index.index');
}