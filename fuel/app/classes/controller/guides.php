<?php

class Controller_Guides extends Controller_Template
{

    /***
     * 案内者一覧
     *
     * GETで使用可能な言語でソート
     */
	public function get_index()
	{

        //var_dump(Model_User_Profile::find("all", array('related' => array('user_languages'))));exit(1111);
        // $guides = Model_Guides::find("all");
        $data["guides"] = [];
        
		$this->template->title = '案内者一覧';
		$this->template->content = View::forge('guides/index', $data);
	}

    /***
     * 案内者登録画面
     */
	public function get_register()
	{
        
        
		$this->template->title = '案内者登録';
		$this->template->content = View::forge('guides/register');
	}

    /***
     * 案内者登録処理
     */
	public function post_register()
	{
        /*
Input::post("start_datetime");
Input::post("end_datetime");
Input::post("place");
Input::post("desc");
Input::post("price");
         */
        list(,$userid) = Auth::get_user_id();
        
        $userprof = Model_User_Profile::find_by('user_id', $userid);
        $userprofid = array_shift($userprof)->id;
        
        $guide = new Model_Guide(array(
            "user_prof_id" => $userprofid,
            "start_datetime" => Input::post("start_datetime", date("Y-m-d H:i:s")),
            'end_datetime' => Input::post("end_datetime", date("Y-m-d H:i:s", strtotime('+0.5 day'))),
            'desc' => Input::post("desc", ""),
            'price' => Input::post("price", 500),
            'place' => Input::post("place", "東京都"),
            'status' => "wait",

        ));
        $guide->save();

        exit(1111);
        
        
		$this->template->title = '案内者登録';
		$this->template->content = View::forge('guides/register_completed');
	}

	public function action_detail()
	{
		$data["subnav"] = array('detail'=> 'active' );
		$this->template->title = 'Guides &raquo; Detail';
		$this->template->content = View::forge('guides/detail', $data);
	}

	public function action_request()
	{
		$data["subnav"] = array('request'=> 'active' );
		$this->template->title = 'Guides &raquo; Request';
		$this->template->content = View::forge('guides/request', $data);
	}

	public function action_requests()
	{
		$data["subnav"] = array('requests'=> 'active' );
		$this->template->title = 'Guides &raquo; Requests';
		$this->template->content = View::forge('guides/requests', $data);
	}

	public function action_board()
	{
		$data["subnav"] = array('board'=> 'active' );
		$this->template->title = 'Guides &raquo; Board';
		$this->template->content = View::forge('guides/board', $data);
	}

}
