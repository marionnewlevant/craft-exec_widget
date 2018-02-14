<?php

namespace marionnewlevant\execwidget\models;

use craft\base\Model;
use craft\validators\ArrayValidator;

class Settings extends Model
{
    // Public Properties
    // =========================================================================

    public $commands = [];


    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'commands',
                ],
                ArrayValidator::class,
            ],
        ];
    }
}
