<?php

namespace ContainerBDiA1TL;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_HRnhTRvService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.hRnhTRv' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.hRnhTRv'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'doctrine' => ['services', 'doctrine', 'getDoctrineService', false],
            'userToUnFollow' => ['privates', '.errored..service_locator.hRnhTRv.App\\Entity\\AppUser', NULL, 'Cannot autowire service ".service_locator.hRnhTRv": it needs an instance of "App\\Entity\\AppUser" but this type has been excluded in "config/services.yaml".'],
        ], [
            'doctrine' => '?',
            'userToUnFollow' => 'App\\Entity\\AppUser',
        ]);
    }
}
