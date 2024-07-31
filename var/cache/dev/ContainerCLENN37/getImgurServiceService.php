<?php

namespace ContainerCLENN37;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getImgurServiceService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Service\ImgurService' shared autowired service.
     *
     * @return \App\Service\ImgurService
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Service'.\DIRECTORY_SEPARATOR.'ImageService.php';

        return $container->privates['App\\Service\\ImgurService'] = new \App\Service\ImgurService(($container->privates['http_client'] ?? $container->load('getHttpClientService')));
    }
}
