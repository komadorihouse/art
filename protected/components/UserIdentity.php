<?php
class UserIdentity extends CUserIdentity
{
    private $_id;

    /**
	 * @var string username
	 */
	public $email;
    public $username;
	/**
	 * @var string password
	 */
	public $password;
	public $role;
	/**
	 * Constructor.
	 * @param string $email email
	 * @param string $password password
	 */
	public function __construct($email,$password)
	{
		$this->email = $email;
		$this->password = $password;
	}
 
    public function authenticate()
    {
        $email=strtolower($this->email);
        $user=TblUser::model()->findByAttributes(array('email' => $this->email, 'password' => md5($this->password)));
        if($user===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($user->password !== md5($this->password) )
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->errorCode=self::ERROR_NONE;
            $this->_id=$user->id;
            $this->email=$user->email;
            $this->username=$user->username;
        }
        return $this->errorCode==self::ERROR_NONE;
    }
 
    public function getId()
    {
        return $this->_id;
    }

		
}