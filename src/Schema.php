<?php

declare( strict_types = 1 );
namespace WaughJ\Schema
{
	class Schema
	{
		//
		//  PUBLIC
		//
		/////////////////////////////////////////////////////////

			public function __construct( $init_data = null )
			{
				if ( is_string( $init_data ) )
				{
					$this->schema = ( array )( json_decode( $init_data ) );
					if ( json_last_error() === JSON_ERROR_NONE )
					{
						$this->schema[ "@context" ] = "https://schema.org";
					}
					else
					{
						throw new InvalidSchemaException();
					}
				}
				else if ( is_array( $init_data ) )
				{
					$this->schema = $init_data;
					$this->schema[ "@context" ] = "https://schema.org";
				}
				else if ( is_a( $init_data, '\WaughJ\Schema\Schema' ) )
				{
					$this->schema = $init_data->getData();
				}
				else
				{
					$this->schema = [];
					$this->schema[ "@context" ] = "https://schema.org";
				}
			}

			public function __toString()
			{
				return $this->getText();
			}

			public function print() : void
			{
				echo $this;
			}

			public function getScript() : string
			{
				$schema_text = $this->getSchemaText();
				return ( $schema_text === '' ) ? '' : '<script type="application/ld+json">' . $schema_text . '</script>';
			}

			public function getData() : array
			{
				return $this->schema;
			}

			// Creates new schema without changing this schema to keep class immutable.
			public function addEntry( $index, $value ) : \WaughJ\Schema\Schema
			{
				$schema_data = $this->schema;
				$schema_data[ $index ] = $value;
				return new Schema( $schema_data );
			}



		//
		//  PRIVATE
		//
		/////////////////////////////////////////////////////////

			private function getSchemaText() : string
			{
				return ( $this->schema === null ) ? '' : json_encode( $this->schema );
			}

			private $schema;
	}
}
