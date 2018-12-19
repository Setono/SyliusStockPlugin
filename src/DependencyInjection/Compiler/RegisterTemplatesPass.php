<?php

declare(strict_types=1);

namespace Setono\SyliusStockPlugin\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class RegisterTemplatesPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (false === $container->has('setono.sylius_stock.registry.template')) {
            return;
        }

        $templateRegistry = $container->getDefinition('setono.sylius_stock.registry.template');

        $templates = $container->getParameter('setono.sylius_stock.templates');

        $identifierToLabelMap = [];

        foreach ($templates as $idx => $template) {
            if (!isset($template['identifier'])) {
                throw new \InvalidArgumentException(sprintf('Template #%s does not have an identifier defined.', $idx + 1));
            }

            if (!isset($template['label'])) {
                throw new \InvalidArgumentException(sprintf('Template #%s does not have a label defined.', $idx + 1));
            }

            if (!isset($template['class'])) {
                throw new \InvalidArgumentException(sprintf('Template #%s does not have a class defined.', $idx + 1));
            }

            $identifierToLabelMap[$template['identifier']] = $template['label'];

            $templateRegistry->addMethodCall('register', [$template['identifier'], $template['class']]);
        }

        $container->setParameter('setono.sylius_stock.template_labels', $identifierToLabelMap);
    }
}