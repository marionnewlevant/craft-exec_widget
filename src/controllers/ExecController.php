<?php
/**
 * Exec Widget plugin for Craft CMS 3.x
 *
 * Widgets which run Tasks that call exec(...)
 *
 * @link      http://marion.newlevant.com
 * @copyright Copyright (c) 2018 Marion Newlevant
 */

namespace marionnewlevant\execwidget\controllers;

use marionnewlevant\execwidget\ExecWidget;

use Craft;
use craft\web\Controller;

/**
 * @author    Marion Newlevant
 * @package   ExecWidget
 * @since     1.0.0
 */
class ExecController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = [];

    // Public Methods
    // =========================================================================


    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $this->requirePostRequest();
        $request = Craft::$app->getRequest();
        $command = $request->getBodyParam('command');
        $commands = ExecWidget::$plugin->execWidgetService->commands();
        if (array_key_exists($command, $commands))
        {
            ExecWidget::$plugin->execWidgetService->exec($commands[$command]);
            Craft::$app->getSession()->setNotice(Craft::t('exec-widget', 'Exec Widget task launched'));
        }
        else
        {
            Craft::$app->getSession()->setError(Craft::t('exec-widget', 'The command {command} is not in the config file', ['command' => $command]));
        }
        return $this->redirectToPostedUrl();
    }
}
