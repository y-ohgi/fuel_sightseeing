<?php
return array(
	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route


    '_root_' => 'home/index',
    
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
