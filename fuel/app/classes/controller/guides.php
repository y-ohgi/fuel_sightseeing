<?php

class Controller_Guides extends Controller_Template
{
    public function before(){
        parent::before();

        // TODO: 認証チェック
    }

    /***
     * 案内者一覧
     *
     * GETで使用可能な言語でソート
     */
	public function get_index()
	{

        //var_dump(Model_User_Profile::find("all", array('related' => array('user_languages'))));exit(1111);
        $guides = Model_Guide::find("all");
        $data["guides"] = $guides;
        
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
        // TODO: 複数のガイド、もしくは同じ時間帯にガイドを作っていないかの判定
        if(!Auth::check()){Response::redirect('auth/signin');}
        list(,$userid) = Auth::get_user_id();
        
        $userprof = Model_User_Profile::find_by('user_id', $userid);
        $userprofid = array_shift($userprof)->id;
        
        $guide = new Model_Guide(array(
            "user_prof_id" => $userprofid,
            "start_datetime" => Input::post("start_datetime", date("Y-m-d H:i:s")),
            'end_datetime' => Input::post("end_datetime", date("Y-m-d H:i:s", strtotime('+0.5 day')) ),
            'desc' => Input::post("desc", ""),
            'price' => Input::post("price", 500),
            'place' => Input::post("place", "東京都"),
            'status' => "wait",

        ));
        $guide->save();
        $guideid = $guide->id;
        
        Session::set_flash('success', '案内作成完了！');
        Response::redirect('guides/'.$guideid);
        
		/* $this->template->title = '案内者登録'; */
		/* $this->template->content = View::forge('guides/'.$guideid.'/detail'); */
	}

    /***
     * 各ガイドの詳細
     */
	public function get_detail()
	{
        $guideid = (int)$this->param('id');
        $guide = Model_Guide::find($guideid);
        $reqflg = false; // 観光案内リクエストフラグ
        list(, $userid) = Auth::get_user_id();

        if(Auth::check()){
            $guide_userprofid = $guide->user_prof_id;
            $userprofid = Model_User_Profile::get_id_by_auth();
            // 自分で自分のガイドへは リクエストは送らせない 
            if($guide_userprofid != $userprofid){
                $reqflg = true;
            }
        } 
        
        $data['reqflg'] = $reqflg;
        $data['guide'] = $guide;
		$this->template->title = 'ガイド詳細';
		$this->template->content = View::forge('guides/detail',  $data);
	}

    /***
     * ガイドへ申し込み
     */
	public function post_request(){
        if(!Auth::check()){
            Session::set_flash('error', 'post_request');
            Response::redirect('/');
        }
        
        $guideid = (int)$this->param('id');
        
        $guide_request = new Model_Guide_Request(array(
            'guides_id' => $guideid,
            'user_prof_id' => Model_User_Profile::get_id_by_auth()
        ));
        $guide_request->save();

        $data['id'] = $guide_request->id;
        Session::set_flash('success', 'リクエストの発行に成功！');
        
		$this->template->title = '案内申し込み';
		$this->template->content = View::forge('guides/request', $data);
    }

        
	public function get_requests()
	{
        if(!Auth::check()){
            Session::set_flash('error', 'get_requests');
            Response::redirect('/');
        }
        
        $guide_requests = [];
        $userprofid = Model_User_Profile::get_id_by_auth();
        $guideid = (int)$this->param('id');

        $guide_requests = Model_Guide_Request::find($guideid);
        
		$data['guide_requests'] = $guide_requests;
        
		$this->template->title = '承認待ちユーザー 一覧';
		$this->template->content = View::forge('guides/requests', $data);
	}

	public function action_board()
	{
		$data["subnav"] = array('board'=> 'active' );
		$this->template->title = 'Guides &raquo; Board';
		$this->template->content = View::forge('guides/board', $data);
	}

}
