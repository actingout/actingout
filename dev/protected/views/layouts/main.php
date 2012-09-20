<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app() -> request -> baseUrl;?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app() -> request -> baseUrl;?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app() -> request -> baseUrl;?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        <?php Yii::app() -> clientScript -> registerCoreScript('jquery');?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app() -> request -> baseUrl;?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app() -> request -> baseUrl;?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app() -> request -> baseUrl;?>/css/style.css" />
       

        <title><?php echo CHtml::encode($this -> pageTitle);?></title>
    </head>

    <body class="bg_c bg_c sidebar fixed" onload="viewPage()">
        <div id="top_bar">
            <div class="wrapper cf">
                <ul class="fl">
                    <li class="sep"> <?php if (!Yii::app() -> user -> isGuest) echo CHtml::link('Logout (' . Yii::app() -> user -> name . ')' , array ('/site/logout'));?></li>
                </ul>
            </div>
        </div>
        <div id="header">
            <div class="wrapper cf">
                <div id="logo" style="border:1px solid #ccc; height: 76px"><h2>Acting Out</h2><?php // echo CHtml::image(Yii::app() -> request -> baseUrl . '/images/Logo_Green.png' ,null , array ('height' => '76px' , 'width'  => '200px')); ?></div>
                <ul class="fr cf" id="main_nav">
                  
                         <li class="nav_item active lgutipB" title="admins"><?php echo CHtml::link('<img class="img_holder" style="background-image: url(' . Yii::app() -> request -> baseUrl . '/images/Employees.png)" alt="" src="' . Yii::app() -> request -> baseUrl . '/images/blank.gif"/><span>Administrators</span>' , array ('/admins/admin') , array ('class' => 'main_link'));?></a><img id="admins_link" style="display:none" class="tick tick_a" alt="" src="<?php echo Yii::app() -> request -> baseUrl . '/images/blank.gif';?>"/></li>
                         <li class="nav_item active lgutipB" title="User details"><?php echo CHtml::link('<img class="img_holder" style="background-image: url(' . Yii::app() -> request -> baseUrl . '/images/dashboard-3.png)" alt="" src="' . Yii::app() -> request -> baseUrl . '/images/blank.gif"/><span>User details</span>' , array ('/userdetails/admin') , array ('class' => 'main_link'));?></a><img id="userdetails_link" style="display:none" class="tick tick_a" alt="" src="<?php echo Yii::app() -> request -> baseUrl . '/images/blank.gif';?>"/></li>
                         <li class="nav_item active lgutipB" title="Achievement"><?php echo CHtml::link('<img class="img_holder" style="background-image: url(' . Yii::app() -> request -> baseUrl . '/images/Adviser.png)" alt="" src="' . Yii::app() -> request -> baseUrl . '/images/blank.gif"/><span>Achievement</span>' , array ('/achievementdetails/admin') , array ('class' => 'main_link'));?></a><img id="achievementdetails_link" style="display:none" class="tick tick_a" alt="" src="<?php echo Yii::app() -> request -> baseUrl . '/images/blank.gif';?>"/></li>
                    
                         <li class="nav_item active lgutipB" title="Game details"><?php echo CHtml::link('<img class="img_holder" style="background-image: url(' . Yii::app() -> request -> baseUrl . '/images/plans-2.png)" alt="" src="' . Yii::app() -> request -> baseUrl . '/images/blank.gif"/><span>Game details</span>' , array ('/gamedetails/admin') , array ('class' => 'main_link'));?></a><img id="gamedetails_link" style="display:none" class="tick tick_a" alt="" src="<?php echo Yii::app() -> request -> baseUrl . '/images/blank.gif';?>"/></li>
                         <li class="nav_item active lgutipB" title="Game que"><?php echo CHtml::link('<img class="img_holder" style="background-image: url(' . Yii::app() -> request -> baseUrl . '/images/plans-2.png)" alt="" src="' . Yii::app() -> request -> baseUrl . '/images/blank.gif"/><span>Game que</span>' , array ('/gameque/admin') , array ('class' => 'main_link'));?></a><img id="gameque_link" style="display:none" class="tick tick_a" alt="" src="<?php echo Yii::app() -> request -> baseUrl . '/images/blank.gif';?>"/></li>    
                </ul>
            </div>
        </div><!-- header -->

        <div class="container cf brdrrad_a" id="main_section">

            <div id="mainmenu">

            </div><!-- mainmenu -->

            <?php

             $this -> widget('zii.widgets.CBreadcrumbs' , array (
                       'links' => $this -> breadcrumbs ,
             ));

            ?><!-- breadcrumbs -->

<?php echo $content;?>

        </div><!-- page -->
        <div id="footer">
            Copyright &copy; <?php echo date('Y');?> by Acting Out.<br/>
            All Rights Reserved.<br/>
        </div><!-- footer -->
    </body>
</html>
