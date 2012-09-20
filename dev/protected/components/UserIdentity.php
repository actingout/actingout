<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    public $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		
                $record = Admins::model()->findByAttributes(array('username'=>  $this->username, 'password' => md5($this->password)));           
		
                
                if($record === null || empty($record)){
                   
                    $this->errorCode = self::ERROR_USERNAME_INVALID;
                }else{
                           
                    $record->lastdate =  date("Y-m-d h:i:s");   

                    if($record->save()) {

                    } 
                               
                
                    $this->_id = $record->id;
                    $this->setState('username', $record->username);
                    $this->errorCode = self::ERROR_NONE;
                }
                
                
               return !$this->errorCode; 
	}
        
         public function getId() {
           return $this->_id;
        }
        
        
}