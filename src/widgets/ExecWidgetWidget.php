<?php
/**
 * Exec Widget plugin for Craft CMS 3.x
 *
 * Widgets which run Tasks that call exec(...)
 *
 * @link      http://marion.newlevant.com
 * @copyright Copyright (c) 2018 Marion Newlevant
 */

namespace marionnewlevant\execwidget\widgets;

use marionnewlevant\execwidget\ExecWidget;

use Craft;
use craft\base\Widget;

/**
 * Exec Widget Widget
 *
 * @author    Marion Newlevant
 * @package   ExecWidget
 * @since     1.0.0
 */
class ExecWidgetWidget extends Widget
{

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $message;
    public $command;

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('exec-widget', 'ExecWidget');
    }

    /**
     * @inheritdoc
     */
    public static function iconPath()
    {
        return Craft::getAlias("@marionnewlevant/execwidget/assetbundles/execwidget/dist/img/ExecWidgetWidget-icon.svg");
    }

    /**
     * @inheritdoc
     */
    public static function maxColspan()
    {
        return null;
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules = array_merge(
            $rules,
            [
                [['message', 'command'], 'string'],
            ]
        );
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate(
            'exec-widget/_components/widgets/ExecWidget_settings',
            [
                'widget' => $this
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function getTitle(): string
    {
        return $this->command ? Craft::t('exec-widget', 'Exec {command}', ['command' => $this->command]) : Craft::t('exec-widget', 'Exec: no command chosen');
    }

    /**
     * @inheritdoc
     */
    public function getBodyHtml()
    {
        return Craft::$app->getView()->renderTemplate(
            'exec-widget/_components/widgets/ExecWidget_body',
            [
                'message' => $this->message,
                'command' => $this->command,
            ]
        );
    }
}
