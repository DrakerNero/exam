<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FrontendAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'magnific/magnific-popup.css',
        'css/style.css',
        'css/style_2.css',
    ];
    public $js = [
        'js/app.js',
        'js/exam.js',
        'js/exam2.js',
        'magnific/jquery.magnific-popup.min.js',
//        'js/jquery-2.1.3.js',
//        'js/jquery-3.2.1.min.js',
       
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'common\assets\AdminLte',
        'common\assets\Html5shiv',
    ];

}
