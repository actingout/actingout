<?php
//Yii::import('ext.logger.CPSLiveLogRoute');

class ApiController extends Controller {
    
    /**
     * Default response format
     * either 'json' or 'xml'
     */
    private $format = 'json';
    
    
   
   public function actionLogin()
   {
       Yii::log("Login(). ", 'info', 'system.web.CController');
        
       if(!(isset($_REQUEST)) ){
           Yii::log("Login(). Request is empty", 'error', 'system.web.CController');
           $this->_sendResponse(401);
       }       
       
       
       if(!isset($_REQUEST['user_name']) && !isset($_REQUEST['user_email']) || !isset($_REQUEST['user_password'])) {  
           
           Yii::log('Login(). ' . 'Required information is missing', 'error', 'system.web.CController');
           
           $this->_sendResponse(401, array('message'=>'Required information is missing','rstatus'=>'0','errorcode'=>'100','data'=>array()));
       }
       
       Yii::log("Login(). " . print_r($_REQUEST, true), 'info', 'system.web.CController');
        
       $email    = isset($_REQUEST['user_email'])? $_REQUEST['user_email'] : '';
       $username = isset($_REQUEST['user_name'])? $_REQUEST['user_name']: '';
       $password = isset($_REQUEST['user_password'])? md5($_REQUEST['user_password']):'';
       
      
       $criteria            = new CDbCriteria;
       
       if($email != ""){
           
            $criteria->condition = 'LOWER(user_email)=:email';
            $criteria->params    = array(':email'=>strtolower($email));
            
       }else if($username != ""){
           
            $criteria->condition = 'LOWER(user_name)=:username';
            $criteria->params    = array(':username'=>strtolower($username));
           
       }
       $model = UserDetails::model();
       $user = $model->find($criteria);
       
        if($user === null) {
            
                 Yii::log("Login(). User Name is invalid ", 'error', 'system.web.CController');
               // Error: Unauthorized              
                $this->_sendResponse(401, array('message'=>'User Name is invalid', 'rstatus'=>'0', 'errorcode'=>'101', 'data'=>''));
               return false;
               
       } else if($user->password != $password) {
           
                Yii::log("Login(). User Password is invalid ", 'error', 'system.web.CController');
               // Error: Unauthorized               
                $this->_sendResponse(401, array('message'=>'Error: User Password is invalid', 'rstatus'=>'0', 'errorcode'=>'102', 'data'=>''));
               
                return false;
       }else {
           
           Yii::log("Login(). " . print_r($user, true), 'info', 'system.web.CController');
           
           $this->_sendResponse(200, $user );
       }
              
    }
    
    public function actionRegistration(){
        
        Yii::log("Registration(). ", 'info', 'system.web.CController');
        
        if(!(isset($_REQUEST)) ){
           Yii::log("Registration(). Request is empty", 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        
        if(!isset($_REQUEST['user_name']) && !isset($_REQUEST['user_email']) || !isset($_REQUEST['user_password'])) {
           
           Yii::log('Registration(). '.'Required information is missing', 'error', 'system.web.CController');
           $this->_sendResponse(401, array('message'=>'Required information is missing','rstatus'=>'0','errorcode'=>'100','data'=>array()));
       }
       
       Yii::log("Registration(). ".print_r($_REQUEST, true), 'info', 'system.web.CController');
       
       $email    = isset($_REQUEST['user_email'])? $_REQUEST['user_email'] : '';
       $username = isset($_REQUEST['user_name'])? $_REQUEST['user_name']: '';
       $password = isset($_REQUEST['user_password'])? md5($_REQUEST['user_password']):'';
      
        
       $criteria            = new CDbCriteria;
       
       if($email != ""){
           $criteria->condition = 'LOWER(user_email)=:email';
           $criteria->params    = array(':email'=>strtolower($email));
           
       }else if($username != ""){
           
            $criteria->condition = 'LOWER(user_name)=:username';
            $criteria->params    = array(':username'=>strtolower($username));
       }
       
       $model = UserDetails::model();
       $user = $model->find($criteria);
      
       
       if( $user ){
           Yii::log("Registration(). ".print_r('User is already exists', true), 'error', 'system.web.CController');
           $this->_sendResponse(401, array('message'=>'User is already exists','rstatus'=>'0','errorcode'=>'103','data'=>array()));
             
       }else{
           $user = new UserDetails;
           $user->user_email       = $email;
           $user->user_name        = $username;
           $user->user_password    = $password;
           $user->repeat_password = $password;
           $user->user_points      = isset($_REQUEST['user_points']) ? $_REQUEST['user_points'] : '';
           $user->dynamite_number  = isset($_REQUEST['dynamite_number']) ? $_REQUEST['dynamite_number'] :'';
           $user->game_type        = isset($_REQUEST['game_type']) ? $_REQUEST['game_type']: '';           
           
         
           if($user->save())
           {
              
               $user->user_alternate_id = 'USER'.$user->user_id;
               if( $user->save($criteria) )
               {
                  // $this->_sendResponse(401, array('message'=>'Can not save parameters','rstatus'=>'0','errorcode'=>'100','data'=>array()));
               }
           
           }else{
                Yii::log("Registration(). ".print_r("Can't save parameters", true), 'error', 'system.web.CController');
               $this->_sendResponse(401, array('message'=>sprintf("Can't save parameters"),'rstatus'=>'0','errorcode'=>'106','data'=>array()));
           }
      
           Yii::log("Registration(). ".print_r($user, true), 'info', 'system.web.CController');
           $this->_sendResponse(200, $user );
       }
       
    }
    
    
    public function actionStart(){
        
        Yii::log("Start(). ", 'info', 'system.web.CController');
        
        if(!(isset($_REQUEST)) ){
           Yii::log("Start(). Request is empty", 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        
      
        if(!isset($_REQUEST['userone_id']) && !isset($_REQUEST['usertwo_id'])) {
            
           Yii::log("Start(). ". print_r('Required information is missing',true) , 'error', 'system.web.CController');
           $this->_sendResponse(401, array('message'=>'Required information is missing','rstatus'=>'0','errorcode'=>'100','data'=>array()));
       }
       
       Yii::log("Start(). " . print_r($_REQUEST, true), 'info', 'system.web.CController');
       
       $userone_id = $_REQUEST['userone_id'];
       $usertwo_id = $_REQUEST['usertwo_id'];
       
       $model = GameDetails::model();
       
       $criteria = new CDbCriteria();
       
       $criteria->condition = 'userone_id=:userone_id and usertwo_id=:usertwo_id';
       $criteria->params =  array(':userone_id'=>$userone_id, ':usertwo_id'=>$usertwo_id);
       
     
       $game = $model->find($criteria);
       
       if($game !== null)
       {
            Yii::log("Start(). " . 'Game already exists between users', 'info', 'system.web.CController');
            
            $this->_sendResponse(200, 'Game already exists between users');
            
       }else{
            $criteria->condition = 'usertwo_id=:userone_id and userone_id=:usertwo_id';
            $criteria->params =  array(':userone_id'=>$userone_id, ':usertwo_id'=>$usertwo_id);
            
            $game = $model->find($criteria);
            if($game !== null)
            {
                 Yii::log("Start(). " . 'Game already exists between users', 'info', 'system.web.CController');
                 $this->_sendResponse(200, 'Game already exists between users' );
            }else{
                $game = new GameDetails(); 
                $game->userone_id = $userone_id;
                $game->usertwo_id = $usertwo_id;
                $game->game_status = 'Waiting';
                $game->game_time = date('Y-m-d h:i:s');//'NOW()';
              
                if($game->save()){
                    
                     Yii::log("Start(). " .  print_r($game, true), 'info', 'system.web.CController');
                    $this->_sendResponse(200, $game );
                }else{
                    
                    Yii::log("Start(). ".print_r(" Can't save parameters", true), 'error', 'system.web.CController');
                    $this->_sendResponse(401, array('message'=>sprintf("Can't save parameters"), 'rstatus'=>'0', 'errorcode'=>'106', 'data'=>''));
                }
            }
            
       }
        
    }
    public function actionSubmitGame(){
        
         Yii::log("SubmitGame(). ", 'info', 'system.web.CController');
         
         if(!(isset($_REQUEST)) ){
           Yii::log("SubmitGame(). Request is empty", 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        
        if(!isset($_REQUEST['game_id']))
        {    
            Yii::log("SubmitGame(). " . "Game id is required", 'error', 'system.web.CController');        
            $this->_sendResponse(401, array('message'=>'Game id is required','rstatus'=>'0','errorcode'=>'107','data'=>array()));            
        }
              
        Yii::log("SubmitGame(). " .  print_r($_REQUEST, true), 'info', 'system.web.CController');
         
        $criteria = new CDbCriteria();        
        $criteria->condition = 'game_id=:game_id';
        $criteria->params = array(':game_id'=>$_REQUEST['game_id']);
        
        $model = GameDetails::model();
        
        $game = $model->find($criteria);
        
        if($game){
            
            $game->game_points    = isset($_REQUEST['game_points'])? $_REQUEST['game_points']: $game->game_points;
            $game->game_word      = isset($_REQUEST['game_word'])? $_REQUEST['game_word']:  $game->game_word;
            $game->game_hint      = isset($_REQUEST['game_hint'])? $_REQUEST['game_hint']: $game->game_hint;
            $game->game_video_url = isset($_REQUEST['game_video_url'])? $_REQUEST['game_video_url'] : $game->game_video_url;
            $game->game_status    = isset($_REQUEST['game_status']) ? $_REQUEST['game_status']: $game->game_status;
            $game->game_category  = isset($_REQUEST['game_category'])? $_REQUEST['game_category']: $game->game_category;
            $game->game_time      = date('Y-m-d h:i:s'); //NOW() function
           // $game->game_id        = $_REQUEST['game_id'];
            
           
            
            if($game->save()){
                
                Yii::log('SubmitGame(). ' .'Success', 'info', 'system.web.CController');
                $this->_sendResponse(200, 'Success' );
            }else{
                 Yii::log("SubmitGame(). " .  print_r("Can't save parameters", true), 'error', 'system.web.CController');
                $this->_sendResponse(401, array('message'=>sprintf("Can't save parameters"), 'rstatus'=>'0', 'errorcode'=>'106', 'data'=>''));
            }
        }else{
             Yii::log("SubmitGame(). " .  print_r("Could'n game ID", true), 'error', 'system.web.CController');
             $this->_sendResponse(401, array('message'=>sprintf("Could'n game ID "), 'rstatus'=>'0', 'errorcode'=>'107', 'data'=>''));
        }        
        
    }
    
    public function actionSubmitGuess(){
        
         Yii::log("SubmitGuess(). ", 'info', 'system.web.CController');
         
        if(!(isset($_REQUEST)) ){
           Yii::log("SubmitGuess(). Request is empty", 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        
        if(!isset($_REQUEST['game_id'])){
            
            Yii::log("SubmitGuess(). ". print_r('Game id is required', true), 'error', 'system.web.CController');
            $this->_sendResponse(401, array('message'=>'Game id is required','rstatus'=>'0','errorcode'=>'107','data'=>array()));  
        }
        
        Yii::log("SubmitGuess(). ". print_r($_REQUEST, true), 'info', 'system.web.CController');
        
        $criteria = new CDbCriteria();        
        $criteria->condition = 'game_id=:game_id';
        $criteria->params = array(':game_id'=>$_REQUEST['game_id']);
        
        $model = GameDetails::model();
        $game = $model->find($criteria);
        
        if($game === null){ 
            
            Yii::log("SubmitGuess(). ". print_r('Not found any records', true), 'error', 'system.web.CController');
            $this->_sendResponse(401, array('message'=>'Not found any records','rstatus'=>'0','errorcode'=>'110','data'=>''));
            
        }else{
            
            if($_REQUEST['game_result'] == 1 )
            {
                if($game->game_round_one == 5 && $game->game_round_two == 5 )
                {
                    $game->game_status = 'Finished';
                    $game->game_time    = date('Y-m-d h:i:s'); //NOW() function
                    
                    if($game->save()){
                        
                          Yii::log('SubmitGuess(). '. 'Success', 'info', 'system.web.CController');
                          $this->_sendResponse(200, 'Success' );
                    }
                }else{
                        if($_REQUEST['player'] == 1 )
                        {
                            $game->game_round_one = $game->game_round_one + 1;
                        }else{
                            $game->game_round_two = $game->game_round_two + 1; 
                        }
                        
                        $game->game_status = $_REQUEST['game_status'];
                        $game->game_time   = date('Y-m-d h:i:s'); //NOW() function
                        
                        if($game->save())
                        {
                             Yii::log('SubmitGuess(). '. 'Success', 'info', 'system.web.CController');
                             $this->_sendResponse(200, 'Success' );
                        } else{
                            
                            Yii::log("SubmitGuess(). ". print_r("Can't save parameters", true), 'error', 'system.web.CController');
                            $this->_sendResponse(401, array('message'=>sprintf("Can't save parameters"),'rstatus'=>'0','errorcode'=>'106','data'=>array()));
                        }                
                        
                 }
                
            }else{
                    $game->game_status = $_REQUEST['game_status'];
                    $game->game_round_one = 1;
                    $game->game_round_two = 1;
                    $game->game_time   = date('Y-m-d h:i:s'); //NOW() function
                    
                    
                    if($game->save())
                    {
                         Yii::log('SubmitGuess(). '. 'Success', 'info', 'system.web.CController');
                         $this->_sendResponse(200, 'Success' );
                    }else{
                        
                         Yii::log("SubmitGuess(). ". print_r("Can't save parameters", true), 'error', 'system.web.CController');
                        $this->_sendResponse(401, array('message'=>sprintf("Can't save parameters"),'rstatus'=>'0','errorcode'=>'106','data'=>array()));
                    }
            }
        }   
        
    }       
    
    
    public function actionAchievementDetails(){
        
         Yii::log('AchievementDetails(). ', 'info', 'system.web.CController');
        
         if(!(isset($_REQUEST)) ){
           Yii::log('AchievementDetails(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if(!isset($_REQUEST['ach_id'])){
             Yii::log('AchievementDetails(). '. 'Required information is missing',  'error', 'system.web.CController');
             $this->_sendResponse(401, array('message'=>'Required information is missing','rstatus'=>'0','errorcode'=>'100','data'=>array()));  
            
        }
        Yii::log('AchievementDetails(). '. print_r($_REQUEST, true), 'info', 'system.web.CController');
        
        $ach_id = $_REQUEST['ach_id'];
        
        $model = AchievementDetails::model();
        
        $criteria = new CDbCriteria();
        
        $criteria->condition = 'ach_id=:ach_id';
        $criteria->params = array(':ach_id'=>$ach_id);
        
        $achievment = $model->find($criteria);
        
        if($achievment === null)
        {
             Yii::log('AchievementDetails(). '. 'Not found any records', 'error', 'system.web.CController');
             $this->_sendResponse(401, array('message'=>'Not found any records','rstatus'=>'0','errorcode'=>'110','data'=>array()));  
             
        }else{
            Yii::log("AchievementDetails(). ". print_r($achievment, true), 'info', 'system.web.CController');
            $this->_sendResponse(200, $achievment );
        }
        
    }
    
    public function actionAddAchievement() {
        
        Yii::log('AddAchievement(). ', 'info', 'system.web.CController');
        
         if(!(isset($_REQUEST)) ){
           Yii::log('AddAchievement(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if(!isset($_REQUEST['user_id']) && !isset($_REQUEST['game_category']) && !isset($_REQUEST['status']) ){
             
             Yii::log('AddAchievement(). '. 'Required information is missing', 'error', 'system.web.CController');
             $this->_sendResponse(401, array('message'=>'Required information is missing','rstatus'=>'0','errorcode'=>'100','data'=>array())); 
            
        }
        
        Yii::log("AddAchievement(). ". print_r($_REQUEST, true), 'info', 'system.web.CController');
        
        $model = Achievements::model();
                
        
        $criteria = new CDbCriteria();
        $criteria->condition = 'game_category=:game_category AND user_id=:user_id AND status=:status';
        $criteria->params = array(':game_category'=>$_REQUEST['game_category'], ':user_id'=>$_REQUEST['user_id'], ':status'=>$_REQUEST['status']);
        
        $achivement  = $model->find($criteria);
        
        if($achivement)
        {
            $achivement->user_id         = $_REQUEST['user_id'];
            $achivement->game_category   = $_REQUEST['game_category'];
            $achivement->status          = $_REQUEST['status'];
            $achivement->ach_count       = $achivement->ach_count + 1;
            
        }else{
            $achivement = new Achievements;
            $achivement->user_id         = $_REQUEST['user_id'];
            $achivement->game_category   = $_REQUEST['game_category'];
            $achivement->status          = $_REQUEST['status'];
            $achivement->ach_count       = 1;
        }
        if($achivement->save()) {
            
             Yii::log('AddAchievement(). '. 'Success', 'info', 'system.web.CController');
             $this->_sendResponse(200, 'Success');
             
        } else {
            
            Yii::log("AddAchievement(). ". print_r("Can't save parameters", true), 'error', 'system.web.CController');
            $this->_sendResponse(401, array('message'=>sprintf("Can't save parameters"),'rstatus'=>'0','errorcode'=>'106','data'=>array()));  
             
        }
    }
    
    public function actionCheckAchievement(){
        
        Yii::log('CheckAchievement(). ', 'info', 'system.web.CController');
        
        if(!(isset($_REQUEST)) ){
           Yii::log('CheckAchievement(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        
        if(!isset($_REQUEST['user_id']) || !isset($_REQUEST['opponent_id']) ){
            
             Yii::log('CheckAchievement(). '.'Required information is missing', 'error', 'system.web.CController');
             $this->_sendResponse(401, array('message'=>'Required information is missing','rstatus'=>'0','errorcode'=>'100','data'=>array())); 
            
        }
        Yii::log("CheckAchievement(). ".print_r($_REQUEST, true), 'info', 'system.web.CController');
        
        $user_id         = $_REQUEST['user_id'];
        $opponent_id     = $_REQUEST['opponent_id'];
        $status          = isset($_REQUEST['status']) ? $_REQUEST['status']: '';
        $result          = isset($_REQUEST['result']) ? $_REQUEST['result']: '';
        $game_category   = isset($_REQUEST['game_category']) ? $_REQUEST['game_category']: '';
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:user_id';
        $criteria->params = array(':user_id'=>$user_id);

        $model = UserAchievements::model();
        $userDetails = $model->find($criteria);
        
         
        
        if( $userDetails !== null)
        {
            if(!in_array($opponent_id, unserialize($userDetails->player_id) ) &&  $status == 'Guess' )
            {
               // $arrayDetails = unserialize($userDetails->player_id );
               // array_push($arrayDetails, $opponent_id);               
               // $userDetails->player_id = $arrayDetails;
               
                $userDetails->player_id = serialize(array($opponent_id));             
            }
            
            if( $status == 'Guess' ){
                
                    if( $result == 'Win' ){
                        
                         $userDetails->in_a_row = $userDetails->in_a_row + 1;
                         $userDetails->guess = $userDetails->guess + 1;                    
                        // $userDetails->achievements = serialize($this->getAchiements()); //check this data
                        
                    }
                    else{
                        $userDetails->in_a_row = 0;                        
                    }
                    
                    $arrcat = array();
                    $arrcat = unserialize($userDetails->categories_guess);  
                    $arrcat[$game_category] = isset($userDetails->categories_guess[$game_category]) ? $userDetails->categories_guess[$game_category]+1 : 1;
                    $userDetails->categories_guess = serialize($arrcat);
            }            
       
            
            if( $status == 'Act'){
                
                    $arrcat = array();
                    $arrcat = unserialize($userDetails->categories_act);  
                    $arrcat[$game_category] = isset( $userDetails->categories_act[$game_category])?  $userDetails->categories_act[$game_category]+1:1;
                    $userDetails->categories_act = serialize($arrcat);                     
                   
            }
 /*           
            if($userDetails->categories_guess == "")
            {
               $userDetails->categories_guess = serialize(array());
            }
            if($userDetails->categories_act == "")
            {
                $userDetails->categories_act = serialize(array());
            }
            if($userDetails->player_id == "")
            {
                $userDetails->player_id = serialize(array());
            }
             if($userDetails->achievements == "")
            {
                $userDetails->achievements = serialize(array());
            }
        */
        
            if($userDetails->save()){
               
                // $this->_sendResponse(200, array('message'=>'', 'rstatus'=>'1', 'errorcode'=>'', 'data'=>'Success')); 
            }else{
               
                //$this->_sendResponse(401, array('message'=>sprintf("Error: Can't save parameters"), 'rstatus'=>'0', 'errorcode'=>'', 'data'=>'')); 
            }
            
            $getach = $this->getAchiements();            
          
            
            if(!empty($getach[1])){
                
                    $userDetails->achievements = serialize($getach[0]);              
                                        
                    $userDetails->save();
                    
                    
                    $achmodel = AchievementDetails::model();
                    
                    $acharray = array();
                    foreach($getach[1] as $val){
                        
                            $achDetails = $achmodel->findByPk($val);
                            array_push($acharray, $achDetails );                          
                           
                    }
                  Yii::log("CheckAchievement(). ".print_r($acharray, true), 'info', 'system.web.CController');
                  $this->_sendResponse(200, $acharray);  
                  
            }
            
            
            
        }else{
                        
          
            $userDetails = new UserAchievements;
            
            $model = AchievementDetails::model();
            
            $ach_user = '';
            
            if( $status == 'Guess' )
            {
                if( $result == 'Win' )
                {
                     $userDetails->guess = 1;
                     $userDetails->achievements = serialize(array(8));
                     $userDetails->in_a_row = 1;

                     $ach_user = $model->findByPk(1);
                     
                }else{
                    $userDetails->in_a_row = 0;
                    $userDetails->achievements = serialize(array());
                }
                
               $userDetails->player_id = serialize(array($opponent_id)); 
               $userDetails->categories_guess = serialize(array($game_category=>'1'));
               
            }else if( $status == 'Act'){
                
                 $userDetails->categories_act = serialize(array($game_category=>'1'));                  
            }
            else{
                $userDetails->player_id = serialize(array());
                $userDetails->categories_guess = serialize(array());
                $userDetails->categories_act = serialize(array());                    
            }
            
            $userDetails->user_id = $user_id;        
            
            
            if( $userDetails->save())
            {               
                  
            }
            
            if($ach_user != ''){
                
                   Yii::log("CheckAchievement(). ".print_r($ach_user, true), 'info', 'system.web.CController');
                  $this->_sendResponse(200, $ach_user );
            }
            // Yii::log("CheckAchievement() ".print_r("Can't save parameters", true), 'error', 'system.web.CController');
             //$this->_sendResponse(401, array('message'=>  sprintf("Can't save parameters"),'rstatus'=>'0','errorcode'=>'106','data'=>'')); 
            
        }
        
    }
    
    
    public function actionGetAchievement(){
        
         Yii::log('GetAchievement(). ', 'info', 'system.web.CController');
         
         if(!(isset($_REQUEST)) ){
             Yii::log('GetAchievement(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if(! isset($_REQUEST['user_id']) ){
            
             Yii::log('GetAchievement(). '.'User id is required', 'error', 'system.web.CController');
             $this->_sendResponse(401, array('message'=>'User id is required','rstatus'=>'0','errorcode'=>'109','data'=>array())); 
            
        }
        
        Yii::log('GetAchievement(). '.print_r($_REQUEST, true), 'info', 'system.web.CController');
         
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:user_id';
        $criteria->params = array(':user_id'=>$_REQUEST['user_id']);
        
        $model = Achievements::model();
        $achievement = $model->findAll($criteria);
        
        if($achievement !== null )
        {
            $array = array();
            foreach ($achievement as $row) {                
                array_push($array,$row);
            }
            
             Yii::log('GetAchievement(). '.print_r($array, true), 'info', 'system.web.CController');
             $this->_sendResponse(200, $array );
        }else{
            Yii::log('GetAchievement(). '.'Not found any records', 'error', 'system.web.CController');
            $this->_sendResponse(401, array('message'=>'Not found any records','rstatus'=>'0','errorcode'=>'110','data'=>array()));
        }
        
    }
    
    public function actionUserDetails(){
         
        Yii::log('UserDetails(). ', 'info', 'system.web.CController');
         
         if(!(isset($_REQUEST)) ){
             Yii::log("UserDetails(). Request is empty", 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if( !isset($_REQUEST['user_id']) ){
            
             Yii::log('UserDetails(). '.'User id is required', 'error', 'system.web.CController');
             
             $this->_sendResponse(401, array('message'=>'User id is required','rstatus'=>'0','errorcode'=>'109','data'=>array())); 
            
        }
        Yii::log("UserDetails(). ".print_r($_REQUEST, true), 'info', 'system.web.CController');
        
        $user_id = $_REQUEST['user_id'];
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:user_id';
        $criteria->params = array(':user_id'=>$user_id);
        
        $model = UserDetails::model();
        $user = $model->find($criteria);
       
        if($user !== null){
             Yii::log("UserDetails(). ".print_r($user, true), 'info', 'system.web.CController'); 
            $this->_sendResponse(200, $user );
        }else{
             Yii::log('UserDetails(). '.'Not found any records', 'error', 'system.web.CController');
            $this->_sendResponse(401, array('message'=>'Not found any records','rstatus'=>'0','errorcode'=>'110','data'=>'')); 
         
           
        }       
        
    }
    
    public function actionUserUpdate(){
        
         Yii::log("UserUpdate(). ", 'info', 'system.web.CController'); 
         
         if(!(isset($_REQUEST)) ){
            Yii::log('UserUpdate(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if(!isset($_REQUEST['user_id']) && !isset($_REQUEST['user_name']) || !isset($_REQUEST['user_password'])){
            
            Yii::log('UserUpdate(). '.'Required information is missing', 'error', 'system.web.CController');  
            $this->_sendResponse(401, array('message'=>'Required information is missing','rstatus'=>'0','errorcode'=>'100','data'=>array())); 
            
        }
        Yii::log("UserUpdate(). ".print_r($_REQUEST, true), 'info', 'system.web.CController');  
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:user_id';
        $criteria->params = array(':user_id'=>$_REQUEST['user_id']);
        
        $model = UserDetails::model();
        $user = $model->find($criteria);
        
        if($user !== null)
        {
            if( $user->user_name != "" ){
                
                 $criteria->condition = 'user_name=:user_name and user_id!=:user_id';
                 $criteria->params = array(':user_name'=>$_REQUEST['user_name'], ':user_id'=>$_REQUEST['user_id']);
                 
                $checkuser = $model->find($criteria);
                 
                if($checkuser != null){
                    
                     Yii::log('UserUpdate(). '.'Username already used',  'error', 'system.web.CController');  
                    $this->_sendResponse(401, array('message'=>'Username already used','rstatus'=>'0','errorcode'=>'104','data'=>array()));
                    
                }else{
                    
                    $model->user_id = $_REQUEST['user_id'];
                    $model->user_name = $_REQUEST['user_name'];
                }               
                 
            }
            
            if($user->password != "")
            {
                $model->user_id = $_REQUEST['user_id'];
                $model->password = md5($_REQUEST['user_password']);
                
            }
          //  var_dump($model);
            
            if($model->save())
            {
                 Yii::log('UserUpdate(). '.print_r($model, true), 'info', 'system.web.CController');  
                 $this->_sendResponse(200, $model );
            }else{
                
                 Yii::log('UserUpdate(). '.'User not update',  'error', 'system.web.CController');  
                 $this->_sendResponse(401, array('message'=>'User not update','rstatus'=>'1','errorcode'=>'111','data'=>''));
            }
           
        }       
        
    }
    
    
    public function actionQueUpdate(){
        
         Yii::log('QueUpdate(). ', 'info', 'system.web.CController');  
         
         if(!(isset($_REQUEST)) ){
             Yii::log("QueUpdate(). Request is empty", 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if( !isset($_REQUEST['user_id']) ){
            
             Yii::log('QueUpdate(). '.'User id is required ', 'error', 'system.web.CController');
            
             $this->_sendResponse(401, array('message'=>'User id is required ','rstatus'=>'0','errorcode'=>'109','data'=>array())); 
            
        }     
        Yii::log("QueUpdate(). ".print_r($_REQUEST, true), 'info', 'system.web.CController');
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:user_id';
        $criteria->params = array(':user_id'=>$_REQUEST['user_id']);
        
        $model = GameQue::model();
        $gameque = $model->find($criteria);
        
        if($gameque !== null){
            
                $gameque->que_time = date('Y-m-d h:i:s');//'NOW()'; 

                if($gameque->save()){
                      
                      Yii::log('QueUpdate(). '.'Success', 'info', 'system.web.CController');
                      $this->_sendResponse(200, 'Success' );
                }else{
                      Yii::log('QueUpdate(). '.'Can not update parameters', 'error', 'system.web.CController');
                      $this->_sendResponse(401, array('message'=>'Can not update parameters', 'rstatus'=>'0', 'errorcode'=>'', 'data'=>''));
                    
                }
            
        }else{
            Yii::log('QueUpdate(). '.'Not found any records', 'error', 'system.web.CController');
            $this->_sendResponse(401, array('message'=>'Not found any records', 'rstatus'=>'0', 'errorcode'=>'110', 'data'=>''));
              
        }
        
    }
    
    public function actionAddQue(){
        
         Yii::log('AddQue(). ', 'info', 'system.web.CController'); 
        
         if(!(isset($_REQUEST)) ){
           Yii::log('AddQue(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if(!isset($_REQUEST['user_id']) ){
            
            Yii::log('AddQue(). '.'User id is required', 'error', 'system.web.CController'); 
            $this->_sendResponse(401, array('message'=>'User id is required','rstatus'=>'0','errorcode'=>'109','data'=>array()));             
        }     
        
        Yii::log("AddQue(). ".print_r($_REQUEST, true), 'info', 'system.web.CController'); 
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:user_id';
        $criteria->params = array(':user_id'=>$_REQUEST['user_id']);
        //$model = GameQue::model();
        //$model->find($criteria);
        
        $gameque = new GameQue; 
        
        if($gameque->deleteAll($criteria))
        {
            $this->_sendResponse(200, 'Deleted success ' );
        }
        else {
            $gameque->user_id = $_REQUEST['user_id'];
            $gameque->que_status = 'Idle';
            $gameque->que_time = date('Y-m-d h:i:s');
            
            if($gameque->save())
            {
                Yii::log('AddQue(). '.'Success', 'info', 'system.web.CController'); 
                $this->_sendResponse(200, 'Success' );
            }else{
                Yii::log('AddQue(). '.print_r("Can't save parameters", true), 'error', 'system.web.CController'); 
                 $this->_sendResponse(401, array('message'=>sprintf("Can't save parameters"),'rstatus'=>'0','errorcode'=>'106','data'=>array())); 
            }
            
        }
    }
    
    public function actionUpdatePoints(){
        
        Yii::log('UpdatePoints(). ', 'info', 'system.web.CController'); 
        
         if(!(isset($_REQUEST)) ){
              Yii::log('UpdatePoints(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if( !isset($_REQUEST['user_id']) || !isset($_REQUEST['user_points']) ){
            
             Yii::log('UpdatePoints(). '.'Required information is missing', 'error', 'system.web.CController'); 
             $this->_sendResponse(401, array('message'=>'Required information is missing','rstatus'=>'0','errorcode'=>'100','data'=>array())); 
            
        }     
        Yii::log('UpdatePoints(). '.print_r($_REQUEST, true), 'info', 'system.web.CController'); 
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:user_id';
        $criteria->params = array(':user_id'=>$_REQUEST['user_id']);
        
        
        $model = UserDetails::model();
        $user = $model->find($criteria);
        
        if($user !== null){
            
            $user->user_points = $_REQUEST['user_points']; // date(d/m/Y h:i:s);
            
            if($user->save()){
                
                  Yii::log('UpdatePoints(). '.'Success', 'info', 'system.web.CController'); 
                  $this->_sendResponse(200, 'Success');
            }else{
                Yii::log('UpdatePoints(). '.print_r("Can't update user point", true), 'error', 'system.web.CController');
                $this->_sendResponse(401, array('message'=>sprintf("Can't update user point"), 'rstatus'=>'113', 'errorcode'=>'', 'data'=>''));
                 
            }
            
        }else{
            Yii::log('UpdatePoints(). '.'Not found any records', 'error', 'system.web.CController');
            $this->_sendResponse(401, array('message'=>'Not found any records', 'rstatus'=>'1', 'errorcode'=>'110', 'data'=>''));
             
        }
        
    }
   
    public function actionUpdateGameStatus(){
        
        Yii::log('UpdateGameStatus(). ', 'info', 'system.web.CController'); 
        
         if(!(isset($_REQUEST)) ){
             Yii::log('UpdateGameStatus(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if(!isset($_REQUEST['game_id'])){
             
             Yii::log('UpdateGameStatus(). '.'Game id is required', 'error', 'system.web.CController'); 
             $this->_sendResponse(401, array('message'=>'Game id is required','rstatus'=>'0','errorcode'=>'107','data'=>array())); 
            
        }    
        
        Yii::log('UpdateGameStatus(). '. print_r($_REQUEST, true), 'info', 'system.web.CController'); 
         
        $criteria = new CDbCriteria;
        $criteria->condition = 'game_id=:game_id';
        $criteria->params = array(':game_id'=>$_REQUEST['game_id']);
        
        
        $model = GameDetails::model();
        $game = $model->find($criteria);
        
        if($game !== null)
        {
            $game->game_status    = isset($_REQUEST['game_status'])? $_REQUEST['game_status']:$game->game_status;
            $game->game_round_one = $game->game_round_one + 1;
            $game->game_round_two = $game->game_round_two + 1;
            $game->game_time      = date('Y-m-d h:i:s');//'NOW()'; 
            
            if($game->save())
            {
                 Yii::log('UpdateGameStatus(). '.'Success', 'info', 'system.web.CController');
                 $this->_sendResponse(200, 'Success' );
            }else{
                Yii::log('UpdateGameStatus(). '. 'Not found any records', 'error', 'system.web.CController');
                $this->_sendResponse(401, array('message'=>'Not found any records','rstatus'=>'0','errorcode'=>'110','data'=>array())); 
                 
            }
        }else{
             Yii::log('UpdateGameStatus(). '. 'Game ID is missing', 'error', 'system.web.CController');
             $this->_sendResponse(401, array('message'=>sprintf("Game ID is missing"),'rstatus'=>'0','errorcode'=>'107','data'=>array())); 
        }
    }
    
    public function actionUpdateDynamite(){
        
         Yii::log('UpdateDynamite(). ', 'info', 'system.web.CController'); 
         
         if(!(isset($_REQUEST)) ){
             Yii::log('UpdateDynamite(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if(!isset($_REQUEST['user_id']) || !isset($_REQUEST['dynamite_number']) ){
            
             Yii::log('UpdateDynamite(). '.'Required information is missing', 'error', 'system.web.CController'); 
             $this->_sendResponse(401, array('message'=>'Required information is missing','rstatus'=>'0','errorcode'=>'100','data'=>array())); 
            
        }    
        Yii::log('UpdateDynamite(). '. print_r($_REQUEST, true), 'info', 'system.web.CController'); 
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:user_id';
        $criteria->params = array(':user_id'=>$_REQUEST['user_id']);        
        
        $model = UserDetails::model();
        $user = $model->find($criteria);
        
        if($user !== null){
            $user->dynamite_number = $_REQUEST['dynamite_number'];
            
            if($user->save())
            {
                 Yii::log('UpdateDynamite(). '. 'Success', 'info', 'system.web.CController'); 
                 $this->_sendResponse(200, 'Success');
            }else{
                
                Yii::log('UpdateDynamite(). '.'Not found any records', 'error', 'system.web.CController'); 
                $this->_sendResponse(401, array('message'=>'Not found any records','rstatus'=>'0','errorcode'=>'110','data'=>array())); 
                
            }
        }
    }
    
    
    
    public function actionUserAchievement(){
        
        Yii::log('UserAchievement(). ', 'info', 'system.web.CController'); 
        
        if(!(isset($_REQUEST)) ){
            Yii::log('UserAchievement(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if(!isset($_REQUEST['user_id'])){
            
             Yii::log('UserAchievement(). '.'User id is required', 'error', 'system.web.CController'); 
             $this->_sendResponse(401, array('message'=>'User id is required','rstatus'=>'0','errorcode'=>'109','data'=>array())); 
            
        }
        
        Yii::log('UserAchievement(). '. print_r($_REQUEST, true), 'info', 'system.web.CController'); 
        
        $criteria = new CDbCriteria;
        $criteria->select = 'achievements';
        $criteria->condition = 'user_id=:user_id';
        $criteria->params = array(':user_id'=>$_REQUEST['user_id']);
        
        $model = UserAchievements::model();
        $user_ach = $model->find($criteria);
       
        if($user_ach === null){
            
           Yii::log('UserAchievement(). '.'Not found any records', 'error', 'system.web.CController'); 
           $this->_sendResponse(401, array('message'=>'Not found any records', 'rstatus'=>'0', 'errorcode'=>'110', 'data'=> ''));
       } 
        $earnedAchArray = unserialize($user_ach->achievements);
        
        $array = array();
        if(!empty($earnedAchArray)){
            foreach($earnedAchArray as $val){
                $ach_model = AchievementDetails::model();
                $achievement = $ach_model->findByPk($val);
                if($achievement)
                {
                    array_push($array, $achievement);
                }
            }
            
            Yii::log('UserAchievement(). '. print_r($array, true), 'info', 'system.web.CController'); 
            $this->_sendResponse(200, $array );
            
        }else{
             Yii::log('UserAchievement(). '.'Not found any records', 'error', 'system.web.CController'); 
            $this->_sendResponse(401, array('message'=>'Not found any records','rstatus'=>'0','errorcode'=>'110','data'=>array())); 
        }             
        
    }
    
    public function actionDeleteGame(){
        
        Yii::log('DeleteGame(). ', 'info', 'system.web.CController'); 
        
         if(!(isset($_REQUEST)) ){
             Yii::log('DeleteGame(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if( !isset($_REQUEST['game_id']) ){
            
             Yii::log('DeleteGame(). '.'Game id is required', 'error', 'system.web.CController'); 
             $this->_sendResponse(401,array('message'=>'Game id is required','rstatus'=>'0','errorcode'=>'107','data'=>array())); 
        }
        
        Yii::log('DeleteGame(). '.print_r($_REQUEST, true), 'info', 'system.web.CController'); 
         
        $game_id = $_REQUEST['game_id'];
        
              
        $game = new GameDetails;
        
        if($game->deleteByPk($game_id))
        {        
            Yii::log('DeleteGame(). '.'Success', 'info', 'system.web.CController'); 
            $this->_sendResponse(200, 'Success');
        }else{
            
            Yii::log('DeleteGame(). '. print_r(" Couldn't Delete ID ", true), 'error', 'system.web.CController'); 
            $this->_sendResponse(401, array('message'=>sprintf("Couldn't Delete ID "), 'rstatus'=>'0', 'errorcode'=>'114', 'data'=>''));
        }        
    }
    
    public function actionDeleteQue(){
        
        Yii::log("DeleteQue(). ", 'info', 'system.web.CController'); 
        
         if(!(isset($_REQUEST)) ){
             
              Yii::log('DeleteQue(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if(!isset($_REQUEST['user_id']) ){
            
             Yii::log('DeleteQue(). '.print_r('User id is required', true), 'error', 'system.web.CController'); 
             $this->_sendResponse(401, array('message'=>'User id is required','rstatus'=>'0','errorcode'=>'109','data'=>array())); 
            
        }  
        Yii::log('DeleteQue(). '.print_r($_REQUEST, true), 'info', 'system.web.CController'); 
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:user_id';
        $criteria->params = array(':user_id'=>$_REQUEST['user_id']); 
        
        $gameque = new GameQue;
        
        if($gameque->deleteAll($criteria))
        {
            Yii::log("DeleteQue(). ".'Success', 'info', 'system.web.CController'); 
            $this->_sendResponse(200, 'Success' );
        }else{
            
            Yii::log('DeleteQue(). '.'User not exists in que ', 'error', 'system.web.CController'); 
            $this->_sendResponse(401, array('message'=>sprintf('User not exists in que '),'rstatus'=>'0','errorcode'=>'115','data'=>array())); 
           
        }
    }
    
    public function actionEndGame(){
        
        Yii::log('EndGame(). ', 'info', 'system.web.CController'); 
        
         if(!(isset($_REQUEST)) ){
            Yii::log('EndGame(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if( !isset($_REQUEST['game_id']) ){
            
             Yii::log('EndGame(). '.'Game id is required', 'error', 'system.web.CController'); 
             $this->_sendResponse(401, array('message'=>'Game id is required','rstatus'=>'0','errorcode'=>'107','data'=>array()));             
        }  
        Yii::log('EndGame(). '.print_r($_REQUEST, true), 'info', 'system.web.CController'); 
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'game_id=:game_id';
        $criteria->params = array(':game_id'=>$_REQUEST['game_id']); 
        
        $game = GameDetails::model();
        
        if($game->deleteAll($criteria))
        {
             $bucketName = "actingout-store001";
             $uri = 'videos/game'.$_REQUEST['game_id'].'.mov'; //videos/game1.mov
            
             /* Delete object */
             $deletefile = Yii::app()->s3->deleteObject($bucketName, $uri );
             
           if($deletefile)
           {
               Yii::log('EndGame(). '.'Success', 'info', 'system.web.CController'); 
               $this->_sendResponse(200, 'Success' );
           }else{
               
               Yii::log('EndGame(). '.print_f("Couldn't delete $uri file"), 'error', 'system.web.CController');
               $this->_sendResponse(401, array('message'=>sprintf("Couldn't delete %s file", $uri),'rstatus'=>'0','errorcode'=>'115','data'=>array())); 
           }            
            
           // $this->_sendResponse(200, 'Success' );
        }else{
            
            Yii::log('EndGame(). '.'User not exists in que', 'error', 'system.web.CController');
            $this->_sendResponse(401, array('message'=>sprintf("User not exists in que "),'rstatus'=>'0','errorcode'=>'115','data'=>array()));            
        }
        
        
    }
    
    public function actionForgotPassword(){
        
        Yii::log('ForgotPassword(). ', 'info', 'system.web.CController'); 
         
        if(!(isset($_REQUEST)) ){
            Yii::log('ForgotPassword(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if(!isset($_REQUEST['user_email']) ){
            
             Yii::log('ForgotPassword(). '.'Required information is missing', 'error', 'system.web.CController');
             $this->_sendResponse(401, array('message'=>'Required information is missing','rstatus'=>'0','errorcode'=>'100','data'=>array()));             
        }  
        Yii::log('ForgotPassword(). '.print_r($_REQUEST, true), 'info', 'system.web.CController'); 
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_email=:user_email';
        $criteria->params = array(':user_email'=>$_REQUEST['user_email']); 
        
        $model = UserDetails::model();
        $user = $model->find($criteria);
        if($user !== null)
        {
           // $email = new YiiMailMessage();
            
            $msg = '<table width="80%">
					
                        <tr>
                                <td colspan="2" align="left">
                                    <p>Hi,<br><br>
                                            Here is your login information:
                                    </p>
                                    <p>
                                            Username - '.$user->user_name.'<br>
                                            Email - '.$user->user_email.'<br>
                                            Password - '.$user->password.'
                                    </p>

                                    <p> Thanks for Acting Out! </p>
                                    <p> The Acting Out Team<br></p>
                                </td>
                        </tr>
                </table>';
				
                $subject = "Acting Out: Login Information";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: Acting Out  <admin@no-reply.com>' . "\r\n";
                $to = $_REQUEST['user_email'];
                
               if(mail($to, $subject, $msg, $headers))
               {
                     Yii::log('ForgotPassword(). '.'Success', 'info', 'system.web.CController'); 
                     $this->_sendResponse(200, 'Success');
               }
		
        }else{
            
             Yii::log('ForgotPassword(). '.'User not found', 'error', 'system.web.CController'); 
             $this->_sendResponse(401, array('message'=>sprintf("User not found "), 'rstatus'=>'0', 'errorcode'=>'116', 'data'=>''));
        }
        
    }
    
    public function actionSave(){
        
        Yii::log('Save(). ', 'info', 'system.web.CController'); 
        
        if (isset($_FILES["file"]["name"]))
        {         
                  Yii::log("Save(). ".print_r($_FILES, true), 'info', 'system.web.CController'); 
                  
            
                  $fileName = 'videos/'.$_FILES["file"]["name"];
                    
                  $filetmp = $_FILES["file"]["tmp_name"];
                 
                  $bucketName = "actingout-store001";
                  
                   // upload the original version
                    $success = Yii::app()->s3->upload( $filetmp , $fileName, $bucketName );
                    
                                     
                    if($success){ 
                       
                       $furl = "http://".$bucketName.".s3.amazonaws.com/".$fileName;
                       
                       Yii::log('Save(). '.print_r($furl, true), 'info', 'system.web.CController'); 
                       
                       $this->_sendResponse(200, array('message'=>'','rstatus'=>'1','errorcode'=>'','data'=>$furl));
                       
                    } else{
                       
                        Yii::log('Save(). '.'File is not uploded ', 'error', 'system.web.CController'); 
                        $this->_sendResponse(401, array('message'=>'File is not uploded','rstatus'=>'0','errorcode'=>'117','data'=>array())); 
                    }
                             
        }else{
            
             Yii::log('Save(). '.'Can not file ', 'error', 'system.web.CController'); 
             $this->_sendResponse(401, array('message'=>'Can not file','rstatus'=>'0','errorcode'=>'117','data'=>array())); 
           
        }
        
    }
    
    
    
    public function actionGameSearch(){
        
        Yii::log("GameSearch(). ", 'info', 'system.web.CController'); 
        
        if(!(isset($_REQUEST)) ){
             Yii::log('GameSearch(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if(!isset($_REQUEST['user_id'])){
             
             Yii::log('GameSearch(). '.'User id is required', 'error', 'system.web.CController');
             $this->_sendResponse(401, array('message'=>'User id is required','rstatus'=>'0','errorcode'=>'109','data'=>array()));             
        }  
        
        Yii::log('GameSearch(). '. print_r($_REQUEST, true), 'info', 'system.web.CController');
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'userone_id=:user_id OR usertwo_id=:user_id';
        $criteria->params = array(':user_id'=>$_REQUEST['user_id']); 
        
        $model = GameDetails::model();
        $user = $model->findAll($criteria);
        
        if($user)
        {
           
            $array = array();
            foreach ($user as $value){              
                array_push($array, $value);
            }
            
            Yii::log('GameSearch(). '. print_r($array, true), 'info', 'system.web.CController');
            $this->_sendResponse(200, $array);
        }else{
            
             Yii::log('GameSearch(). '.'Not found any records', 'error', 'system.web.CController');
             $this->_sendResponse(401, array('message'=>'Not found any records','rstatus'=>'0','errorcode'=>'110','data'=>array())); 
            
        }        
        
    }
    
    
    public function actionSearchQue(){
        
         Yii::log('SearchQue(). ', 'info', 'system.web.CController'); 
         
        if(!(isset($_REQUEST)) ){
             Yii::log('SearchQue(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        
         if(!isset($_REQUEST['user_id'])){
             
             Yii::log('SearchQue(). '.'User id is required', 'error', 'system.web.CController');
             $this->_sendResponse(401, array('message'=>'User id is required','rstatus'=>'0','errorcode'=>'109','data'=>array()));   
        }
        
        Yii::log('SearchQue(). '. print_r($_REQUEST, true), 'info', 'system.web.CController'); 
        
        $model = UserDetails::model();
        
        
         if(!empty($_REQUEST['user_email']) ){    
               
             $sql= "SELECT u.* FROM `user_details` u,`game_que` q WHERE u.user_email = '".$_REQUEST['user_email']."' AND u.user_id = q.user_id AND u.user_id != '".$_REQUEST['user_id']."'";
               
         }elseif( !empty($_REQUEST['user_name']) )
         {
             $sql = "SELECT u.* FROM `user_details`u,`game_que`q WHERE u.user_name = '".$_REQUEST['user_name']."' AND u.user_id = q.user_id AND u.user_id != '".$_REQUEST['user_id']."'";        
             
         }
         //echo $sql;
          $users = $model->findBySql($sql);
          if($users !== null)
          {
              Yii::log('SearchQue(). '. print_r($users, true), 'info', 'system.web.CController'); 
               $this->_sendResponse(200, $users);
          }else{
              
              Yii::log('SearchQue(). '. ' Not found any records', 'error', 'system.web.CController'); 
              $this->_sendResponse(401, array('message'=>' Not found any records','rstatus'=>'0','errorcode'=>'110','data'=>array())); 
          }
        
    }
    
    public function actionUsersGames(){
        
         Yii::log('UsersGames(). ', 'info', 'system.web.CController'); 
        
        if(!(isset($_REQUEST)) ){
             Yii::log('UsersGames(). Request is empty', 'error', 'system.web.CController');
           $this->_sendResponse(401);
        }
        if(!isset($_REQUEST['user_id'])){
            
             Yii::log('UsersGames(). '.'User id is required', 'error', 'system.web.CController');
             
             $this->_sendResponse(401, array('message'=>'User id is required','rstatus'=>'0','errorcode'=>'109','data'=>array()));             
        }  
        
        Yii::log('UsersGames(). '.print_r($_REQUEST, true), 'info', 'system.web.CController'); 
         
        $criteria = new CDbCriteria;
        $criteria->select = '*, UNIX_TIMESTAMP(game_time) as game_time';
        $criteria->condition = 'userone_id=:user_id OR usertwo_id=:user_id';
        $criteria->params = array(':user_id'=>$_REQUEST['user_id']); 
        
        $model = GameDetails::model();
        $users = $model->findAll($criteria);
        
        if($users)
        {
            $array = array();
            
           
            foreach ($users as $user){
                
                $user->game_time = $this->timeago($user->game_time);
               
                //$user->game_time = $this->timeago($time);
                array_push($array, $user);
            }
            
            Yii::log('UsersGames(). '.print_r($array, true), 'info', 'system.web.CController');
            
            $this->_sendResponse(200, $array);
        }else{
            
            Yii::log('UsersGames(). '.'Not found any records', 'error', 'system.web.CController');
            
            $this->_sendResponse(401, array('message'=>'Not found any records','rstatus'=>'0','errorcode'=>'110','data'=>array())); 
        }
    }
       

    
    

    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
    {
            $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
            header('Content-type: ' . $content_type);

            echo CJSON::encode($body);
            Yii::app()->end();
    }
    
    
    private function _getStatusCodeMessage($status)
      {
              $codes = Array(
                      200 => 'OK',
                      400 => 'Bad Request',
                      401 => 'Unauthorized',
                      402 => 'Payment Required',
                      403 => 'Forbidden',
                      404 => 'Not Found',
                      500 => 'Internal Server Error',
                      501 => 'Not Implemented',
              );
              return (isset($codes[$status])) ? $codes[$status] : '';
      }
      
      
      
    private function timeago($time)  
    {  

	$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");  
	$lengths = array("60","60","24","7","4.35","12","10");  
	  
	$now = time();  
	
	  
	$difference     = $now - $time;  
	$tense         = "ago";  
	  
	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++)   
        {  
            $difference /= $lengths[$j];  
        }  
	  
	$difference = round($difference);  
	  
	if($difference != 1)   
        {  
            $periods[$j].= "s";  
        }  
	  
	return "$difference $periods[$j] $tense";  
    } 

    
    
   private function getAchiements(){
           
        $status          = isset($_REQUEST['status']) ? $_REQUEST['status']: '';
        $game_category   = isset($_REQUEST['game_category']) ? $_REQUEST['game_category']: '';
        
       $usermodel = UserAchievements::model();
       
       $criteria = new CDbCriteria;       
       $criteria->condition = 'user_id=:user_id';
       $criteria->params = array(':user_id'=>$_REQUEST['user_id']); 
       
       $ashUser = $usermodel->find($criteria);
       
       $earnedAchArray =  unserialize($ashUser->achievements);
       $categories_guess  = unserialize($ashUser->categories_guess);
       $categories_act  = unserialize($ashUser->categories_act);
       
       $newlyadded = array();
       
       $achmodel = AchievementDetails::model();
       $achDetails = $achmodel->findAll();
       
       foreach ($achDetails as $details)
       {
           if($details->category == 'Any' &&  $details->applies_for == $status )
           {
               if($details->in_row == 'No' && $details->ach_con <= $ashUser->guess )
               {
                    if(!in_array($details->ach_id, $earnedAchArray)){
                             array_push($earnedAchArray, $details->ach_id);
                             array_push($newlyadded, $details->ach_id);
                     }
               }
                
                if($details->in_row =='Yes' && $details->ach_con <= $ashUser->in_a_row)
                {
                         if(!in_array($details->ach_id, $earnedAchArray)){
                                 array_push($earnedAchArray, $details->ach_id);
                                 array_push($newlyadded, $details->ach_id);
                         }
                }
           }
           
           if($details->category == $game_category && $details->applies_for == $status ){ 
                    
                    if($details->ach_con <= $categories_guess[$details->category] )
                    {
                             if(!in_array($funcraw['ach_id'],$earnedAchArray)){
                                     array_push($earnedAchArray,$funcraw['ach_id']);
                                     array_push($newlyadded,$funcraw['ach_id']);
                             }
                    }
                     
                     if( $details->ach_con <= $categories_act[$details->category])
                     {
				if(!in_array($details->ach_id, $earnedAchArray)){
					array_push($earnedAchArray, $details->ach_id);
					array_push($newlyadded, $details->ach_id);
				}
                    }
           
           }
               
       }  
		
        return array($earnedAchArray, $newlyadded);
    }  
   
}
?>
