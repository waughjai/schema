<?php

declare( strict_types = 1 );
use PHPUnit\Framework\TestCase;
use WaughJ\Schema\Schema;
use WaughJ\Schema\InvalidSchemaException;

class SchemaTest extends TestCase
{
	public function testInvalidSchema() : void
	{
		$this->expectException( InvalidSchemaException::class );
		$schema = new Schema( 'afsdfsf' );
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
		$schema = new Schema( $schema );
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
		$schema = new Schema( $schema );
		$this->assertEquals( $schema->getScript(), self::EMPTY_SCHEMA_EXPECTED_CONTENT );
	}

	public function testData() : void
	{
		$schema = new Schema();
		$this->assertTrue( is_array( $schema->getData() ) );
		$schema = new Schema([]);
		$this->assertTrue( is_array( $schema->getData() ) );
		$schema = new Schema('{}');
		$this->assertTrue( is_array( $schema->getData() ) );
		$schema = new Schema('[]');
		$this->assertTrue( is_array( $schema->getData() ) );
	}

	public function testAddEntry() : void
	{
		$schema = new Schema();
		$this->assertEquals( $schema->getScript(), self::EMPTY_SCHEMA_EXPECTED_CONTENT );
		$new_schema = $schema->addEntry( 'name', 'New' ); // Creates new schema.
		$this->assertEquals( $new_schema->getScript(), '<script type="application/ld+json">{"@context":"https:\/\/schema.org","name":"New"}</script>' ); // New value has new value.
		$this->assertEquals( $schema->getScript(), self::EMPTY_SCHEMA_EXPECTED_CONTENT ); // Original schema is unchanged.
	}

	private const EMPTY_SCHEMA_EXPECTED_CONTENT = '<script type="application/ld+json">{"@context":"https:\/\/schema.org"}</script>';
}
