<?php

namespace ContainerNIgnkO8;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_GEOpjwzService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.gEOpjwz' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.gEOpjwz'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'doctrine' => ['services', 'doctrine', 'getDoctrineService', false],
            'userToFollow' => ['privates', '.errored..service_locator.gEOpjwz.App\\Entity\\AppUser', NULL, 'Cannot autowire service ".service_locator.gEOpjwz": it needs an instance of "App\\Entity\\AppUser" but this type has been excluded in "config/services.yaml".'],
        ], [
            'doctrine' => '?',
            'userToFollow' => 'App\\Entity\\AppUser',
        ]);
    }
}
