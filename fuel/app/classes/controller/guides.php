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
     * [GET] /guides
     */
	public function get_index()
	{
        // TODO: 現在時刻以降のものを取得 時間順に並べる
        // TODO: viewの整形
        // TODO: GETによる ソート
        
        //var_dump(Model_User_Profile::find("all", array('related' => array('user_languages'))));exit(1111);
        $guides = Model_Guide::find("all", array('related' => array('user_profiles')));
        $data["guides"] = $guides;
        
		$this->template->title = '案内者一覧';
		$this->template->content = View::forge('guides/index', $data);
	}

    /***
     * 案内者登録画面
     *
     * [GET] /guides/register
     */
	public function get_register()
	{
        
        
		$this->template->title = '案内者登録';
		$this->template->content = View::forge('guides/register');
	}

    /***
     * 案内者登録処理
     *
     * [POST] /guides/register
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
     *
     * [GET] /guides/:id
     */
	public function get_detail()
	{
        // TODO: viewの整形

        $guideid = (int)$this->param('id');
        $guide = Model_Guide::find($guideid, array('related' => array('user_profiles')));
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
     *
     * [GET] /guides/:id/request
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


    /***
     * 対象ガイドへのリクエスト一覧
     *
     * [GET] /guides/:id/requests
     * request と requests で近すぎる?
     */
	public function get_requests()
	{
        // TODO: requestの承認
        if(!Auth::check()){
            Session::set_flash('error', 'get_requests');
            Response::redirect('/');
        }
        
        $guide_requests = [];
        $userprofid = Model_User_Profile::get_id_by_auth();
        $guideid = (int)$this->param('id');

        // 案内申し込み一覧
        $guide_requests = Model_Guide_Request::find_by('guides_id', $guideid);
        $guide_requests = Model_Guide_Request::find('all', array(
            'where' => array(
                'guides_id' => $guideid,
            ),
            'related' => array('user_profiles')
        ));
        
		$data['guide_requests'] = $guide_requests;
        
		$this->template->title = '承認待ちユーザー 一覧';
		$this->template->content = View::forge('guides/requests', $data);
	}

    /***
     * リクエスト承認
     *
     * [POST] /guides/:id/requests/:id
     */
	public function post_requests(){
        $guideid = (int)$this->param('id');
        $reqid = (int)$this->param('req_id');

        Session::set_flash('success', '登録完了！');
        Response::redirect('guides/board');
    }

    /***
     * リクエスト破棄
     *
     * [POST] /guides/:id/requests/:id/delete
     */
    public function post_requests_delete(){
        
        
        Session::set_flash('success', '削除しました');
        Response::redirect_back('/');
    }
        

    /***
     * 案内者と観光者の 1:1 掲示板
     *
     * [GET] /guides/:id/board
     * 案内者と 承認された観光者のみの掲示板
     * 違うURL/Controllerでやったほうがいい？
     */
	public function action_board()
	{
        // TODO: 掲示板を作る
        
		$data["subnav"] = array('board'=> 'active' );
		$this->template->title = '掲示板';
		$this->template->content = View::forge('guides/board', $data);
	}

}
