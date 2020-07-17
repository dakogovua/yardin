<?php
/**
 * Created by PhpStorm.
 * User: ggg
 * Date: 18.12.2018
 * Time: 11:21
 */

namespace app\assets;


use yii\web\AssetBundle;

class TravelAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/materialize.css',
        //'css/style.css',
        //'css/site.css',
         '/vue/test/css/style.css',
    ];
    public $js = [
       // 'js/main.js',
       '/vue/test/dist/build.js',

    ];
    public $depends = [

       //'yii\web\YiiAsset',
       // 'yii\bootstrap\BootstrapAsset',
       // 'yii\bootstrap\BootstrapPluginAsset',
       // 'yii\web\JqueryAsset' 
    ];
}