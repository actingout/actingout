<?php

Yii::import('application.models._base.BaseUserDetails');

class UserDetails extends BaseUserDetails
{
        public $repeat_password;
        public $password;
        
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function rules() {
		return array(
			array('', 'required'),
                        array('user_password, user_email, user_name','required', 'on'=>'insert'),
                        array('user_password, repeat_password', 'length','min'=>3, 'max'=>40),
                        array('user_password', 'compare', 'compareAttribute'=>'repeat_password'),
                        array('user_email', 'email'), 
			array('user_email', 'length', 'max'=>100),      
			array('dynamite_number', 'numerical', 'integerOnly'=>true),
                    
			array('user_alternate_id, user_email, user_password, user_name, user_points', 'length', 'max'=>255),
			array('game_type', 'length', 'max'=>4),
			array('user_id, user_alternate_id, user_email, user_password, user_name, user_points, dynamite_number, game_type', 'safe', 'on'=>'search'),
		);
	}
        
        public static function label($n = 1) {
		return Yii::t('app', 'UserDetail|UserDetails', $n);
	}
         public function beforeSave()
        { 
            // in this case, we will use the old hashed password.
            if(empty($this->user_password) && empty($this->repeat_password) && !empty($this->password))               
                $this->user_password=$this->repeat_password=$this->password;
               
            return parent::beforeSave();
        }

        public function afterFind()
        {
            //reset the password to null because we don't want the hash to be shown.
            $this->password = $this->user_password;
            $this->user_password = null;

            parent::afterFind();
        }
        
        public function saveModel($data=array())
        {
            
                //because the hashes needs to match
                if(!empty($data['user_password']) && !empty($data['repeat_password']))
                {
                  
                    $data['user_password'] = md5($data['user_password']);
                    $data['repeat_password'] = md5($data['repeat_password']);
                    
                }else{
                    $data['user_password'] = $this->password;
                    $data['repeat_password'] = $this->password;
                } 
              
                
                $this->attributes=$data;

                if(!$this->save()){
               
                                        
                    return false;//CHtml::errorSummary($this);
                }
               
             return true;
        }
        
        

}