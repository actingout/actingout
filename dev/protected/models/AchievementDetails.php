<?php

Yii::import('application.models._base.BaseAchievementDetails');

class AchievementDetails extends BaseAchievementDetails
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function rules() {
		return array(
			array('', 'required'), 
			array('ach_con', 'numerical', 'integerOnly'=>true),
			array('ach_name, category', 'length', 'max'=>255),
			array('earned, applies_for', 'length', 'max'=>5),
			array('in_row', 'length', 'max'=>3),
			array('ach_id, ach_name, ach_desc, earned, applies_for, in_row, category, ach_con', 'safe', 'on'=>'search'),
		);
	}
        public static function label($n = 1) {
		return Yii::t('app', 'AchievementDetail|AchievementDetails', $n);
	}
}