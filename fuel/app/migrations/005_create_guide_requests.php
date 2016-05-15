<?php

namespace Fuel\Migrations;

class Create_guide_requests
{
	public function up()
	{
		\DBUtil::create_table('guide_requests', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'guides_id' => array('constraint' => 11, 'type' => 'int'),
			'user_prof_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('guide_requests');
	}
}