<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = "mysql:host=localhost;dbname=best_restaurants_test";
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Italian";
            $test_Cuisine = new Cuisine($name);

            //Act
            $result = $test_Cuisine->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Italian";
            $id = 1;
            $test_Cuisine = new Cuisine($name, $id);

            //Act
            $result = $test_Cuisine->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Italian";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_cuisine, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Italian";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();

            $name2 = "Chinese";
            $test_cuisine2 = new Cuisine($name);
            $test_cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Italian";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();

            $name2 = "Chinese";
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);

        }

        function testGetRestaurants()
        {
            //Arrange
            $name = "Italian";
            $test_cuisine = new Cuisine($name);
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
            $result = $test_cuisine->getRestaurants();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Italian";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();

            $new_name = "Greek";

            //Act
            $test_cuisine->update($new_name);

            //Assert
            $this->assertEquals("Greek", $test_cuisine->getName());
        }

        function testDelete()
        {
            //Arrange
            $name = "Italian";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();

            $name2 = "Greek";
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            //Act
            $test_cuisine->delete();

            //Assert
            $this->assertEquals([$test_cuisine2], Cuisine::getAll());
        }

        function testDeleteCuisineRestaurants()
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

            //Act
            $test_cuisine->delete();

            //Assert
            $this->assertEquals([], Restaurant::getAll());
        }
    }

 ?>
