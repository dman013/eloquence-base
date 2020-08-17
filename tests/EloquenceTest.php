<?php

namespace Dmn013\Eloquence\Tests;

use Mockery as m;
use Dmn013\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Model;

class EloquenceTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        EloquenceStub::clearHooks();
    }

    public function tearDown()
    {
        m::close();
    }

    /**
     * @test
     * @covers \Dmn013\Eloquence\Eloquence::newEloquentBuilder
     */
    public function it_uses_custom_builder()
    {
        $query   = m::mock('\Illuminate\Database\Query\Builder');
        $builder = (new EloquenceStub)->newEloquentBuilder($query);

        $this->assertInstanceOf('\Dmn013\Eloquence\Builder', $builder);
    }

    /**
     * @test
     * @covers \Dmn013\Eloquence\Eloquence::hasColumn
     * @covers \Dmn013\Eloquence\Eloquence::getColumnListing
     * @covers \Dmn013\Eloquence\Eloquence::loadColumnListing
     */
    public function it_loads_and_checks_the_column_listing()
    {
        $schema = m::mock('StdClass');
        $schema->shouldReceive('getColumnListing')->once()->andReturn(['foo', 'bar', 'baz']);

        $connection = m::mock('StdClass');
        $connection->shouldReceive('getSchemaBuilder')->once()->andReturn($schema);

        $resolver = m::mock('\Illuminate\Database\ConnectionResolverInterface');
        $resolver->shouldReceive('connection')->once()->andReturn($connection);

        EloquenceStub::setConnectionResolver($resolver);

        $model = new EloquenceStub;

        $this->assertTrue($model->hasColumn('foo'));
        $this->assertFalse($model->hasColumn('wrong'));
        $this->assertEquals(['foo', 'bar', 'baz'], $model->getColumnListing());
    }

    /**
     * @test
     * @covers \Dmn013\Eloquence\Eloquence::hook
     */
    public function it_registers_and_call_hooks_on_eloquent_methods()
    {
        $model = new EloquenceStub;

        EloquenceStub::hook('__isset', $model->__issetExtensionStub());

        $this->assertFalse(isset($model->foo));

        $model->foo = 1;
        $this->assertFalse(isset($model->foo));
    }
}

class EloquenceStub extends Model
{
    use Eloquence, ExtensionStub;

    public static function clearHooks()
    {
        static::$hooks = [];
    }
}

trait ExtensionStub
{
    public function __issetExtensionStub()
    {
        return function () {
            return false;
        };
    }
}
