<?php

namespace Container8WDxvax;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_ZuZJuKoService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.zuZJuKo' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.zuZJuKo'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'repo' => ['services', 'App\\Repository\\AppUserRepository', 'getAppUserRepositoryService', true],
            'slugger' => ['privates', 'slugger', 'getSluggerService', true],
            'validator' => ['privates', 'validator', 'getValidatorService', true],
        ], [
            'repo' => 'App\\Repository\\AppUserRepository',
            'slugger' => '?',
            'validator' => '?',
        ]);
    }
}