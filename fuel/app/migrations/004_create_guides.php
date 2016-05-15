<?php

namespace Fuel\Migrations;

class Create_guides
{
	public function up()
	{
		\DBUtil::create_table('guides', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_prof_id' => array('constraint' => 11, 'type' => 'int'),
			'start_datetime' => array('type' => 'datetime'),
			'end_datetime' => array('type' => 'datetime'),
			'desc' => array('type' => 'text'),
			'price' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('guides');
	}
}