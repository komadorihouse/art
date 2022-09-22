<?php


class SignUpForm extends CFormModel
{
	public $username;
	public $password;
	public $site;
	public $email;
	public $profile;
	public $rememberMe;

	private $_identity;

	// バリテーションを定める
	public function rules()
	{
		return array(
			// required = 必須項目
			array('username, password, email', 'required'),
			// boolean = 真偽値のみ許可
			array('rememberMe', 'boolean'),
			
		);
	}

	/**
	 * 各項目にフォームで使用する名前をつけられる。
	 * つけなくても良い。
	 */
	public function attributeLabels()
	{
		return array(
			'username' => 'ユーザー名',
			'password' => 'パスワード',
			'email' => 'Eメールアドレス',
			'profile' => 'プロフィール',
			'rememberMe'=>'次回からは自動的にログイン',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function save()
	{
		if(!$this->hasErrors())
		{
			$tbl_user = new TblUser();
			$tbl_user->username = $this->username;
			$tbl_user->password = md5($this->password);
			$tbl_user->site = $this->site;
			$tbl_user->profile = $this->profile;
			$tbl_user->save();
		}
		return null;
	}

	
}
