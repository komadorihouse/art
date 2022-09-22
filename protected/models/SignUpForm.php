<?php


class SignUpForm extends CFormModel
{
	public $username;
	public $password;
	public $sait;
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
			'sait' => 'URL',
			'profile' => 'プロフィール',
			'rememberMe'=>'次回からは自動的にログイン',
		);
	}

	public function save() {
		
		if ( !$this->hasErrors() ) {
			
			$tbl_user = new TblUser();
			$tbl_user->username = $this->username;
			$tbl_user->password = md5($this->password);
			$tbl_user->email = $this->email;
			$tbl_user->sait = $this->sait;
			$tbl_user->profile = $this->profile;
			$tbl_user->save();

			return $tbl_user;
		}
		return false;
	}

	
}
