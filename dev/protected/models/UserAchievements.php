<?php

Yii::import('application.models._base.BaseUserAchievements');

class UserAchievements extends BaseUserAchievements
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function rules() {
		return array(
			array('user_id', 'required'), //, player_id, in_a_row, guess, categories_act, categories_guess, achievements
			array('user_id, in_a_row, guess', 'numerical', 'integerOnly'=>true),
			array('user_achievement_id, user_id, player_id, in_a_row, guess, categories_act, categories_guess, achievements', 'safe', 'on'=>'search'),
		);
	}
        
        public static function label($n = 1) {
		return Yii::t('app', 'UserAchievement|UserAchievements', $n);
	}
}