<?php

require_once __DIR__.'/../vendor/autoload.php';

// Psr\Log\Test\LoggerInterfaceTest doesn't support PHPUnit 6
if (!class_exists('\PHPUnit_Framework_TestCase')) {
    class PHPUnit_Framework_TestCase extends \PHPUnit\Framework\TestCase
    {
    }
}
