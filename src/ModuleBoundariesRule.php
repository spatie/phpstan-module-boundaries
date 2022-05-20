<?php

namespace Spatie\PhpStanModuleBoundaries;

use PhpParser\Node;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Param;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class ModuleBoundariesRule implements Rule
{
    public function getNodeType(): string
    {
        return Node::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if (! $scope->getClassReflection()) {
            return [];
        }

        if (! $node instanceof Param) {
            return [];
        }

        if (! $node->type instanceof FullyQualified) {
            return [];
        }

        $callerModule = self::resolveModuleFromFqcn($scope->getClassReflection()->getName());

        if (! $callerModule) {
            return [];
        }

        $nodeClassName = implode('\\', $node->type->parts);
        $nodeModule = self::resolveModuleFromFullyQualified($node->type);

        if (! $nodeModule) {
            return [];
        }

        if ($callerModule === $nodeModule) {
            return [];
        }

        if ($node->type->parts[3] !== 'Internal') {
            return [];
        }

        return [
            RuleErrorBuilder::message(
                'Internal class ' . $nodeClassName . ' was used in ' . $callerModule . ' module.'
            )->build(),
        ];
    }

    private static function resolveModuleFromFqcn(string $className): ?string
    {
        if (! preg_match("/^App\\\\Context\\\\/", $className)) {
            return null;
        }

        return explode('\\', $className)[2] ?? null;
    }

    private static function resolveModuleFromFullyQualified(FullyQualified $node): ?string
    {
        if ($node->parts[0] !== 'App' || $node->parts[1] !== 'Context') {
            return null;
        }

        return $node->parts[2] ?? null;
    }
}
