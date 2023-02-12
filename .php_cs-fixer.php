<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests'
    ])
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'concat_space' => ['spacing' => 'one'],
        'increment_style' => ['style' => 'post'],
        'no_extra_blank_lines' => ['tokens' => [
            'extra',
            'parenthesis_brace_block',
            'square_brace_block',
            'throw',
            'use',
        ]],
        'no_superfluous_phpdoc_tags' => false,
        'phpdoc_align' => false,
        'phpdoc_annotation_without_dot' => false,
        'trailing_comma_in_multiline_array' => false,
        'yoda_style' => false
    ])
    ->setFinder($finder);
