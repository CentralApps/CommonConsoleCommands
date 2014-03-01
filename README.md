# Common Symfony Console Commands

This package provides some useful beanstalk related commands for a symfony console.

Included commands are:

- Delete beanstalk job (top of the queue is deleted)
- Flush a tube
- List tubes
- Peek ready a tube
- Get stats on a tube

Each command extends the AbstractPheanstalkCommand class, which provides a method for getting pheanstalk and setting a dependency injection container. Pheanstalk needs to be within an array or contained such as Pimple which implements \ArrayAccess with the key on pheanstalk. 

## Installation

Add the following to your composer.json file

    "centralapps/common-console-commands": "dev-master"
    
Install / update composer.

## Setup

Create a console file within your application; you need to provide a setup pheanstalk object connected to your beanstalkd service.
```php
#!/usr/bin/env php
<?php

require_once(__DIR__.'/vendor/autoload.php');
$container = array(
    'pheanstalk' => PHEANSTALK_GOES_HERE
);

$cli_application = new \Symfony\Component\Console\Application();

$commands = array(
    '\CentralApps\Commands\PheanstalkStatsCommand',
    '\CentralApps\Commands\PheanstalkListCommand',
    '\CentralApps\Commands\PheanstalkPeekReadyCommand',
    '\CentralApps\Commands\PheanstalkDeleteCommand',
    '\CentralApps\Commands\PheanstalkFlushCommand'
);

foreach ($commands as $command) {
    $command = new $command();

    if ($command instanceof \CentralApps\Commands\AcceptsContainerInterface) {
        $command->setContainer($container);
    }

    $cli_application->add($command);
}

$cli_application->run();
```
## Usage

    php console pheanstlk:list

