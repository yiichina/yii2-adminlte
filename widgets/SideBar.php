<?php
namespace yiichina\adminlte\widgets;

use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
use yii\helpers\Url;

class Sidebar extends \yii\widgets\Menu
{
	public $defaultRight = false;

	public $labelTemplate = '{icon}{label}';

	public $linkTemplate = '<a href="{url}">{icon}{label}{right}</a>';

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
                $class[] = 'treeview';
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

	/**
     * Renders the content of a menu item.
     * Note that the container and the sub-menus are not rendered here.
     * @param array $item the menu item to be rendered. Please refer to [[items]] to see what data might be in the item.
     * @return string the rendering result
     */
    protected function renderItem($item)
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            return strtr($template, [
                '{url}' => Url::to($item['url']),
                '{label}' => Html::tag('span', $item['label']),
				'{icon}' => $item['icon'] ?? null,
				'{right}' => empty($item['items']) ? null : Html::tag('span', ArrayHelper::getValue($item, 'right', $this->defaultRight), ['class' => 'pull-right-container']),
            ]);
        } else {
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

            return strtr($template, [
                '{label}' => $item['label'],
				'{icon}' => $item['icon'] ?? null,
            ]);
        }
    }
}
