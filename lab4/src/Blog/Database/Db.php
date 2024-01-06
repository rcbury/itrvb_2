<?php

namespace lab3\Blog\Database;

use SQLite3;

class Db extends SQLite3
{
	function __construct($file)
	{
		$this->open($file);
	}
}

?>