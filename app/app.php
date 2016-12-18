<?php
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use LudusVisualis\Translations\TranslationFr;
// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig, $app) {
    $twig->addExtension(new Twig_Extensions_Extension_Text());
    $twig->addGlobal("AVAILABLE_LANGUAGES", ["fr_FR"=>['name'=>'Français', 'twoLetters' => 'fr'],
                                             "en_GB" =>['name'=>'English', 'twoLetters' => 'en']]);
    $twig->addGlobal('IMAGES', '/LudusVisualis/images');
    return $twig;
}));


$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new LudusVisualis\DAO\UserDAO($app['db']);
            }),
        ),
    ),
    
    'security.role_hierarchy' => array(
        'ROLE_ADMIN' => array('ROLE_USER'),
    ),
    'security.access_rules' => array(
        array('^/admin', 'ROLE_ADMIN'),
    ),
    
));
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('fr'),
));

$app['dao.user'] = $app->share(function ($app) {
    return new LudusVisualis\DAO\UserDAO($app['db']);
});
$app['dao.game'] = $app->share(function ($app) {
    return new LudusVisualis\DAO\GameDAO($app['db']);
});
$app['dao.basket'] = $app->share(function ($app) {
    return new LudusVisualis\DAO\BasketDAO($app['db']);
});
$app['dao.category'] = $app->share(function ($app) {
    return new LudusVisualis\DAO\CategoryDAO($app['db']);
});

$app['dao.console'] = $app->share(function ($app) {
    return new LudusVisualis\DAO\ConsoleDAO($app['db']);
});

$app['dao.comment'] = $app->share(function ($app) {
    return new LudusVisualis\DAO\CommentDAO($app['db']);
});
$app['session']->set('DefaultLanguage','fr_FR');

//traduction to FR
// @TODO : use namespace instead
set_include_path(__DIR__);
require_once('\\Ressources\\Translations\\TranslationFr.php');
$translation = new TranslationFr();
$app['translator']->addLoader('array', new ArrayLoader());
$app['translator']->addResource('array', $translation->getTranslation(), 'fr_FR');


define('IMAGES', '/LudusVisualis/images');

if($app['session']->get('UserLanguage') == null){
    $app['translator']->setLocale($app['session']->get('DefaultLanguage'));
}
else{
    $app['translator']->setLocale($app['session']->get('UserLanguage'));
}
define('_LOCALE', $app['translator']->getLocale());