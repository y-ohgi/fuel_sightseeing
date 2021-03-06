<?php

class Model_Guide_Request extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'guides_id',
		'user_prof_id',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'guide_requests';
    
    protected static $_belongs_to = array(
        'user_profiles' => array(
            'key_from' => 'user_prof_id',
            'model_to' => 'Model_User_Profile',
            'key_to' => 'id',
        )
    );

}
