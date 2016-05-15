<?php

namespace Fuel\Migrations;

class Rename_field_user_id_to_user_prof_id_in_user_languages
{
	public function up()
	{
		\DBUtil::modify_fields('user_languages', array(
			'user_id' => array('name' => 'user_prof_id', 'type' => 'int', 'constraint' => 11)
		));
	}

	public function down()
	{
	\DBUtil::modify_fields('user_languages', array(
			'user_prof_id' => array('name' => 'user_id', 'type' => 'int', 'constraint' => 11)
		));
	}
}