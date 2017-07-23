<?php
namespace yiichina\adminlte;

use yii\bootstrap\Html;

class NavBar extends \yii\bootstrap\NavBar
{
    public $items = [];

    public $navOptions = [];
    
    public $brandLabelSm = false;
    
    public function init()
    {
        echo Html::beginTag("header", ["class"=>"main-header"]);
        echo $this->renderBrand();
        if (empty($this->options['class'])) {
            Html::addCssClass($this->options, ['navbar', 'navbar-static-top']);
        }
        if (empty($this->options['role'])) {
            $this->options['role'] = 'navigation';
        }
        echo Html::beginTag("nav", $this->options);
        echo $this->renderToggleButton();
        echo Html::beginTag("div", ["class"=>"navbar-custom-menu"]);
        if ($this->items) {
            echo $this->renderItems();
        }
    }
    
    public function run()
    {
        echo Html::endTag("div");
        echo Html::endTag("nav");
        echo Html::endTag("header");
    }
    
    protected function renderBrand()
    {
        if ($this->brandLabel === false) {
            return null;
        }
        $label = '';
        $label .= Html::tag("span",$this->brandLabel, ["class" => "logo-lg"]);
        $label .= Html::tag("span",$this->brandLabelSm, ["class" => "logo-sm"]);
        return Html::a($label, $this->brandUrl, ["class" => "logo"]);
    }
    
    protected function renderToggleButton()
    {
        return Html::tag("a",
            Html::tag("span", "Toggle navigation", ["class"=>"sr-only"]),
            [
                "href" => "#",
                "class" => "sidebar-toggle",
                "data-toggle" => "offcanvas",
                "role" => "button"
            ]
        );
    }
    
    protected function renderItems()
    {
        Html::addCssClass($this->navOptions, "navbar-nav");
        return Nav::widget([
            'items' => $this->items,
            'options' => $this->navOptions,
            'activateParents' => true,
        ]);
    }
}
