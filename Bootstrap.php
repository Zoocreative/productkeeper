<?php

namespace mightyzoo\productkeeper;

use Yii;
use yii\base\BootstrapInterface;
use yii\console\Application as ConsoleApplication;
use yii\i18n\PhpMessageSource;
use yii\web\GroupUrlRule;

/**
 * Bootstrap class registers module and user application component. It also creates some url rules which will be applied
 * when UrlManager.enablePrettyUrl is enabled.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Bootstrap implements BootstrapInterface
{
    /** @var array Model's map */
    private $_modelMap = [
        
    ];

    /** @inheritdoc */
    public function bootstrap($app)
    {
        /** @var Module $module */
        /** @var \yii\db\ActiveRecord $modelName */
        if ($app->hasModule('products') && ($module = $app->getModule('products')) instanceof Module) {
            $this->_modelMap = array_merge($this->_modelMap, $module->modelMap);
            foreach ($this->_modelMap as $name => $definition) {
                $class = "mightyzoo\\productkeeper\\models\\" . $name;
                Yii::$container->set($class, $definition);
                $modelName = is_array($definition) ? $definition['class'] : $definition;
                $module->modelMap[$name] = $modelName;
            }

            $configUrlRule = [
                'prefix' => $module->urlPrefix,
                'rules'  => $module->urlRules,
            ];

            if ($module->urlPrefix != 'products') {
                $configUrlRule['routePrefix'] = 'products';
            }

            $app->urlManager->addRules([new GroupUrlRule($configUrlRule)], false);


            if (!isset($app->get('i18n')->translations['user*'])) {
                $app->get('i18n')->translations['user*'] = [
                    'class'    => PhpMessageSource::className(),
                    'basePath' => __DIR__ . '/messages',
                ];
            }

        }
    }
}
