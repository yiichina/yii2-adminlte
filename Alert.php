<?php
namespace yiichina\adminlte;

use Yii;

class Alert extends \yii\bootstrap\Widget
{
    public $alertTypes = [
        'error' => [
            'class' => 'alert-danger',
            'icon' => '<i class="icon fa fa-ban"></i>',
        ],
        'danger' => [
            'class' => 'alert-danger',
            'icon' => '<i class="icon fa fa-ban"></i>',
        ],
        'success' => [
            'class' => 'alert-success',
            'icon' => '<i class="icon fa fa-check"></i>',
        ],
        'info' => [
            'class' => 'alert-info',
            'icon' => '<i class="icon fa fa-info"></i>',
        ],
        'warning' => [
            'class' => 'alert-warning',
            'icon' => '<i class="icon fa fa-warning"></i>',
        ],
    ];

    public $closeButton = [];


    public function init()
    {
        parent::init();

        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $appendCss = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        foreach ($flashes as $type => $data) {
            if (isset($this->alertTypes[$type])) {
                $data = (array) $data;
                foreach ($data as $i => $message) {
                    /* initialize css class for each alert box */
                    $this->options['class'] = $this->alertTypes[$type]['class'] . $appendCss;

                    /* assign unique id to each alert box */
                    $this->options['id'] = $this->getId() . '-' . $type . '-' . $i;

                    echo \yii\bootstrap\Alert::widget([
                        'body' => $this->alertTypes[$type]['icon'] . $message,
                        'closeButton' => $this->closeButton,
                        'options' => $this->options,
                    ]);
                }

                $session->removeFlash($type);
            }
        }
    }
}


