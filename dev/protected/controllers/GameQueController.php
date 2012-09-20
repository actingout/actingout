<?php

class GameQueController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'GameQue'),
		));
	}

	public function actionCreate() {
		$model = new GameQue;


		if (isset($_POST['GameQue'])) {
			$model->setAttributes($_POST['GameQue']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->que_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'GameQue');


		if (isset($_POST['GameQue'])) {
			$model->setAttributes($_POST['GameQue']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->que_id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'GameQue')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('GameQue');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new GameQue('search');
		$model->unsetAttributes();

		if (isset($_GET['GameQue']))
			$model->setAttributes($_GET['GameQue']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}