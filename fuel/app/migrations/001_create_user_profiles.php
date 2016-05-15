<?php

namespace Fuel\Migrations;

class Create_user_profiles
{
	public function up()
	{
		\DBUtil::create_table('user_profiles', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'gender' => array('constraint' => 255, 'type' => 'varchar'),
			'country' => array('constraint' => 255, 'type' => 'varchar'),
			'gender' => array('constraint' => 11, 'type' => 'int'),
			'pr' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('user_profiles');
	}
}