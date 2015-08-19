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

        function test_getCuisineId()
        {
            //Arrange
            $cuisine_name = "Italian";
            $test_cuisine = new Cuisine($cuisine_name);
            $test_cuisine->save();

            $name = "Bar Bar";
            $location = "1234 Somewhere Ave";
            $hours = "9AM to 9PM";
            $description = "A place to eat";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $location, $hours, $description, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getCuisineId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
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
            $cuisine_name = "Italian";
            $test_cuisine = new Cuisine($cuisine_name);
            $test_cuisine->save();

            $cuisine_id = $test_cuisine->getId();

            $name = "Bar Bar";
            $location = "1234 Somewhere Ave";
            $hours = "9AM to 9PM";
            $description = "A place to eat";
            $test_restaurant = new Restaurant($name, $location, $hours, $description, $cuisine_id);
            $test_restaurant->save();

            $name2 = "Pizza";
            $location2 = "34 Pizza St";
            $hours2 = "10PM to 10:05PM";
            $description2 = "A pizza joint";
            $test_restaurant2 = new Restaurant($name2, $location2, $hours2, $description2, $cuisine_id);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $cuisine_name = "Italian";
            $test_cuisine = new Cuisine($cuisine_name);
            $test_cuisine->save();

            $cuisine_id = $test_cuisine->getId();

            $name = "Bar Bar";
            $location = "1234 Somewhere Ave";
            $hours = "9AM to 9PM";
            $description = "A place to eat";
            $test_restaurant = new Restaurant($name, $location, $hours, $description, $cuisine_id);
            $test_restaurant->save();

            $name2 = "Pizza";
            $location2 = "34 Pizza St";
            $hours2 = "10PM to 10:05PM";
            $description2 = "A pizza joint";
            $test_restaurant2 = new Restaurant($name2, $location2, $hours2, $description2, $cuisine_id);
            $test_restaurant2->save();

            //Act
            Restaurant::deleteAll();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals([], $result);
        }

        function testUpdateName()
        {
            //Arrange
            $cuisine_name = "Italian";
            $test_cuisine = new Cuisine($cuisine_name);
            $test_cuisine->save();

            $cuisine_id = $test_cuisine->getId();

            $name = "Bar Bar";
            $location = "1234 Somewhere Ave";
            $hours = "9AM to 9PM";
            $description = "A place to eat";
            $test_restaurant = new Restaurant($name, $location, $hours, $description, $cuisine_id);
            $test_restaurant->save();

            $new_name = "The New Spot";
            $column_update = "name";

            //Act
            $test_restaurant->update($column_update, $new_name);

            //Assert
            //$this->assertEquals("The New Spot", $test_restaurant->getName());
            $result = Restaurant::getAll();
            $this->assertEquals("The New Spot", $result[0]->getName());

        }

        function testUpdateLocation()
        {
            //Arrange
            $cuisine_name = "Italian";
            $test_cuisine = new Cuisine($cuisine_name);
            $test_cuisine->save();

            $cuisine_id = $test_cuisine->getId();

            $name = "Bar Bar";
            $location = "1234 Somewhere Ave";
            $hours = "9AM to 9PM";
            $description = "A place to eat";
            $test_restaurant = new Restaurant($name, $location, $hours, $description, $cuisine_id);
            $test_restaurant->save();

            $new_location = "1234 not somewhere circle";
            $column_update = "location";

            //Act
            $test_restaurant->update($column_update, $new_location);

            //Assert
            //$this->assertEquals("The New Spot", $test_restaurant->getName());
            $result = Restaurant::getAll();
            $this->assertEquals("1234 not somewhere circle", $result[0]->getLocation());

        }
    }
?>
