<?php
use yii\helpers\Html;
?>
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php?r=post/index">Fantastic Blog Portal</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php?r=post/index">Home</a>
                    </li>
                    <li>
                        <a href="index.php?r=site/about">About</a>
                    </li>
                    <?php
                        if (Yii::$app->user->isGuest) {
                         Html::a('SignUp', ['signup']);
                         Html::a('Login', ['login']);
                         }else{
                            Html::a('Logout('.Yii::$app->user->identity->username.')', ['logout']);
                         }
                    ?>         
                        
                    <li>
                        <a href="index.php?r=site/contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>