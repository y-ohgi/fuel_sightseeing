<?php

namespace Fuel\Migrations;

class Add_place_to_guides
{
	public function up()
	{
		\DBUtil::add_fields('guides', array(
			'place' => array('constraint' => 255, 'type' => 'varchar'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('guides', array(
			'place'

		));
	}
}