<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=best_restaurants';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //Root route
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    //Add cuisine
    $app->post('/cuisines', function() use ($app) {
        $cuisine = new Cuisine($_POST['name']);
        $cuisine->save();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    //Delete all cuisines
    $app->post('/delete_cuisines', function() use ($app) {
        Cuisine::deleteAll();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    //Display one cuisine
    $app->get("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    //Add a restaurant to a cuisine page
    $app->post('/restaurants', function() use ($app) {
        $name = $_POST['name'];
        $location = $_POST['location'];
        $hours = $_POST['hours'];
        $description = $_POST['description'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($name, $location, $hours, $description, $cuisine_id);
        $restaurant->save();
        $cuisine = Cuisine::find($cuisine_id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    //Update page for a cuisine
    $app->get("/cuisines/{id}/edit", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('edit_cuisine.html.twig', array('cuisine' => $cuisine));
    });


    // updates name of cuisine and returns to root route
    $app->patch("/cuisines/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $cuisine = Cuisine::find($id);
        $cuisine->update($name);
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    // delete cuisine and return to root route
    $app->delete("/cuisines/{id}/delete", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        $cuisine->delete();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    //display update page for restaurant
    $app->get("/restaurants/{id}/edit", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        $cuisine_id = $restaurant->getCuisineId();
        return $app['twig']->render('edit_restaurant.html.twig', array('restaurant' => $restaurant, 'cuisine' => $cuisine_id));
    });

    //update restaurant details that have been changed
    $app->patch('/restaurants/{id}', function($id) use ($app) {
            $restaurant = Restaurant::find($id);
            $cuisine = Cuisine::find($_POST['cuisine_id']);
            foreach($_POST as $key => $value) {
                if ( !empty($value) ) {
                    $restaurant->update($key, $value);
                }
            }
            return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));

    });

    // delete restaurant and return to cuisine route
    $app->delete("/restaurants/{id}/delete", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        $restaurant->delete();
        $cuisine = Cuisine::find($_POST['cuisine_id']);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    //Delete all restaurants
    $app->post('/delete_restaurants', function() use ($app) {
        Restaurant::deleteAll();
        $cuisine = Cuisine::find($_POST['cuisine_id']);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });


    return $app;
?>
