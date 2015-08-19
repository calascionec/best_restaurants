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
    }

 ?>
