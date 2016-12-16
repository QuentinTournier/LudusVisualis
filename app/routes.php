
<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use LudusVisualis\Domain\User;
use LudusVisualis\Domain\Basket;
use LudusVisualis\Form\Type\UserType;

// Home page
$app->get('/', function () use ($app) {
    $games = $app['dao.game']->findAll();
    return $app['twig']->render('index.html.twig', array('games' => $games));
})->bind('home');

//Display a game
$app->get('/game/{id}', function ($id) use ($app) {
    
    $game = $app['dao.game']->find($id);
    $user = $app['dao.user']->find($app['user']->getId());
    $ordered = $app['dao.basket']->existsInBasket($game, $user);
    return $app['twig']->render('game.html.twig', array('game' => $game, 'ordered' =>$ordered));

})->bind('game');

//Display a category
$app->get('/categorie/{categorie}', function ($categorie) use ($app) {
    $games = $app['dao.game']->findAllFromCategorie($categorie);
    return $app['twig']->render('categorie.html.twig', array('games' => $games));
})->bind('categorie');

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');

// Signup form
$app->get('/signup', function(Request $request) use ($app) {
    $user = new User();
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.digest'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $user->setRole("ROLE_USER");
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
    }
    return $app['twig']->render('signup.html.twig', array(
        'title' => 'New user',
        'userForm' => $userForm->createView()));
})->bind('signup')->method('POST|GET');

// Show informations about user
$app->get('/userSettings', function(Request $request) use ($app) {
    $params = [
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username')
        ];
    return $app['twig']->render('update_user.html.twig', $params);
    
})->bind('userSettings');

// Show informations about user
$app->match('/editUser', function(Request $request) use ($app) {
    $params = [
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
        'edit' => true,
        ];
    return $app['twig']->render('update_user.html.twig', $params);
})->bind('edit_user');

// Update user informations
$app->match('/userUpdate', function(Request $request) use ($app) {
    $email = $request->request->get('email');
    $app['user']->setEmail($email);
    $firstName = $request->request->get('firstName');
    $lastName = $request->request->get('lastName');
    $zip = $request->request->get('zip');
    $city = $request->request->get('city');
    $address = $request->request->get('address');
    $params = ['user_email'=> $email,
               'user_firstName' => $firstName,
               'user_lastName' => $lastName,
               'user_zip' => $zip,
               'user_city' =>$city,
               'user_address' => $address
              ];
    $app['dao.user']->updateUser($app['user'], $params);

     $app['session']->getFlashBag()->add('success', 'Your informations were changed successfully');
    return new RedirectResponse($app["url_generator"]->generate("home"));
    
})->bind('profile_update');

//Display the basket of the current user
$app->get('/basket', function () use ($app) {
    $user = $app['user'];
    $orders = $app['dao.basket']->findAllByUser($user->getId());
    return $app['twig']->render('basket.html.twig', array(
        'orders' => $orders));
})->bind('basket');

// add Game to basket
$app->match('/basket/{id}/add', function($id,Request $request) use ($app) {
    if(!$app['dao.basket']->existsInBasket($app['dao.game']->find($id),$app['user'])){
        $app['dao.basket']->addInBasket($app['dao.game']->find($id),$app['user']);
    }
    
    $app['session']->getFlashBag()->add('success', 'The game has been succesfully added into the basket');
    // Redirect to product page
    $game = $app['dao.game']->find($id);
    $app['dao.game']->removeOne($game);
    return new RedirectResponse($app["url_generator"]->generate("home"));
})->bind('add_product_basket');

//Delete an order
$app->get('/deleteFrombasket/{gameId}', function ($gameId) use ($app) {
    $user = $app['user'];
    $game = $app['dao.game']->find($gameId);
    $app['dao.basket']->deleteOrder($game, $user); 
    $app['session']->getFlashBag()->add('success', 'The game has been successfully deleted from the basket');
    return new RedirectResponse($app["url_generator"]->generate("basket"));
})->bind('deleteOrder');

//Get all categories
$app->get('/getCategories', function () use ($app) {
    $categoryArray = [];
    $categories = $app['dao.category']->getAllCategories();
    foreach($categories as $category){
        $categoryArray[] = $category->getName();
    }
    return new JSONResponse($categoryArray);
})->bind('getCategories');
