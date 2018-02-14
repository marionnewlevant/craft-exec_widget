# Exec Widget plugin for Craft CMS 3.x

Widgets which run Tasks that call exec(...)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

1. Install with Composer via `composer require marionnewlevant/exec-widget` from your project directory
2. Install plugin in the Craft Control Panel under Settings > Plugins

or

1. Install via the Plugin Store

## Exec Widget Overview

Dashboard widget that runs php [exec](http://php.net/manual/en/function.exec.php) in a task.

## Configuring Exec Widget

You need a config file, `config/execWidget.php`. That file defines the different commands that can be run.

Sample configuration file (note that the usual multi-environment config works here too):

    <?php

    return [
      'commands' => [
        // each command has the name it will be displayed with
        // and the command line
        'Do the Thing' => './bin/doTheThing.sh --quiet',
        'Another Thing' => './bin/somethingElse.sh',
      ]
    ];

## Using Exec Widget

Add the widget to the dashboard, and configure it with instructions and choosing the command. The `Do it` button will launch a task to run the command. Command output will be captured in the `queue.log` log. Search for `ExecWidget Task` to find output.

Brought to you by [Marion Newlevant](http://marion.newlevant.com).
Icon shell by [B Barrett from the Noun Project](https://thenounproject.com/bbarrett/).
