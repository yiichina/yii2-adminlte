<?php
namespace yiichina\adminlte;

use Yii;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
use yii\bootstrap\BootstrapPluginAsset;

class MainHeader extends \yii\bootstrap\NavBar
{
    public $brandLabelMini = false;
    
    /**
     * Initializes the widget.
     */
    public function init()
    {
        $this->clientOptions = false;
        echo Html::beginTag('header', ['class' => 'main-header']);

        if ($this->brandLabel !== false) {
            Html::addCssClass($this->brandOptions, ['widget' => 'logo']);
            echo Html::a(Html::tag('span', $this->brandLabelMini ?: $this->brandLabel, ['class' => 'logo-mini']) . Html::tag('span', $this->brandLabel, ['class' => 'logo-lg']), $this->brandUrl === false ? Yii::$app->homeUrl : $this->brandUrl, $this->brandOptions);
        }

        $options = $this->options;
        if (empty($options['class'])) {
            Html::addCssClass($options, ['navbar', 'navbar-static-top']);
        }
        $tag = ArrayHelper::remove($options, 'tag', 'nav');
        echo Html::beginTag($tag, $options);
        echo $this->renderToggleButton();
        echo Html::beginTag('div', ['class' => 'navbar-custom-menu']);
    }
    
    public function run()
    {
        echo Html::endTag('div');
        $tag = ArrayHelper::remove($this->options, 'tag', 'nav');
        echo Html::endTag($tag);
        echo Html::endTag('header');
        BootstrapPluginAsset::register($this->getView());
    }
    
    protected function renderToggleButton()
    {
        $bar = Html::tag('span', '', ['class' => 'icon-bar']);
        $screenReader = "<span class=\"sr-only\">{$this->screenReaderToggleText}</span>";

        return Html::a(Html::tag('span', 'Toggle navigation', ['class' => 'sr-only']), '#', [
            'class' => 'sidebar-toggle',
            "data-toggle" => "offcanvas",
            //'data-toggle' => 'push-menu',
            'role' => 'button',
        ]);
    }
}
