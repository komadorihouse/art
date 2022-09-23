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

			$is_error = false;

			//tbl_userテーブルを入力されたアドレスで検索
			$model = TblUser::model()->find(array(
				'condition' => "email = '{$this->email}' "
			));

			//検索結果が存在する場合はエラーを表示
			if($model){
				//$this->addErrorはフォームにエラーを挿入する。第一引数はエラー対象項目名、第二引数はエラー内容
				$this->addError('email','このメールアドレスは既に使用されています。');
				//is_errorを真にする。
				$is_error = true;
			}
			
			//is_errorが偽の時のみ内容を保存する。
			if(!$is_error){
				$tbl_user = new TblUser();//新規にテーブルに保存する場合はテーブルのインスタンスを呼ぶ。
				//テーブル名->カラム名 = フォームで送られてきたデータ。
				$tbl_user->username = $this->username;
				$tbl_user->password = md5($this->password);//ms5はphpの関数ハッシュ化し、内容を隠すことができる。
				$tbl_user->email = $this->email;
				$tbl_user->sait = $this->sait;
				$tbl_user->profile = $this->profile;
				$tbl_user->save();//$フォーム->save();でフォームにセットされた値をテーブルに保存できる。

				return $tbl_user;//SiteControllerに保存したデータが返され、コントローラー側で$dataに代入される。
			}
		}
		return false;
	}

	
}
