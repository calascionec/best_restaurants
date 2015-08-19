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

        function test_getLocation()
        {
            //Arrange
            $name = "Bar Bar";
            $location = "1234 Somewhere Ave";
            $hours = "9AM to 9PM";
            $description = "A place to eat";
            $cuisine_id = 1;
            $test_restaurant = new Restaurant($name, $location, $hours, $description, $cuisine_id);

            //Act
            $result = $test_restaurant->getLocation();

            //Assert
            $this->assertEquals($location, $result);
        }

        function test_getHours()
        {
            //Arrange
            $name = "Bar Bar";
            $location = "1234 Somewhere Ave";
            $hours = "9AM to 9PM";
            $description = "A place to eat";
            $cuisine_id = 1;
            $test_restaurant = new Restaurant($name, $location, $hours, $description, $cuisine_id);

            //Act
            $result = $test_restaurant->getHours();

            //Assert
            $this->assertEquals($hours, $result);
        }

        function test_getDescription()
        {
            //Arrange
            $name = "Bar Bar";
            $location = "1234 Somewhere Ave";
            $hours = "9AM to 9PM";
            $description = "A place to eat";
            $cuisine_id = 1;
            $test_restaurant = new Restaurant($name, $location, $hours, $description, $cuisine_id);

            //Act
            $result = $test_restaurant->getDescription();

            //Assert
            $this->assertEquals($description, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Bar Bar";
            $location = "1234 Somewhere Ave";
            $hours = "9AM to 9PM";
            $description = "A place to eat";
            $cuisine_id = 1;
            $test_restaurant = new Restaurant($name, $location, $hours, $description, $cuisine_id);

            //Act
            $test_restaurant->save();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Bar Bar";
            $location = "1234 Somewhere Ave";
            $hours = "9AM to 9PM";
            $description = "A place to eat";
            $cuisine_id = 1;
            $test_restaurant = new Restaurant($name, $location, $hours, $description, $cuisine_id);
            $test_restaurant->save();

            $name2 = "Pizza";
            $location2 = "34 Pizza St";
            $hours2 = "10PM to 10:05PM";
            $description2 = "A pizza joint";
            $cuisine_id2 = 2;
            $test_restaurant2 = new Restaurant($name2, $location2, $hours2, $description2, $cuisine_id2);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }
    }
?>
