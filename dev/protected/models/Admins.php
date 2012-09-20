<?php

Yii::import('application.models._base.BaseAdmins');

class Admins extends BaseAdmins
{
        public $repeat_password;
        public $initialPassword;
	
        public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
       public function rules() {
		return array(
			array('username, password, email', 'required'),
                        array('username', 'unique'),
                    
                       // array('password, repeat_password', 'required', 'on'=>'insert'),
                        array('password, repeat_password', 'length','min'=>3, 'max'=>40),
                        array('password', 'compare', 'compareAttribute'=>'repeat_password'),
                    
			array('username, password', 'length', 'max'=>50),
                        array('email', 'email'), //,'checkMX'=>true
			array('email', 'length', 'max'=>100),                       
			array('id, username, password, email, createdate, lastdate', 'safe', 'on'=>'search'),
		);
	}
        
        public static function label($n = 1) {
		return Yii::t('app', 'Admin|Admins', $n);
	}
        
        public function beforeSave()
        {
            // in this case, we will use the old hashed password.
            if(empty($this->password) && empty($this->repeat_password) && !empty($this->initialPassword))
                $this->password=$this->repeat_password=$this->initialPassword;
               
            return parent::beforeSave();
        }

        public function afterFind()
        {
            //reset the password to null because we don't want the hash to be shown.
            $this->initialPassword = $this->password;
            $this->password = null;

            parent::afterFind();
        }
        
        public function saveModel($data=array())
        {
            
                //because the hashes needs to match
                if(!empty($data['password']) && !empty($data['repeat_password']))
                {
                  
                    $data['password'] = md5($data['password']);
                    $data['repeat_password'] = md5($data['repeat_password']);
                    
                }else{
                    $data['password'] = $this->initialPassword;
                    $data['repeat_password'] = $this->initialPassword;
                }
  
                //$data['lastdate'] = date("Y-m-d h:s:i");
             
                $this->attributes=$data;                
                
                if(!isset($data['createdate']) ){
                    //$data['createdate'] = date("Y-m-d h:s:i");
                   $this->createdate = date("Y-m-d h:s:i");
                }else{
                    $this->lastdate = date("Y-m-d h:s:i");
                
                }
               
                if(!$this->save()){               
                                        
                    return false;//CHtml::errorSummary($this);
                }
               
             return true;
        }
}