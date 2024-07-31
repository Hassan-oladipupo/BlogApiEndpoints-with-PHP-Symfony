<?php

// This file has been auto-generated by the Symfony Dependency Injection Component
// You can reference it in the "opcache.preload" php.ini setting on PHP >= 7.4 when preloading is desired

use Symfony\Component\DependencyInjection\Dumper\Preloader;

if (in_array(PHP_SAPI, ['cli', 'phpdbg'], true)) {
    return;
}

require dirname(__DIR__, 3).''.\DIRECTORY_SEPARATOR.'vendor/autoload.php';
(require __DIR__.'/App_KernelDevDebugContainer.php')->set(\ContainerLTswEOk\App_KernelDevDebugContainer::class, null);
require __DIR__.'/ContainerLTswEOk/EntityManagerGhost51e8656.php';
require __DIR__.'/ContainerLTswEOk/getValidator_WhenService.php';
require __DIR__.'/ContainerLTswEOk/getValidator_NotCompromisedPasswordService.php';
require __DIR__.'/ContainerLTswEOk/getValidator_ExpressionService.php';
require __DIR__.'/ContainerLTswEOk/getValidator_EmailService.php';
require __DIR__.'/ContainerLTswEOk/getValidator_BuilderService.php';
require __DIR__.'/ContainerLTswEOk/getValidatorService.php';
require __DIR__.'/ContainerLTswEOk/getSluggerService.php';
require __DIR__.'/ContainerLTswEOk/getSession_FactoryService.php';
require __DIR__.'/ContainerLTswEOk/getServicesResetterService.php';
require __DIR__.'/ContainerLTswEOk/getSerializer_Mapping_ClassMetadataFactoryService.php';
require __DIR__.'/ContainerLTswEOk/getSerializerService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Validator_UserPasswordService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_UserPasswordHasherService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_UserCheckerService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_User_Provider_Concrete_AppUserProviderService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_PasswordHasherFactoryService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Logout_Listener_Default_MainService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Logout_Listener_CsrfTokenClearingService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Listener_UserProviderService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Listener_UserChecker_MainService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Listener_UserChecker_ApiService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Listener_Session_MainService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Listener_PasswordMigratingService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Listener_CsrfProtectionService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Listener_CheckAuthenticatorCredentialsService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Listener_Api_UserProviderService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_HttpUtilsService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_HelperService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Firewall_Map_Context_MainService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Firewall_Map_Context_DevService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Firewall_Map_Context_ApiService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Firewall_EventDispatcherLocatorService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_EventDispatcher_ApiService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Csrf_TokenStorageService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Csrf_TokenManagerService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_ChannelListenerService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Authenticator_ManagersLocatorService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Authenticator_Manager_MainService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Authenticator_Manager_ApiService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Authenticator_Jwt_ApiService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_Authenticator_JsonLogin_MainService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_AuthenticationUtilsService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_AccessMapService.php';
require __DIR__.'/ContainerLTswEOk/getSecurity_AccessListenerService.php';
require __DIR__.'/ContainerLTswEOk/getSecrets_VaultService.php';
require __DIR__.'/ContainerLTswEOk/getRouting_LoaderService.php';
require __DIR__.'/ContainerLTswEOk/getPropertyInfo_SerializerExtractorService.php';
require __DIR__.'/ContainerLTswEOk/getPropertyInfoService.php';
require __DIR__.'/ContainerLTswEOk/getPropertyAccessorService.php';
require __DIR__.'/ContainerLTswEOk/getMimeTypesService.php';
require __DIR__.'/ContainerLTswEOk/getLexikJwtAuthentication_KeyLoaderService.php';
require __DIR__.'/ContainerLTswEOk/getLexikJwtAuthentication_JwtManagerService.php';
require __DIR__.'/ContainerLTswEOk/getLexikJwtAuthentication_EncoderService.php';
require __DIR__.'/ContainerLTswEOk/getHttpClientService.php';
require __DIR__.'/ContainerLTswEOk/getErrorControllerService.php';
require __DIR__.'/ContainerLTswEOk/getDoctrine_UuidGeneratorService.php';
require __DIR__.'/ContainerLTswEOk/getDoctrine_UlidGeneratorService.php';
require __DIR__.'/ContainerLTswEOk/getDoctrine_Orm_Validator_UniqueService.php';
require __DIR__.'/ContainerLTswEOk/getDoctrine_Orm_Listeners_DoctrineTokenProviderSchemaSubscriberService.php';
require __DIR__.'/ContainerLTswEOk/getDoctrine_Orm_Listeners_DoctrineDbalCacheAdapterSchemaSubscriberService.php';
require __DIR__.'/ContainerLTswEOk/getDoctrine_Orm_DefaultListeners_AttachEntityListenersService.php';
require __DIR__.'/ContainerLTswEOk/getDoctrine_Orm_DefaultEntityManager_PropertyInfoExtractorService.php';
require __DIR__.'/ContainerLTswEOk/getDoctrine_Orm_DefaultEntityManagerService.php';
require __DIR__.'/ContainerLTswEOk/getDoctrine_Dbal_DefaultConnection_EventManagerService.php';
require __DIR__.'/ContainerLTswEOk/getDoctrine_Dbal_DefaultConnectionService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_Security_Voter_VoteListenerService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_Security_Voter_Security_Access_SimpleRoleVoterService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_Security_Voter_Security_Access_AuthenticatedVoterService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_Security_UserValueResolverService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_Security_Firewall_Authenticator_MainService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_Security_Firewall_Authenticator_ApiService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_Doctrine_Orm_EntityValueResolverService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_ArgumentResolver_VariadicService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_ArgumentResolver_SessionService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_ArgumentResolver_ServiceService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_ArgumentResolver_RequestAttributeService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_ArgumentResolver_RequestService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_ArgumentResolver_NotTaggedControllerService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_ArgumentResolver_DefaultService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_ArgumentResolver_DatetimeService.php';
require __DIR__.'/ContainerLTswEOk/getDebug_ArgumentResolver_BackedEnumResolverService.php';
require __DIR__.'/ContainerLTswEOk/getContainer_GetRoutingConditionServiceService.php';
require __DIR__.'/ContainerLTswEOk/getContainer_EnvVarProcessorsLocatorService.php';
require __DIR__.'/ContainerLTswEOk/getContainer_EnvVarProcessorService.php';
require __DIR__.'/ContainerLTswEOk/getCache_ValidatorExpressionLanguageService.php';
require __DIR__.'/ContainerLTswEOk/getCache_SystemClearerService.php';
require __DIR__.'/ContainerLTswEOk/getCache_SystemService.php';
require __DIR__.'/ContainerLTswEOk/getCache_SecurityIsGrantedAttributeExpressionLanguageService.php';
require __DIR__.'/ContainerLTswEOk/getCache_GlobalClearerService.php';
require __DIR__.'/ContainerLTswEOk/getCache_AppClearerService.php';
require __DIR__.'/ContainerLTswEOk/getCache_AppService.php';
require __DIR__.'/ContainerLTswEOk/getTemplateControllerService.php';
require __DIR__.'/ContainerLTswEOk/getRedirectControllerService.php';
require __DIR__.'/ContainerLTswEOk/getImgurServiceService.php';
require __DIR__.'/ContainerLTswEOk/getJWTManagerService.php';
require __DIR__.'/ContainerLTswEOk/getUserProfileRepositoryService.php';
require __DIR__.'/ContainerLTswEOk/getCommentRepositoryService.php';
require __DIR__.'/ContainerLTswEOk/getBlogPostRepositoryService.php';
require __DIR__.'/ContainerLTswEOk/getAppUserRepositoryService.php';
require __DIR__.'/ContainerLTswEOk/getUserControllerService.php';
require __DIR__.'/ContainerLTswEOk/getProfileSettingControllerService.php';
require __DIR__.'/ContainerLTswEOk/getProfileControllerService.php';
require __DIR__.'/ContainerLTswEOk/getLikeControllerService.php';
require __DIR__.'/ContainerLTswEOk/getFollowersControllerService.php';
require __DIR__.'/ContainerLTswEOk/getBlogPostControllerService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_ZuZJuKoService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_Y4Zrx_Service.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_UIhlHo0Service.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_S74PExaService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_RSTd_NAService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_NOJnvwkService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_HRnhTRvService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_GEOpjwzService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_CIvhbp5Service.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_Zk473sService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_ZY6tF6gService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_XttDSVGService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_VNfh_KWService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_T1d6F8jService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_GYRAYNXService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_GLXEf8MService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_FY3VIxcService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_CshazM0Service.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_8L9Dm7hService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_6EP8ihEService.php';
require __DIR__.'/ContainerLTswEOk/get_ServiceLocator_1MKZjV2Service.php';
require __DIR__.'/ContainerLTswEOk/get_Security_RequestMatcher_KLbKLHaService.php';
require __DIR__.'/ContainerLTswEOk/get_Security_RequestMatcher_FbeHDomService.php';

$classes = [];
$classes[] = 'Symfony\Bundle\FrameworkBundle\FrameworkBundle';
$classes[] = 'Doctrine\Bundle\DoctrineBundle\DoctrineBundle';
$classes[] = 'Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle';
$classes[] = 'Symfony\Bundle\MakerBundle\MakerBundle';
$classes[] = 'Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle';
$classes[] = 'Symfony\Bundle\SecurityBundle\SecurityBundle';
$classes[] = 'Symfony\Bundle\MonologBundle\MonologBundle';
$classes[] = 'Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle';
$classes[] = 'Nelmio\CorsBundle\NelmioCorsBundle';
$classes[] = 'Symfony\Component\HttpFoundation\RequestMatcher\PathRequestMatcher';
$classes[] = 'Symfony\Component\HttpFoundation\ChainRequestMatcher';
$classes[] = 'Symfony\Component\DependencyInjection\ServiceLocator';
$classes[] = 'App\Controller\BlogPostController';
$classes[] = 'App\Service\BlogPostFormatter';
$classes[] = 'App\Controller\FollowersController';
$classes[] = 'App\Controller\LikeController';
$classes[] = 'App\Controller\ProfileController';
$classes[] = 'App\Controller\ProfileSettingController';
$classes[] = 'App\Controller\UserController';
$classes[] = 'App\Service\TokenGenerator';
$classes[] = 'App\Security\PasswordHelper';
$classes[] = 'App\Repository\AppUserRepository';
$classes[] = 'App\Repository\BlogPostRepository';
$classes[] = 'App\Repository\CommentRepository';
$classes[] = 'App\Repository\UserProfileRepository';
$classes[] = 'App\Security\JWTManager';
$classes[] = 'App\Service\ImgurService';
$classes[] = 'Symfony\Bundle\FrameworkBundle\Controller\RedirectController';
$classes[] = 'Symfony\Bundle\FrameworkBundle\Controller\TemplateController';
$classes[] = 'Symfony\Component\Cache\Adapter\PhpArrayAdapter';
$classes[] = 'Doctrine\Common\Annotations\PsrCachedReader';
$classes[] = 'Doctrine\Common\Annotations\AnnotationReader';
$classes[] = 'Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactory';
$classes[] = 'Symfony\Component\Cache\Adapter\AdapterInterface';
$classes[] = 'Symfony\Component\Cache\Adapter\AbstractAdapter';
$classes[] = 'Symfony\Component\Cache\Adapter\FilesystemAdapter';
$classes[] = 'Symfony\Component\Cache\Marshaller\DefaultMarshaller';
$classes[] = 'Symfony\Component\HttpKernel\CacheClearer\Psr6CacheClearer';
$classes[] = 'Symfony\Component\Cache\Adapter\ArrayAdapter';
$classes[] = 'Symfony\Component\Config\Resource\SelfCheckingResourceChecker';
$classes[] = 'Symfony\Component\DependencyInjection\EnvVarProcessor';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\CacheAttributeListener';
$classes[] = 'Symfony\Component\Security\Http\EventListener\IsGrantedAttributeListener';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\TraceableValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\BackedEnumValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\DateTimeValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\DefaultValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\NotTaggedControllerValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\ServiceValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\SessionValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\VariadicValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\DebugHandlersListener';
$classes[] = 'Symfony\Bridge\Monolog\Logger';
$classes[] = 'Symfony\Bridge\Doctrine\ArgumentResolver\EntityValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Debug\FileLinkFormatter';
$classes[] = 'Symfony\Component\Security\Core\Authorization\TraceableAccessDecisionManager';
$classes[] = 'Symfony\Component\Security\Core\Authorization\AccessDecisionManager';
$classes[] = 'Symfony\Component\Security\Core\Authorization\Strategy\AffirmativeStrategy';
$classes[] = 'Symfony\Bundle\SecurityBundle\Debug\TraceableFirewallListener';
$classes[] = 'Symfony\Component\Security\Http\Logout\LogoutUrlGenerator';
$classes[] = 'Symfony\Component\Security\Http\Authenticator\Debug\TraceableAuthenticatorManagerListener';
$classes[] = 'Symfony\Component\Security\Http\Firewall\AuthenticatorManagerListener';
$classes[] = 'Symfony\Component\Security\Http\Controller\UserValueResolver';
$classes[] = 'Symfony\Component\Security\Core\Authorization\Voter\TraceableVoter';
$classes[] = 'Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter';
$classes[] = 'Symfony\Component\Security\Core\Authorization\Voter\RoleVoter';
$classes[] = 'Symfony\Bundle\SecurityBundle\EventListener\VoteListener';
$classes[] = 'Symfony\Component\Stopwatch\Stopwatch';
$classes[] = 'Symfony\Component\DependencyInjection\Config\ContainerParametersResourceChecker';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\DisallowRobotsIndexingListener';
$classes[] = 'Doctrine\Bundle\DoctrineBundle\Registry';
$classes[] = 'Doctrine\DBAL\Connection';
$classes[] = 'Doctrine\Bundle\DoctrineBundle\ConnectionFactory';
$classes[] = 'Doctrine\DBAL\Configuration';
$classes[] = 'Doctrine\DBAL\Schema\LegacySchemaManagerFactory';
$classes[] = 'Doctrine\DBAL\Logging\Middleware';
$classes[] = 'Doctrine\Bundle\DoctrineBundle\Middleware\DebugMiddleware';
$classes[] = 'Doctrine\DBAL\Tools\DsnParser';
$classes[] = 'Symfony\Bridge\Doctrine\ContainerAwareEventManager';
$classes[] = 'Doctrine\Bundle\DoctrineBundle\Middleware\BacktraceDebugDataHolder';
$classes[] = 'Doctrine\ORM\Mapping\Driver\AttributeDriver';
$classes[] = 'Doctrine\ORM\Proxy\Autoloader';
$classes[] = 'Doctrine\ORM\EntityManager';
$classes[] = 'Doctrine\ORM\Configuration';
$classes[] = 'Doctrine\Bundle\DoctrineBundle\Mapping\MappingDriver';
$classes[] = 'Doctrine\Persistence\Mapping\Driver\MappingDriverChain';
$classes[] = 'Doctrine\ORM\Mapping\UnderscoreNamingStrategy';
$classes[] = 'Doctrine\ORM\Mapping\DefaultQuoteStrategy';
$classes[] = 'Doctrine\Bundle\DoctrineBundle\Mapping\ContainerEntityListenerResolver';
$classes[] = 'Doctrine\Bundle\DoctrineBundle\Repository\ContainerRepositoryFactory';
$classes[] = 'Doctrine\Bundle\DoctrineBundle\ManagerConfigurator';
$classes[] = 'Symfony\Bridge\Doctrine\PropertyInfo\DoctrineExtractor';
$classes[] = 'Doctrine\ORM\Tools\AttachEntityListenersListener';
$classes[] = 'Symfony\Bridge\Doctrine\SchemaListener\DoctrineDbalCacheAdapterSchemaSubscriber';
$classes[] = 'Symfony\Bridge\Doctrine\SchemaListener\RememberMeTokenProviderDoctrineSchemaSubscriber';
$classes[] = 'Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator';
$classes[] = 'Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator';
$classes[] = 'Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ErrorController';
$classes[] = 'Symfony\Component\ErrorHandler\ErrorRenderer\SerializerErrorRenderer';
$classes[] = 'Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer';
$classes[] = 'Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher';
$classes[] = 'Symfony\Component\EventDispatcher\EventDispatcher';
$classes[] = 'Monolog\Handler\NullHandler';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\ErrorListener';
$classes[] = 'Sensio\Bundle\FrameworkExtraBundle\Request\ArgumentNameConverter';
$classes[] = 'Sensio\Bundle\FrameworkExtraBundle\EventListener\IsGrantedListener';
$classes[] = 'Symfony\Contracts\HttpClient\HttpClientInterface';
$classes[] = 'Symfony\Component\HttpClient\HttpClient';
$classes[] = 'Symfony\Component\Runtime\Runner\Symfony\HttpKernelRunner';
$classes[] = 'Symfony\Component\Runtime\Runner\Symfony\ResponseRunner';
$classes[] = 'Symfony\Component\Runtime\SymfonyRuntime';
$classes[] = 'Symfony\Component\HttpKernel\HttpKernel';
$classes[] = 'Symfony\Component\HttpKernel\Controller\TraceableControllerResolver';
$classes[] = 'Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\TraceableArgumentResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver';
$classes[] = 'App\Kernel';
$classes[] = 'Lexik\Bundle\JWTAuthenticationBundle\Encoder\LcobucciJWTEncoder';
$classes[] = 'Lexik\Bundle\JWTAuthenticationBundle\Services\JWSProvider\LcobucciJWSProvider';
$classes[] = 'Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager';
$classes[] = 'Lexik\Bundle\JWTAuthenticationBundle\Services\KeyLoader\RawKeyLoader';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\LocaleAwareListener';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\LocaleListener';
$classes[] = 'Symfony\Component\Mime\MimeTypes';
$classes[] = 'Symfony\Bridge\Monolog\Handler\ConsoleHandler';
$classes[] = 'Monolog\Handler\StreamHandler';
$classes[] = 'Monolog\Processor\PsrLogMessageProcessor';
$classes[] = 'Nelmio\CorsBundle\EventListener\CacheableResponseVaryListener';
$classes[] = 'Nelmio\CorsBundle\EventListener\CorsListener';
$classes[] = 'Nelmio\CorsBundle\Options\Resolver';
$classes[] = 'Nelmio\CorsBundle\Options\ConfigProvider';
$classes[] = 'Symfony\Component\DependencyInjection\ParameterBag\ContainerBag';
$classes[] = 'Symfony\Component\PropertyAccess\PropertyAccessor';
$classes[] = 'Symfony\Component\PropertyInfo\PropertyInfoExtractor';
$classes[] = 'Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor';
$classes[] = 'Symfony\Component\PropertyInfo\Extractor\SerializerExtractor';
$classes[] = 'Symfony\Component\HttpFoundation\RequestStack';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\ResponseListener';
$classes[] = 'Symfony\Bundle\FrameworkBundle\Routing\Router';
$classes[] = 'Symfony\Component\Config\ResourceCheckerConfigCacheFactory';
$classes[] = 'Symfony\Component\Routing\RequestContext';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\RouterListener';
$classes[] = 'Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader';
$classes[] = 'Symfony\Component\Config\Loader\LoaderResolver';
$classes[] = 'Symfony\Component\Routing\Loader\XmlFileLoader';
$classes[] = 'Symfony\Component\HttpKernel\Config\FileLocator';
$classes[] = 'Symfony\Component\Routing\Loader\YamlFileLoader';
$classes[] = 'Symfony\Component\Routing\Loader\PhpFileLoader';
$classes[] = 'Symfony\Component\Routing\Loader\GlobFileLoader';
$classes[] = 'Symfony\Component\Routing\Loader\DirectoryLoader';
$classes[] = 'Symfony\Component\Routing\Loader\ContainerLoader';
$classes[] = 'Symfony\Bundle\FrameworkBundle\Routing\AnnotatedRouteControllerLoader';
$classes[] = 'Symfony\Component\Routing\Loader\AnnotationDirectoryLoader';
$classes[] = 'Symfony\Component\Routing\Loader\AnnotationFileLoader';
$classes[] = 'Symfony\Component\Routing\Loader\Psr4DirectoryLoader';
$classes[] = 'Symfony\Bundle\FrameworkBundle\Secrets\SodiumVault';
$classes[] = 'Symfony\Component\String\LazyString';
$classes[] = 'Symfony\Component\Security\Http\Firewall\AccessListener';
$classes[] = 'Symfony\Component\Security\Http\AccessMap';
$classes[] = 'Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver';
$classes[] = 'Symfony\Component\Security\Http\Authentication\AuthenticationUtils';
$classes[] = 'Symfony\Component\Security\Http\Authenticator\JsonLoginAuthenticator';
$classes[] = 'Symfony\Component\Security\Http\Authentication\CustomAuthenticationSuccessHandler';
$classes[] = 'Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler';
$classes[] = 'Symfony\Component\Security\Http\Authentication\CustomAuthenticationFailureHandler';
$classes[] = 'Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationFailureHandler';
$classes[] = 'Lexik\Bundle\JWTAuthenticationBundle\Security\Authenticator\JWTAuthenticator';
$classes[] = 'Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\ChainTokenExtractor';
$classes[] = 'Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor';
$classes[] = 'Symfony\Component\Security\Http\Authentication\AuthenticatorManager';
$classes[] = 'Symfony\Component\Security\Core\Authorization\AuthorizationChecker';
$classes[] = 'Symfony\Component\Security\Http\Firewall\ChannelListener';
$classes[] = 'Symfony\Component\Security\Http\Firewall\ContextListener';
$classes[] = 'Symfony\Component\Security\Csrf\CsrfTokenManager';
$classes[] = 'Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator';
$classes[] = 'Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage';
$classes[] = 'Symfony\Bundle\SecurityBundle\Security\FirewallMap';
$classes[] = 'Symfony\Bundle\SecurityBundle\Security\FirewallContext';
$classes[] = 'Symfony\Component\Security\Http\Firewall\ExceptionListener';
$classes[] = 'Symfony\Bundle\SecurityBundle\Security\FirewallConfig';
$classes[] = 'Symfony\Component\Security\Http\Firewall\LogoutListener';
$classes[] = 'Symfony\Bundle\SecurityBundle\Security';
$classes[] = 'Symfony\Component\Security\Http\HttpUtils';
$classes[] = 'Symfony\Component\Security\Http\EventListener\UserProviderListener';
$classes[] = 'Symfony\Component\Security\Http\EventListener\CheckCredentialsListener';
$classes[] = 'Symfony\Component\Security\Http\EventListener\CsrfProtectionListener';
$classes[] = 'Symfony\Component\Security\Http\EventListener\PasswordMigratingListener';
$classes[] = 'Symfony\Component\Security\Http\EventListener\SessionStrategyListener';
$classes[] = 'Symfony\Component\Security\Http\Session\SessionAuthenticationStrategy';
$classes[] = 'Symfony\Component\Security\Http\EventListener\UserCheckerListener';
$classes[] = 'Symfony\Component\Security\Http\EventListener\CsrfTokenClearingLogoutListener';
$classes[] = 'Symfony\Component\Security\Http\EventListener\DefaultLogoutListener';
$classes[] = 'Symfony\Component\Security\Http\EventListener\SessionLogoutListener';
$classes[] = 'Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory';
$classes[] = 'Symfony\Component\Security\Core\Authentication\Token\Storage\UsageTrackingTokenStorage';
$classes[] = 'Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage';
$classes[] = 'Symfony\Bridge\Doctrine\Security\User\EntityUserProvider';
$classes[] = 'Symfony\Component\Security\Core\User\InMemoryUserChecker';
$classes[] = 'Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher';
$classes[] = 'Symfony\Component\Security\Core\Validator\Constraints\UserPasswordValidator';
$classes[] = 'Sensio\Bundle\FrameworkExtraBundle\EventListener\HttpCacheListener';
$classes[] = 'Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener';
$classes[] = 'Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener';
$classes[] = 'Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager';
$classes[] = 'Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter';
$classes[] = 'Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DateTimeParamConverter';
$classes[] = 'Sensio\Bundle\FrameworkExtraBundle\EventListener\SecurityListener';
$classes[] = 'Symfony\Component\Security\Core\Role\RoleHierarchy';
$classes[] = 'Symfony\Component\Serializer\Serializer';
$classes[] = 'Symfony\Component\Serializer\Normalizer\UnwrappingDenormalizer';
$classes[] = 'Symfony\Component\Serializer\Normalizer\ProblemNormalizer';
$classes[] = 'Symfony\Component\Serializer\Normalizer\UidNormalizer';
$classes[] = 'Symfony\Component\Serializer\Normalizer\DateTimeNormalizer';
$classes[] = 'Symfony\Component\Serializer\Normalizer\ConstraintViolationListNormalizer';
$classes[] = 'Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter';
$classes[] = 'Symfony\Component\Serializer\Normalizer\MimeMessageNormalizer';
$classes[] = 'Symfony\Component\Serializer\Normalizer\PropertyNormalizer';
$classes[] = 'Symfony\Component\Serializer\Mapping\ClassDiscriminatorFromClassMetadata';
$classes[] = 'Symfony\Component\Serializer\Normalizer\DateTimeZoneNormalizer';
$classes[] = 'Symfony\Component\Serializer\Normalizer\DateIntervalNormalizer';
$classes[] = 'Symfony\Component\Serializer\Normalizer\FormErrorNormalizer';
$classes[] = 'Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer';
$classes[] = 'Symfony\Component\Serializer\Normalizer\DataUriNormalizer';
$classes[] = 'Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer';
$classes[] = 'Symfony\Component\Serializer\Normalizer\ArrayDenormalizer';
$classes[] = 'Symfony\Component\Serializer\Normalizer\ObjectNormalizer';
$classes[] = 'Symfony\Component\Serializer\Encoder\XmlEncoder';
$classes[] = 'Symfony\Component\Serializer\Encoder\JsonEncoder';
$classes[] = 'Symfony\Component\Serializer\Encoder\YamlEncoder';
$classes[] = 'Symfony\Component\Serializer\Encoder\CsvEncoder';
$classes[] = 'Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory';
$classes[] = 'Symfony\Component\Serializer\Mapping\Loader\LoaderChain';
$classes[] = 'Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader';
$classes[] = 'Symfony\Component\DependencyInjection\ContainerInterface';
$classes[] = 'Symfony\Component\HttpKernel\DependencyInjection\ServicesResetter';
$classes[] = 'Symfony\Component\HttpFoundation\Session\SessionFactory';
$classes[] = 'Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorageFactory';
$classes[] = 'Symfony\Component\HttpFoundation\Session\Storage\Handler\StrictSessionHandler';
$classes[] = 'Symfony\Component\HttpFoundation\Session\Storage\MetadataBag';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\SessionListener';
$classes[] = 'Symfony\Component\String\Slugger\AsciiSlugger';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\ValidateRequestListener';
$classes[] = 'Symfony\Component\Validator\Validator\ValidatorInterface';
$classes[] = 'Symfony\Component\Validator\ValidatorBuilder';
$classes[] = 'Symfony\Component\Validator\Validation';
$classes[] = 'Symfony\Component\Validator\ContainerConstraintValidatorFactory';
$classes[] = 'Symfony\Bridge\Doctrine\Validator\DoctrineInitializer';
$classes[] = 'Symfony\Component\Validator\Mapping\Loader\PropertyInfoLoader';
$classes[] = 'Symfony\Bridge\Doctrine\Validator\DoctrineLoader';
$classes[] = 'Symfony\Component\Validator\Constraints\EmailValidator';
$classes[] = 'Symfony\Component\Validator\Constraints\ExpressionValidator';
$classes[] = 'Symfony\Component\Validator\Constraints\NotCompromisedPasswordValidator';
$classes[] = 'Symfony\Component\Validator\Constraints\WhenValidator';

$preloaded = Preloader::preload($classes);

$classes = [];
$classes[] = 'Symfony\\Component\\Routing\\Generator\\CompiledUrlGenerator';
$classes[] = 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableCompiledUrlMatcher';
$preloaded = Preloader::preload($classes, $preloaded);
