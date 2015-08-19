<?php

    class Cuisine
    {
        private id;
        private name;

        function __contruct($name, $id = null)
        {
            $this->id = $id;
            $this->name = $name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        
    }

 ?>
