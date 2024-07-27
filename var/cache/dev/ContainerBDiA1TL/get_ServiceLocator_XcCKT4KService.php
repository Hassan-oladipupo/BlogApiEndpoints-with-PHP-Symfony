<?php

namespace ContainerBDiA1TL;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_XcCKT4KService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.xcCKT4K' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.xcCKT4K'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'blog' => ['privates', '.errored..service_locator.xcCKT4K.App\\Entity\\BlogPost', NULL, 'Cannot autowire service ".service_locator.xcCKT4K": it needs an instance of "App\\Entity\\BlogPost" but this type has been excluded in "config/services.yaml".'],
            'logger' => ['privates', 'monolog.logger', 'getMonolog_LoggerService', false],
            'repo' => ['services', 'App\\Repository\\BlogPostRepository', 'getBlogPostRepositoryService', true],
            'security' => ['privates', 'security.helper', 'getSecurity_HelperService', true],
            'serializer' => ['privates', 'serializer', 'getSerializerService', true],
            'validator' => ['privates', 'validator', 'getValidatorService', true],
        ], [
            'blog' => 'App\\Entity\\BlogPost',
            'logger' => '?',
            'repo' => 'App\\Repository\\BlogPostRepository',
            'security' => '?',
            'serializer' => '?',
            'validator' => '?',
        ]);
    }
}
