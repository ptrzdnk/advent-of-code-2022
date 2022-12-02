<?php declare(strict_types = 1);

error_reporting(E_ALL);

use Nette\Loaders\RobotLoader;
use Tracy\Debugger;

require_once __DIR__ . '/vendor/autoload.php';

$loader = new RobotLoader;

$loader->addDirectory(__DIR__ . '/app');

Debugger::enable(null, __DIR__ . '/log');
Debugger::$strictMode = true;

$loader->setTempDirectory(__DIR__ . '/temp');
$loader->register();

Runner::run();
Tester::test();
