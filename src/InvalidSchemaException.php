<?php

declare( strict_types = 1 );
namespace WaughJ\Schema
{
	class InvalidSchemaException extends \Exception
	{
		public function __construct()
		{
			parent::__construct( "Invalid JSON" );
		}
	}
}
