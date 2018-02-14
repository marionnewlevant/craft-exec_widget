<?php
/**
 * Exec Widget plugin for Craft CMS 3.x
 *
 * Widgets which run Tasks that call exec(...)
 *
 * @link      http://marion.newlevant.com
 * @copyright Copyright (c) 2018 Marion Newlevant
 */

namespace marionnewlevant\execwidget\jobs;

use marionnewlevant\execwidget\ExecWidget;

use Craft;
use craft\queue\BaseJob;

/**
 * @author    Marion Newlevant
 * @package   ExecWidget
 * @since     1.0.0
 */
class ExecWidgetTask extends BaseJob
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $command ;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function execute($queue)
    {
        // Do work here
        $output = [];
        $returnValue = 0;
        $this->log('executing '.$this->command);
        exec($this->command, $output, $returnValue);
        // ok, now we want to log output (one line per, and returnValue)
        $this->log('returned '.$returnValue);
        foreach ($output as $value)
        {
            $this->log($value);
        }
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function defaultDescription(): string
    {
        return Craft::t('exec-widget', 'ExecWidget Task');
    }

    private function log(string $s)
    {
        Craft::info($s, __METHOD__);
    }
}
