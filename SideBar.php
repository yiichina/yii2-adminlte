<?php
namespace yiichina\adminlte;

use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
use yii\helpers\Url;

class Sidebar extends \yii\widgets\Menu
{
    public $submenuTemplate = "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n";
    
    public $options = ['class' => 'sidebar-menu tree', 'data' => ['widget' => 'tree']];
    
    public function init()
    {
        echo Html::beginTag('aside', ['class' => 'main-sidebar']);
        echo Html::beginTag('section', ['class' => 'sidebar']);
    }

    public function run()
    {
        parent::run();
        echo Html::endTag('section');
        echo Html::endTag('aside');
    }
    
    protected function renderItems($items)
    {
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }

            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $options['class'] = 'treeview';
                $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
                $menu .= strtr($submenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
            }
            Html::addCssClass($options, $class);
            $lines[] = Html::tag($tag, $menu, $options);
        }

        return implode("\n", $lines);
    }
}
