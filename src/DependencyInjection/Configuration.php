<?php

declare(strict_types=1);

namespace Subitolabs\SyliusCountdownPlugin\DependencyInjection;

use Subitolabs\SyliusCountdownPlugin\Entity\Schedule;
use Subitolabs\SyliusCountdownPlugin\Entity\ScheduleInterface;
use Subitolabs\SyliusCountdownPlugin\Form\ScheduleType;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Resource\Factory\Factory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * @psalm-suppress UnusedVariable
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('subitolabs_sylius_countdown_plugin');
        $rootNode = $treeBuilder->getRootNode();

        /** @phpstan-ignore argument.type */
        $this->addResourcesSection($rootNode);

        return $treeBuilder;
    }

    private function addResourcesSection(ArrayNodeDefinition $node): void
    {
        /**
         * @psalm-suppress MixedMethodCall
         * @psalm-suppress PossiblyUndefinedMethod
         * @psalm-suppress PossiblyNullReference
         * @phpstan-ignore argument.type
         */
        $node
            ->children()
                ->arrayNode('resources')
                ->addDefaultsIfNotSet()
                ->children()
                    ->arrayNode('schedule')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->variableNode('options')->end()
                        ->arrayNode('classes')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('model')->defaultValue(Schedule::class)->cannotBeEmpty()->end()
                            ->scalarNode('interface')->defaultValue(ScheduleInterface::class)->cannotBeEmpty()->end()
                            ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
//                            ->scalarNode('repository')->defaultValue(ShippingScheduleRepository::class)->cannotBeEmpty()->end()
                            ->scalarNode('form')->defaultValue(ScheduleType::class)->end()
                            ->scalarNode('factory')->defaultValue(Factory::class)->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
