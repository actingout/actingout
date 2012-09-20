<?php

class AdminsController extends GxController {
        
    public $layout = 'column2'; 
    
     public function filters()
     {
         return array (
                   'accessControl' ,
         );

     }

     public function accessRules()
     {
         return array (
                   array ('allow' , // allow admin user to perform actions
                             'actions' => array ('admin' , 'delete' , 'create' , 'view' , 'update','users') ,
                             'users' => array ('*') ,
                   ) ,
                   array ('deny' , // deny all users
                             'users' => array ('*') ,
                   ) ,
         );

     }


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Admins'),
		));
	}

	public function actionCreate() {          
                      
             $model = new Admins;
    
            
		if (isset($_POST['Admins'])) {
                    
                    //$model->setAttributes($_POST['Admins']);                  
                  	

                     if ($model->saveModel($_POST['Admins'])) {                            
                           
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}else{
                            
                            $model->password = $_POST['Admins']['password'];
                            $model->repeat_password = $_POST['Admins']['repeat_password'];
                        }
		}

		$this->render('create', array( 'model' => $model));
	}

        
        
	public function actionUpdate($id) {
		
                $model = $this->loadModel($id, 'Admins');

		if (isset($_POST['Admins'])) {      
             
			if ($model->saveModel($_POST['Admins'])) {
				$this->redirect(array('view', 'id' => $model->id));
			}else{
                            $model->password = $_POST['Admins']['password'];
                            $model->repeat_password = $_POST['Admins']['repeat_password'];
                        }
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

        
        
	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Admins')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {           
            
		$dataProvider = new CActiveDataProvider('Admins');
		$this->render('admin', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Admins('search');
		$model->unsetAttributes();

		if (isset($_GET['Admins']))
			$model->setAttributes($_GET['Admins']);

		$this->render('admin', array(
			'model' => $model,
		));
	}
        
        
        public function actionUsers(){
            
            $dataProvider = new CActiveDataProvider('UserDetails');
		$this->render('users', array(
			'data' => $dataProvider,
		));
                
        }
        
       

        
        
}