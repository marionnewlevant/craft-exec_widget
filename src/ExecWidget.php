<?php
/**
 * Exec Widget plugin for Craft CMS 3.x
 *
 * Widgets which run Tasks that call exec(...)
 *
 * @link      http://marion.newlevant.com
 * @copyright Copyright (c) 2018 Marion Newlevant
 */

namespace marionnewlevant\execwidget;

use marionnewlevant\execwidget\services\ExecWidgetService as ExecWidgetServiceService;
use marionnewlevant\execwidget\variables\ExecWidgetVariable;
use marionnewlevant\execwidget\widgets\ExecWidgetWidget as ExecWidgetWidget;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\UrlManager;
use craft\web\twig\variables\CraftVariable;
use craft\services\Dashboard;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Class ExecWidget
 *
 * @author    Marion Newlevant
 * @package   ExecWidget
 * @since     1.0.0
 *
 * @property  ExecWidgetServiceService $execWidgetService
 */
class ExecWidget extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var ExecWidget
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Dashboard::class,
            Dashboard::EVENT_REGISTER_WIDGET_TYPES,
            function (RegisterComponentTypesEvent $event) {
                // only register the widget if we have commands for it
                $commands = ExecWidget::$plugin->execWidgetService->commands();
                if ($commands)
                {
                    $event->types[] = ExecWidgetWidget::class;
                }
            }
        );

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('execWidget', ExecWidgetVariable::class);
            }
        );

        Craft::info(
            Craft::t(
                'exec-widget',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
