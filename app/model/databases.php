<?php

  class clients extends Model {
    public function __construct($database) {
      $this->construct($database, "clients", array(
				"id" => "int",
				"name" => "varchar_64",
				"company" => "varchar_64",
				"email" => "varchar_64",
				"created" => "int"
      ));
    }
  }

  class projects extends Model {
    public function __construct($database) {
      $this->construct($database, "projects", array(
				"id" => "int",
				"client_id" => "int",
				"name" => "varchar_128",
				"referer" => "varchar_32",
				"status" => "int",
				"status_id" => "int",
				"status_created" => "int",
				"created" => "int"
      ));
    }
  }

  class status extends Model {
    public function __construct($database) {
      $this->construct($database, "status", array(
				"id" => "int",
				"client_id" => "int",
				"project_id" => "int",
				"status" => "varchar_128",
				"date" => "int",
				"comment" => "varchar_512",
				"link" => "varchar_512",
				"created" => "int"
      ));
    }
  }

?>