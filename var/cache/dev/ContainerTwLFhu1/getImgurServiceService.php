<?php

namespace ContainerTwLFhu1;


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
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'guzzlehttp'.\DIRECTORY_SEPARATOR.'guzzle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'ClientInterface.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'psr'.\DIRECTORY_SEPARATOR.'http-client'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'ClientInterface.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'guzzlehttp'.\DIRECTORY_SEPARATOR.'guzzle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'ClientTrait.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'guzzlehttp'.\DIRECTORY_SEPARATOR.'guzzle'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Client.php';

        return $container->privates['App\\Service\\ImgurService'] = new \App\Service\ImgurService(new \GuzzleHttp\Client(), ($container->privates['monolog.logger'] ?? $container->getMonolog_LoggerService()));
    }
}
