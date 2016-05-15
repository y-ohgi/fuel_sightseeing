<?php

class Model_Guide extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_prof_id',
		'start_datetime',
		'end_datetime',
		'desc',
        'place',
		'price',
		'status',
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

	protected static $_table_name = 'guides';
    
    protected static $_has_many = array('guide_requests' => array(
        'model_to' => 'Model_Guide_Request',
        'key_from' => 'id',
        'key_to' => 'guide_id',
    ));

    protected static $_belongs_to = array('user_profiles' => array(
            'key_from' => 'uesr_prof_id',
            'model_to' => 'Model_User_Profile',
            'key_to' => 'id',
    ));

}
