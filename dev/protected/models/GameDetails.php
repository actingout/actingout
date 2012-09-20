<?php

Yii::import('application.models._base.BaseGameDetails');

class GameDetails extends BaseGameDetails
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function rules() {
		return array(
			array('', 'required'),
			array('userone_id, usertwo_id, game_points, game_round_one, game_round_two', 'numerical', 'integerOnly'=>true),
			array('game_video_url, game_word, game_hint, game_category', 'length', 'max'=>255),
			array('game_status', 'length', 'max'=>15),
			array('game_id, userone_id, usertwo_id, game_points, game_video_url, game_status, game_round_one, game_round_two, game_time, game_word, game_hint, game_category', 'safe', 'on'=>'search'),
		);
	}
        
        public static function label($n = 1) {
		return Yii::t('app', 'GameDetail|GameDetails', $n);
	}
        
        public function search() {
		$criteria = new CDbCriteria;
                              
		$criteria->compare('game_id', $this->game_id);
		$criteria->compare('userone_id', $this->userone_id);
		$criteria->compare('usertwo_id', $this->usertwo_id);                        
		$criteria->compare('game_points', $this->game_points);
		$criteria->compare('game_video_url', $this->game_video_url, true);
		$criteria->compare('game_status', $this->game_status, true);
		$criteria->compare('game_round_one', $this->game_round_one);
		$criteria->compare('game_round_two', $this->game_round_two);
		$criteria->compare('game_time', $this->game_time, true);
		$criteria->compare('game_word', $this->game_word, true);
		$criteria->compare('game_hint', $this->game_hint, true);
		$criteria->compare('game_category', $this->game_category, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
    
}