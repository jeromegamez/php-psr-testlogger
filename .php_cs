<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['build', 'vendor'])
    ->in(__DIR__);

return PhpCsFixer\Config::create()
    ->setFinder($finder)
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => [
            'syntax' => 'short'
        ],
        'header_comment' => ['header' => '', 'separate' => 'none'],
        'phpdoc_align' => false,
        'phpdoc_order' => true,
        'ordered_imports' => true,
    ])
    ->setUsingCache(true);
