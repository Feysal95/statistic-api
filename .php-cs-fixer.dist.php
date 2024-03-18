<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixerCustomFixers\Fixer\CommentSurroundedBySpacesFixer;
use PhpCsFixerCustomFixers\Fixer\IssetToArrayKeyExistsFixer;
use PhpCsFixerCustomFixers\Fixer\MultilineCommentOpeningClosingAloneFixer;
use PhpCsFixerCustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoDuplicatedArrayKeyFixer;
use PhpCsFixerCustomFixers\Fixer\NoDuplicatedImportsFixer;
use PhpCsFixerCustomFixers\Fixer\NoPhpStormGeneratedCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoReferenceInFunctionDefinitionFixer;
use PhpCsFixerCustomFixers\Fixer\NoSuperfluousConcatenationFixer;
use PhpCsFixerCustomFixers\Fixer\NoTrailingCommaInSinglelineFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessDoctrineRepositoryCommentFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessParenthesisFixer;
use PhpCsFixerCustomFixers\Fixer\NoUselessStrlenFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocNoSuperfluousParamFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocParamTypeFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocSelfAccessorFixer;
use PhpCsFixerCustomFixers\Fixer\PhpdocTypesTrimFixer;
use PhpCsFixerCustomFixers\Fixer\PhpUnitDedicatedAssertFixer;
use PhpCsFixerCustomFixers\Fixer\PhpUnitNoUselessReturnFixer;
use PhpCsFixerCustomFixers\Fixer\PromotedConstructorPropertyFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceAfterStatementFixer;
use PhpCsFixerCustomFixers\Fixer\SingleSpaceBeforeStatementFixer;
use PhpCsFixerCustomFixers\Fixer\StringableInterfaceFixer;
use PhpCsFixerCustomFixers\Fixers;

return (new Config())
    ->setFinder(
        Finder::create()
            ->in(__DIR__ . '/public')
            ->in(__DIR__ . '/src')
            ->in(__DIR__ . '/tests')
            ->name(__DIR__ . '/.php-cs-fixer.dist.php')
    )
    ->registerCustomFixers(new Fixers())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP80Migration:risky' => true,
        '@PHP82Migration' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        '@PHPUnit100Migration:risky' => true,
        'class_attributes_separation' => [
            'elements' => [
                'method' => 'one',
                'property' => 'one',
                'case' => 'one',
            ],
        ],
        'concat_space' => [
            'spacing' => 'one',
        ],
        'date_time_create_from_format_call' => true,
        'date_time_immutable' => true,
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => null,
            'import_functions' => null,
        ],
        'group_import' => false,
        'mb_str_functions' => true,
        'method_argument_space' => [
            'on_multiline' => 'ignore',
        ],
        'native_function_invocation' => [
            'exclude' => ['@all'],
            'include' => [],
        ],
        'no_superfluous_phpdoc_tags' => [
            'remove_inheritdoc' => true,
        ],
        'ordered_interfaces' => true,
        'php_unit_internal_class' => false,
        'phpdoc_align' => [
            'align' => 'left',
        ],
        'phpdoc_line_span' => [
            'const' => 'single',
            'property' => 'single',
            'method' => 'single',
        ],
        'phpdoc_param_order' => true,
        'php_unit_data_provider_name' => true,
        'php_unit_test_class_requires_covers' => false,
        'regular_callable_call' => true,
        'return_assignment' => false,
        'single_import_per_statement' => true,
        'simplified_if_return' => true,
        'simplified_null_return' => true,
        'single_line_throw' => false,
        'static_lambda' => true,
        'trailing_comma_in_multiline' => [
            'elements' => [
                'arguments',
                'arrays',
                'match',
                'parameters',
            ],
        ],
        'yoda_style' => [
            'equal' => false,
            'identical' => false,
            'less_and_greater' => false,
        ],
        CommentSurroundedBySpacesFixer::name() => true,
        IssetToArrayKeyExistsFixer::name() => true,
        MultilineCommentOpeningClosingAloneFixer::name() => true,
        NoDoctrineMigrationsGeneratedCommentFixer::name() => true,
        NoDuplicatedArrayKeyFixer::name() => true,
        NoDuplicatedImportsFixer::name() => true,
        NoPhpStormGeneratedCommentFixer::name() => true,
        NoReferenceInFunctionDefinitionFixer::name() => true,
        NoSuperfluousConcatenationFixer::name() => true,
        NoTrailingCommaInSinglelineFixer::name() => true,
        NoUselessCommentFixer::name() => true,
        NoUselessDoctrineRepositoryCommentFixer::name() => true,
        NoUselessParenthesisFixer::name() => true,
        NoUselessStrlenFixer::name() => true,
        PhpUnitDedicatedAssertFixer::name() => true,
        PhpUnitNoUselessReturnFixer::name() => true,
        PhpdocNoSuperfluousParamFixer::name() => true,
        PhpdocParamTypeFixer::name() => true,
        PhpdocSelfAccessorFixer::name() => true,
        PhpdocTypesTrimFixer::name() => true,
        PromotedConstructorPropertyFixer::name() => true,
        SingleSpaceAfterStatementFixer::name() => true,
        SingleSpaceBeforeStatementFixer::name() => true,
        StringableInterfaceFixer::name() => true,
    ])
;
