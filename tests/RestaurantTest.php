<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=best_restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Bar Bar";
            $location = "1234 Somewhere Ave";
            $hours = "9AM to 9PM";
            $description = "A place to eat";
            $cuisine_id = 1;
            $test_restaurant = new Restaurant($name, $location, $hours, $description, $cuisine_id);

            //Act
            $result = $test_restaurant->getName();

            //Assert
            $this->assertEquals($name, $result);
        }
    }
?>
