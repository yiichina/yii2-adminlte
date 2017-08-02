<?php

namespace yiichina\adminlte\assets;

use yii\web\AssetBundle;

/**
 * This is just an example.
 */
class AdminlteAsset extends AssetBundle
{
    public $sourcePath = '@bower/adminlte/dist';
    public $css = [
        'css/AdminLTE.min.css',
        'css/skins/skin-blue.min.css',
    ];
    public $js = [
        'js/app.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
