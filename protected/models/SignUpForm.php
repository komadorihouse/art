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
			// password needs to be authenticated
			array('password', 'authenticate'),
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
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
