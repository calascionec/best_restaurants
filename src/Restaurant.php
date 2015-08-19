<?php

    class Restaurant
    {
        private $name;
        private $location;
        private $hours;
        private $description;
        private $cuisine_id;
        private $id;

        function __construct($name, $location, $hours, $description, $cuisine_id, $id = null)
        {
            $this->name = $name;
            $this->location = $location;
            $this->hours = $hours;
            $this->description = $description;
            $this->cuisine_id = $cuisine_id;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getLocation()
        {
            return $this->location;
        }

        function setLocation($new_location)
        {
            $this->location = $new_location;
        }

        function getHours()
        {
            return $this->hours;
        }

        function setHours($new_hours)
        {
            $this->hours = $new_hours;
        }

        function getDescription()
        {
            return $this->description;
        }

        function setDescription()
        {
            $this->description = $description;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }
    }

?>
