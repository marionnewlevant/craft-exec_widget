<?php
/**
 * Exec Widget plugin for Craft CMS 3.x
 *
 * Widgets which run Tasks that call exec(...)
 *
 * @link      http://marion.newlevant.com
 * @copyright Copyright (c) 2018 Marion Newlevant
 */

namespace marionnewlevant\execwidget\services;

use marionnewlevant\execwidget\ExecWidget;
use marionnewlevant\execwidget\jobs\ExecWidgetTask as ExecWidgetTask;

use Craft;
use craft\base\Component;

/**
 * @author    Marion Newlevant
 * @package   ExecWidget
 * @since     1.0.0
 */
class ExecWidgetService extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function commands()
    {
        $config = Craft::$app->getConfig()->getConfigFromFile('execWidget');
        return array_key_exists('commands', $config) ? $config['commands'] : [];
    }

    public function exec(string $command)
    {
        $queue = Craft::$app->getQueue();
        $jobId = $queue->push(new ExecWidgetTask([
            'command' => $command,
        ]));
    }
}
