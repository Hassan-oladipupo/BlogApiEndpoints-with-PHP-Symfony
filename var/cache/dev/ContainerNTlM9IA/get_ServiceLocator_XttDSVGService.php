<?php

namespace ContainerNTlM9IA;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_XttDSVGService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.XttDSVG' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.XttDSVG'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', true],
            'repo' => ['services', 'App\\Repository\\AppUserRepository', 'getAppUserRepositoryService', true],
            'userPasswordHasher' => ['privates', 'security.user_password_hasher', 'getSecurity_UserPasswordHasherService', true],
            'validator' => ['privates', 'validator', 'getValidatorService', true],
        ], [
            'entityManager' => '?',
            'repo' => 'App\\Repository\\AppUserRepository',
            'userPasswordHasher' => '?',
            'validator' => '?',
        ]);
    }
}
