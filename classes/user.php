<?php
    class User
    {
        public $id;
        public $password;
        public function __construct($id, $password)
        {
            $this->id = $id;
            $this->password = $password;
        }
    }
?>