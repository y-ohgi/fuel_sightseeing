<?php

class Model_User_Profile extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'name',
		'gender',
		'country',
		'gender',
		'pr',
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

	protected static $_table_name = 'user_profiles';

    protected static $_has_many = array('user_languages' => array(
        'model_to' => 'Model_User_Language',
        'key_from' => 'id',
        'key_to' => 'user_prof_id',
    ));


    /***
     * ログイン中ユーザーのuser_profiles idを取得
     */
    public static function get_id_by_auth(){
        if(!Auth::check()) {
            return false;
        }

        list(, $userid) = Auth::get_user_id();

        $profid = Model_User_Profile::find_by_user_id($userid);
        
        return $profid->id;;
        
    }
}
