<?php

 class SiteController
    extends Controller{

     public $layout = 'column1';

     /**
      * Declares class-based actions.
      */
     public function actions(){
         return array (
                   // captcha action renders the CAPTCHA image displayed on the contact page
                   'captcha' => array (
                             'class'     => 'CCaptchaAction' ,
                             'backColor' => 0xFFFFFF ,
                   ) ,
                   // page action renders "static" pages stored under 'protected/views/site/pages'
                   // They can be accessed via: index.php?r=site/page&view=FileName
                   'page'      => array (
                             'class' => 'CViewAction' ,
                   ) ,
         );

     }

     public function actionRegister(){
         $this -> render('error' , array ('message' => 'Please contact the Main St. Staff to create your account.'));

     }

     public function actionIndex(){
         
      
         if (!Yii::app() -> user -> id)
         {
             $this -> redirect(Yii::app() -> createUrl('/site/login'));
         }
         else
         {
            $this -> redirect( $this -> redirect(Yii::app() -> createUrl('/admins/admin')));             
         }

     }

     /**
      * This is the action to handle external exceptions.
      */
     public function actionError(){

         $this -> layout = 'column2';
         if ($error          = Yii::app() -> errorHandler -> error)
         {
             $errorCode = $error['code'];
             $title     = "An Error has occured";
             $message   = $error['message'];
             switch ($errorCode)
             {
                 case 403:
                     $title             = "No Access";
                     $message           = "Sorry, you are not authorized to perform this action";
                     break;
                 case 404:
                     $title             = "Page not Found";
                     //$message="";
                     break;
                 case 500:
                     $title             = "An Error has occured";
                     //$message="";
                     break;
             }
             $this -> pageTitle = $title;
             if (Yii::app() -> request -> isAjaxRequest)
             {
                 echo $message;
             }
             else
             {
                 $this -> render('error' , $error);
             }
         }

     }

     /**
      * Displays the login page
      */
     public function actionLogin(){
         $model = new LoginForm;

         if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
         {
             echo CActiveForm::validate($model);
             Yii::app() -> end();
         }
         
         // collect user input data
         if (isset($_POST['LoginForm']))
         {
             $model -> attributes = $_POST['LoginForm'];
             
        
             if ($model -> validate() && $model->login())                 
             {        
                    
                 
                 $this -> redirect(Yii::app() -> createUrl('/admins/admin'));                
               
             }
            else{
             
                $this -> render('login' , array ('model' => $model, 'msg'=>$model->errors));
             exit();
            }
            
         }
         $this -> render('login' , array ('model' => $model));
     }

     /**
      * Logs out the current user and redirect to homepage.
      */
     public function actionLogout(){
         Yii::app() -> user -> logout();
         $this -> redirect(Yii::app() -> homeUrl);

     }

 }