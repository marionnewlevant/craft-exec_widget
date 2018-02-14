<?php
/**
 * Exec Widget plugin for Craft CMS 3.x
 *
 * Widgets which run Tasks that call exec(...)
 *
 * @link      http://marion.newlevant.com
 * @copyright Copyright (c) 2018 Marion Newlevant
 */

namespace marionnewlevant\execwidget\variables;

use marionnewlevant\execwidget\ExecWidget;

use Craft;

/**
 * @author    Marion Newlevant
 * @package   ExecWidget
 * @since     1.0.0
 */
class ExecWidgetVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @return commands array from the config
     */
    public function commands()
    {
        return ExecWidget::$plugin->execWidgetService->commands();
    }
}
