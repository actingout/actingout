<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app() -> request -> baseUrl;?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app() -> request -> baseUrl;?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app() -> request -> baseUrl;?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app() -> request -> baseUrl;?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app() -> request -> baseUrl;?>/css/userX.css" />

        <title><?php echo CHtml::encode($this -> pageTitle);?></title>
        <script>
            function viewPage() {
                var path = window.location.pathname;
                var controller = path.split("/");
             
                document.getElementById(controller[2]+"_tab").className = "current";
            }
            function changeStyle(id){
                if(id == 'login_tab'){
                    $("#search_tab").removeClass('current');
                    $("#LoginForm_manage_accounts").val('0');
                }
                if(id == 'search_tab'){
                     $("#login_tab").removeClass('current');
                     $("#LoginForm_manage_accounts").val('1');
                }
                document.getElementById(id).className = "current";
            }
        </script>
    </head>

    <body class="bg_c" onload="viewPage()">


        <div class="login_wrapper">
            <div class="loginBox">
                <div class="heading cf">
                    <ul class="login_tabs fr cf">
                        <li><?php echo CHtml::link("Manage Accounts" , Yii::app() -> createUrl('#') , array ('id' => 'login_tab','onclick'=>'changeStyle("login_tab");return false;'))?></li>
                        
                        <li style="display:none"><a href="#password">Forgoten password</a></li>
                    </ul>
                    <div style="height: 66px;padding-top: 10px"><h2>Acting Out</h2> <?php //echo CHtml::image(Yii::app() -> request -> baseUrl . '/images/Logo11.png' , null , array ('height' => '53px' , 'width'  => '139px'));?></div>
                </div>
                <div class="content">
                    <div class="login_panes formEl_a">
                        <div>
<?php echo $content;?>
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </body>
</html>