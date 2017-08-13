<?php
namespace yiichina\adminlte;

use Yii;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
use yii\bootstrap\BootstrapPluginAsset;

class NavBar extends \yii\bootstrap\NavBar
{
    public $customMenu = false;
    /**
     * Renders the widget.
     */
    public function run()
    {
        $tag = ArrayHelper::remove($this->containerOptions, 'tag', 'div');
        echo Html::endTag($tag);
        if ($this->customMenu !== false) {
            echo Html::tag('div', $this->customMenu, ['class' => 'navbar-custom-menu']);
        }
        if ($this->renderInnerContainer) {
            echo Html::endTag('div');
        }
        $tag = ArrayHelper::remove($this->options, 'tag', 'nav');
        echo Html::endTag($tag);
        BootstrapPluginAsset::register($this->getView());
    }

    /**
     * Renders collapsible toggle button.
     * @return string the rendering toggle button.
     */
    protected function renderToggleButton()
    {
        return Html::button("{$this->screenReaderToggleText}", [
            'class' => 'navbar-toggle collapsed',
            'data-toggle' => 'collapse',
            'data-target' => "#{$this->containerOptions['id']}",
        ]);
    }
}
