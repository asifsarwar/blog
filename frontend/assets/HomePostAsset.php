<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class HomePostAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap.min.css',
        'css/clean-blog.min.css',
        'css/font-awesome.min.css',
        

    ];
    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.min.js',
        'js/jqBootstrapValidation.js',
        'js/contact_me.js',
        'js/clean-blog.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
