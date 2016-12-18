
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
    if($app['user']!== null){
        $app['session']->set('nbArticles', $app['dao.basket']->findChartSize($app['user']));
    }
    $games = $app['dao.game']->findAll(_LOCALE);
    $consoles = $app['dao.console']->findAllConsoles(_LOCALE);
    $consolesData = [];
    foreach($consoles as $console){
        $consolesData[] = ['name'=>$console->getName(), 'id'=> $console->getId()];
    }
    return $app['twig']->render('index.html.twig', ['games' => $games, 'consoles' =>$consolesData, 'imagePath' => IMAGES]);
})->bind('home');

// Home page, filtered by console
$app->get('/console/{consoleId}', function ($consoleId) use ($app) {
    $games = $app['dao.game']->getAllGamesFromConsole($consoleId, _LOCALE);
    $consoles = $app['dao.console']->findAllConsoles(_LOCALE);
    $consolesData = [];
    foreach($consoles as $console){
        $consolesData[] = ['name'=>$console->getName(), 'id'=> $console->getId()];
    }
    $console = $app['dao.console']->findConsole($consoleId, _LOCALE);
    $pathImage = IMAGES ."/" . $console->getImage();
    
    return $app['twig']->render('index.html.twig', [
        'games' => $games,
        'consoles' =>$consolesData,
        'pathImage' => $pathImage,
        'consoleShortName' => $console->getShortName(),
        'imagePath' => IMAGES
        ]
    );
})->bind('console');

//Display a game
$app->get('/game/{id}', function ($id) use ($app) {
    
    $game = $app['dao.game']->find($id, _LOCALE);
    $user = $app['user'];
    if($user === null){
        $ordered = false;
    }
    else{
        $ordered = $app['dao.basket']->existsInBasket($game, $user);   
    }
    if($app['user']!== null){
        $app['session']->set('nbArticles', $app['dao.basket']->findChartSize($app['user']));
    }
    $comments = $app['dao.comment']->getAllCommentsForGame($game);
    $gameData = ['id'=> $game->getId(),
                 'name' => $game->getName(),
                 'descriptionLong' => $game->getDescriptionLong(),
                 'price' => $game->getPrice(),
                 'year' => $game->getYear(),
                 'number' => $game->getNumber(),
                 'type' => $game->getType()
                ];
    $connected = ($app['user'] == null) ? false : true;
    $commentsData = [];
    foreach ($comments as $comment){
        $userCommenting = $app['dao.user']->find($comment->getUserId());
        if ($app['user'] === null){
            $own = false;
        }
        else{
            $own = ($userCommenting->getId() === $app['user']->getId());
        }
        $commentsData []= [
            'userName' => $userCommenting->getName(),
            'commentText' => $comment->getCommentText(),
            'rating' => $comment->getRating(),
            'own' => $own,
            'id' => $comment->getId()
        ];
    }
    return $app['twig']->render(
        'game.html.twig', [
            'game' => $gameData,
            'ordered' =>$ordered,
            'pathImage' =>IMAGES. "/". $game->getImage(),
            'comments' => $commentsData,
            'connected' => $connected,
        ]
    );
})->bind('game');

//Display a category
$app->get('/categorie/{categorie}', function ($categorie) use ($app) {
    $games = $app['dao.game']->findAllFromCategorie($categorie, _LOCALE);
    $consoles = $app['dao.console']->findAllConsoles(_LOCALE);
    $consolesData = [];
    foreach($consoles as $console){
        $consolesData[] = ['name'=>$console->getName(), 'id'=> $console->getId()];
    }
    return $app['twig']->render('index.html.twig', array('games' => $games,'consoles' => $consolesData, 'imagePath' => IMAGES));
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
        
        return new RedirectResponse($app["url_generator"]->generate("login"));
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
    if($user === null){
        return new RedirectResponse($app["url_generator"]->generate("home"));
    }
    $orders = $app['dao.basket']->findAllByUser($user, Basket::ORDERING);
    $games= [];
    foreach($orders as $order){
        $game = $app['dao.game']->find($order->getGameId(), _LOCALE);
        $games[] = ['name' => $game->getName(), 'id' => $game->getId(), 'price'=> $game->getPrice()];
    }
    $userParams = ['address' =>$user->getAddress(), 'city' => $user->getCity()];
    return $app['twig']->render('basket.html.twig', ['games'=>$games, 'userInfos' => $userParams]);
})->bind('basket');

// add Game to basket
$app->match('/basket/{id}/add', function($id,Request $request) use ($app) {
    if($app['user'] === null){
        return new RedirectResponse($app["url_generator"]->generate("home"));
    }
    if(!$app['dao.basket']->existsInBasket($app['dao.game']->find($id, _LOCALE),$app['user'])){
        $app['dao.basket']->addInBasket($app['dao.game']->find($id, _LOCALE),$app['user'], $app['dao.game']);
    }
    if($app['user']!== null){
        $app['session']->set('nbArticles', $app['dao.basket']->findChartSize($app['user']));
    }
    
    $app['session']->getFlashBag()->add('success', 'The game has been succesfully added into the basket');
    // Redirect to product page
    $game = $app['dao.game']->find($id, _LOCALE);
    return new RedirectResponse($app["url_generator"]->generate("home"));
})->bind('add_product_basket');

//Delete an order
$app->get('/deleteFrombasket/{gameId}', function ($gameId) use ($app) {
    $user = $app['user'];
    $game = $app['dao.game']->find($gameId, _LOCALE);
    $success = $app['dao.basket']->deleteOrder($game, $user,$app['dao.game']); 
    if($success){
        $app['session']->getFlashBag()->add('success', 'The game has been successfully deleted from the basket');
    }
    return new RedirectResponse($app["url_generator"]->generate("basket"));
})->bind('deleteOrder');

//Get all categories
$app->get('/getCategories', function () use ($app) {
    $categoryArray = [];
    $categories = $app['dao.category']->getAllCategories(_LOCALE);
    foreach($categories as $category){
        $categoryArray[] = ['name' => $category->getName(), 'id' => $category->getId()];
    }
    return new JSONResponse($categoryArray);
})->bind('getCategories');

//Order the basket
$app->get('/Basket/Order', function() use ($app){
    $user = $app['user'];
    $app['dao.basket']->orderBasket($user);
    
    return new RedirectResponse($app["url_generator"]->generate("summary"));
})->bind('order');

//See what we have ordered
$app->get('/Basket/Summary', function() use ($app){
    $user = $app['user'];
    if($user === null){
        return new RedirectResponse($app["url_generator"]->generate("home"));
    }
    $orders = $app['dao.basket']->findAllByUser($user, Basket::ORDERED);
    $games = [];
    foreach($orders as $order){
        $game = $app['dao.game']->find($order->getGameId(), _LOCALE);
        $games[] = ['id' => $game->getId(), 'name' => $game->getName()];
    }
    $userParams = ['address' =>$user->getAddress(), 'city' => $user->getCity()];
    return $app['twig']->render('summary.html.twig', ['games' => $games, 'user' => $userParams]);
})->bind('summary');


$app->match('Game/{gameId}/Rate', function(Request $request, $gameId) use ($app){
    $rating = $request->request->get('rating');
    $comment = $request->request->get('comment');
    $rating = ($rating == -1 ? null : $rating);
    $userId = $app['user']->getId();
    $params = [
        'rating'=>$rating,
        'userId' => $userId,
        'commentText' => $comment,
        'gameId' => $gameId
    ];
    $success = $app['dao.comment']->saveComment($params);
    
    return new RedirectResponse($app["url_generator"]->generate("game", ['id'=>$gameId]));
    
})->bind('rateCommentGame');

$app->get('Game/{gameId}/RemoveComment/{commentId}', function($commentId, $gameId)use ($app){
    $comment = $app['dao.comment']->loadComment($commentId);
    $app['dao.comment']->removeComment($comment);

     return new RedirectResponse($app["url_generator"]->generate("game", ['id'=>$gameId]));
    
})->bind('removeComment');

$app->match('ChangeLanguage/{language}/Redirect/{redirectUrl}',function($redirectUrl, $language) use ($app){
    $app['session']->set('UserLanguage', $language);
    //redirect url was modified to be passe, we revert the changes
    $trueRedirectUrl = str_replace('--','/', $redirectUrl);
    return new RedirectResponse($trueRedirectUrl);
})->bind('changeLanguage');
    
