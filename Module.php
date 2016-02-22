<?php
namespace mightyzoo\productkeeper;

class Module extends \yii\base\Module
{

	/** @var array The rules to be used in URL management. */
    public $urlRules = [
        '<id:\d+>' => 'default/update',
    ];

    public function init()
    {
        parent::init();

    }
}