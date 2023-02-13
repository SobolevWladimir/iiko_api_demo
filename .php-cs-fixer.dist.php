<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'concat_space'=>['spacing'=>'one'],
        'trim_array_spaces'=>true,
        'increment_style' => ['style' => 'post'],
        'no_extra_blank_lines' => ['tokens' => [
            'extra',
            'parenthesis_brace_block',
            'square_brace_block',
            'throw',
            'use',
        ]],
        'binary_operator_spaces' => [
          'operators' => [
              '=>' => 'align_single_space_minimal',
            ],
        ],
        'no_superfluous_phpdoc_tags' => false,
        'phpdoc_align' => false,
        'phpdoc_annotation_without_dot' => false,
        'yoda_style' => false

    ])
    ->setFinder($finder)
;
