<?php

class Controller_Auth extends Controller_Template
{
    public function before()
    {
        parent::before();
        
        //postメソッドの場合 csrfトークンが無いものは全て弾く
        if(Input::method() === "POST" && !Security::check_token()){
            Session::set_flash("error", "ページの期限切れか不正なアクセス");
            //Response::redirect_back("/");
        }

        // Authが無いと入れないページの設定
        //        if()
        
        
    }

    /***
     * ユーザー登録画面
     */
	public function get_signup()
	{
        
		$this->template->title = 'サインアップ';
		$this->template->content = View::forge('auth/signup');
	}

    /***
     * ユーザー登録処理
     */
    public function post_signup()
    {
        $username = Input::post('username');
        $password = Input::post('password');
        $email = Input::post('email');

        try{
            $user = Auth::create_user($username, $password, $email);
        
        }catch(Exception $e){
            Session::set_flash('error', $e->getMessage());
            Response::redirect('auth/signup');
        }
        
        if($user === false){
            Session::set_flash('error', 'ユーザー登録に失敗。そのうちvalidate作る');
            Response::redirect('auth/signup');
        }else{
            // メール認証作ってないのでここでログインさせちゃう、本来なら get_signup_profile() のつもり
            Auth::login($username, $password);
            Response::redirect('auth/signup_mail');
        }
    }

    /***
     * メール送信、メール確認メッセージ表示画面
     */
	public function get_signup_mail()
	{
        // ハッシュの生成
        // メールの送信
		$this->template->title = 'メール確認';
		$this->template->content = View::forge('auth/signup_mail');
	}

    /***
     * ユーザープロフィールの入力画面
     */
	public function get_signup_profile()
	{
        // ログインして無ければサインインに飛ばす
        // TODO:: beforeへ分けるか何かする
        if(Auth::check() === false){
            Session::set_flash("error", "色々未実装。ログイン後 auth/signup_profile へ自ら行ってください");
            Response::redirect("auth/signin");
        }
        
		$this->template->title = 'ユーザープロフィール登録';
		$this->template->content = View::forge('auth/signup_profile');
	}


    /***
     * ユーザープロフィールの登録処理
     */    
    public function post_signup_profile()
    {
        //var_dump(Input::post());exit(11);
        
        // ログインして無ければサインインに飛ばす
        if(Auth::check() === false){
            Session::set_flash("error", "色々未実装。ログイン後 auth/signup_profile へ自ら行ってください");
            Response::redirect("auth/signin");
        }
        
        // user_idを取得
        list(, $userid) = Auth::get_user_id();
        
        // モックとはいえさすがに同じユーザーのプロフィールを2個作らせるわけにはいかない
        $existuser = Model_User_Profile::find('all', array(
            'where' => array(
                array('user_id', $userid)
            )
        ));
        if($existuser){
            Session::set_flash("error", "既にユーザーのプロフィール作ってあるっぽい");
            Response::redirect("/");
        }
        

        // ^p^
        $prof = new Model_User_Profile(array(
            'user_id' => $userid,
            'name' => Input::post("name"),
            'gender' => Input::post("gender"),
            'country' => Input::post("country"),
            "pr" => Input::post("pr")
        ));
        $prof->save();
        $profid = $prof->id;

        $langus = (array)Input::post('language', []);
        foreach($langus as $lang){
            $mlang = new Model_User_Language(array(
                'user_prof_id' => $profid,
                'name' => $lang
            ));
            $mlang->save();
        }
        
		$this->template->title = 'ユーザープロフィール登録';
		$this->template->content = View::forge('auth/signup_profile_confirm');
    }

    /***
     * サインイン
     */
	public function action_signin()
	{
        var_dump(Auth::check());
        if(Input::method() === "POST"){
            $user = Auth::login(Input::post('username'),Input::post('password'));
            if($user){
                Response::redirect('/');
            }
        }
        
		$this->template->title = 'Signin';
		$this->template->content = View::forge('auth/signin');
	}

    /***
     * サインアウト
     */
	public function action_signout()
	{
        Auth::logout();
        
		$this->template->title = 'ログアウト';
		$this->template->content = View::forge('auth/signout');
	}

}
