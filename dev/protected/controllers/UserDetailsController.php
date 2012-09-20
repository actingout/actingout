<?php

class UserDetailsController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'UserDetails'),
		));
	}

	public function actionCreate() {
		$model = new UserDetails;

               
               

		if (isset($_POST['UserDetails'])) {
                    
                    
                        $criteria            = new CDbCriteria;
                       
                
                        if($_POST['UserDetails']['user_email'] != ""){
                            $criteria->condition = 'LOWER(user_email)=:email';
                            $criteria->params    = array(':email'=>strtolower($_POST['UserDetails']['user_email']));

                        }else if($_POST['UserDetails']['user_name'] != ""){

                             $criteria->condition = 'LOWER(user_name)=:username';
                             $criteria->params    = array(':username'=>strtolower($_POST['UserDetails']['user_name']));
                        }
                         $user = $model->find($criteria);
                    
                            if($user){
                                   
                            }else{
                                $model->setAttributes($_POST['UserDetails']);

                                if ($model->saveModel($_POST['UserDetails'])) {
                                        if (Yii::app()->getRequest()->getIsAjaxRequest())
                                                Yii::app()->end();
                                        else
                                                $this->redirect(array('view', 'id' => $model->user_id));
                                }else{
                                    $model->user_password = $_POST['UserDetails']['user_password'];
                                    $model->repeat_password = $_POST['UserDetails']['repeat_password'];
                                }
                            }
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'UserDetails');


		if (isset($_POST['UserDetails'])) {
			$model->setAttributes($_POST['UserDetails']);

			if ($model->saveModel($_POST['UserDetails'])) {
				$this->redirect(array('view', 'id' => $model->user_id));
			}else{
                            $model->user_password = $_POST['UserDetails']['user_password'];
                            $model->repeat_password = $_POST['UserDetails']['repeat_password'];
                        }
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'UserDetails')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('UserDetails');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new UserDetails('search');
		$model->unsetAttributes();

		if (isset($_GET['UserDetails']))
			$model->setAttributes($_GET['UserDetails']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}