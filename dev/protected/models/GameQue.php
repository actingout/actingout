<?php

Yii::import('application.models._base.BaseGameQue');

class GameQue extends BaseGameQue
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function rules() {
		return array(
			array('user_id', 'required'),
			array('game_count', 'numerical', 'integerOnly'=>true),
			array('que_status', 'length', 'max'=>4),
			array('que_id, user_id, que_status, que_time, game_count', 'safe', 'on'=>'search'),
		);
	}
        
        public function search() {
		$criteria = new CDbCriteria;
                $criteria->join = "LEFT JOIN user_details u ON t.user_id=u.user_id ";
                
		$criteria->compare('que_id', $this->que_id);		
                $criteria->compare('user_name', $this->user_id); //$criteria->compare('user_id', $this->user_id);
		$criteria->compare('que_status', $this->que_status, true);
		$criteria->compare('que_time', $this->que_time, true);
		$criteria->compare('game_count', $this->game_count);
                

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}