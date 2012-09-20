<?php

Yii::import('application.models._base.BaseAchievements');

class Achievements extends BaseAchievements
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        public function rules() {
		return array(
			array('user_id, game_category, status', 'required'),
			array('user_id, ach_count', 'numerical', 'integerOnly'=>true),
			array('game_category', 'length', 'max'=>255),
			array('status', 'length', 'max'=>5),
			array('ach_id, user_id, game_category, ach_count, status', 'safe', 'on'=>'search'),
		);
	}
        
        public static function label($n = 1) {
		return Yii::t('app', 'Achievement|Achievements', $n);
	}
}