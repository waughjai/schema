<?php

declare( strict_types = 1 );
use PHPUnit\Framework\TestCase;
use WaughJ\Schema\Schema;

class SchemaTest extends TestCase
{
	public function testInvalidSchema() : void
	{
		$schema = new Schema( 'afsdfsf' );
		$this->assertEquals( $schema->getScript(), '' );
		$schema = new Schema( '{asfsdf:["adad",2,4}' );
		$this->assertEquals( $schema->getScript(), '' );
	}

	public function testValidSchema() : void
	{
		$schema = new Schema();
		$this->assertNotEquals( $schema->getScript(), '' );
		$schema = new Schema([]);
		$this->assertNotEquals( $schema->getScript(), '' );
		$schema = new Schema('{}');
		$this->assertNotEquals( $schema->getScript(), '' );
		$schema = new Schema('[]');
		$this->assertNotEquals( $schema->getScript(), '' );
	}

	public function testEmptySchema() : void
	{
		$schema = new Schema();
		$this->assertEquals( $schema->getScript(), self::EMPTY_SCHEMA_EXPECTED_CONTENT );
		$schema = new Schema([]);
		$this->assertEquals( $schema->getScript(), self::EMPTY_SCHEMA_EXPECTED_CONTENT );
		$schema = new Schema('{}');
		$this->assertEquals( $schema->getScript(), self::EMPTY_SCHEMA_EXPECTED_CONTENT );
		$schema = new Schema('[]');
		$this->assertEquals( $schema->getScript(), self::EMPTY_SCHEMA_EXPECTED_CONTENT );
	}

	private const EMPTY_SCHEMA_EXPECTED_CONTENT = '<script type="application/ld+json">{"@context":"https:\/\/schema.org"}</script>';
}
