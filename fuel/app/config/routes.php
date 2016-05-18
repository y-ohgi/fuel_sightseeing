<?php
return array(
	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
    
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),

    '_root_' => 'home/index',

    'guides/(?P<id>\d+)' => 'guides/detail',
    'guides/(?P<id>\d+)/request' => 'guides/request',
    'guides/(?P<id>\d+)/requests' => 'guides/requests',
    
    'guides/(?P<id>\d+)/requests/(?P<req_id>\d+)' => 'guides/requests',
    'guides/(?P<id>\d+)/requests/(?P<req_id>\d+)/delete' => 'guides/requests_delete',
    
);
