<?php

namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use ReflectionClass;
use ReflectionException;
use Tests\Traits\InteractsWithPermissions;

/**
 * Class TestCase
 *
 * @package Tests
 */
abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;
    use DatabaseMigrations;

    /**
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits()
    {
        $uses = parent::setUpTraits();

        if (isset($uses[InteractsWithPermissions::class])) {
            $this->setupInteractsWithPermissionsTrait();
        }

        return $uses;
    }


    /**
     * Call protected/private method of a class.
     *
     * @param object &$object
     * @param string $methodName
     * @param array  $parameters
     *
     * @return mixed
     *
     * @throws ReflectionException
     */
    public function invokePrivateMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new ReflectionClass(get_class($object));
        $method     = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }


    /**
     * Set protected/private property of a class.
     *
     * @param object &$object
     * @param string $propertyName
     * @param mixed  $value
     *
     * @return void
     *
     * @throws ReflectionException
     */
    public function setPrivateValue(&$object, string $propertyName, $value)
    {
        $reflection = new ReflectionClass(get_class($object));
        $property   = $reflection->getProperty($propertyName);

        $property->setAccessible(true);
        $property->setValue($object, $value);
    }
}
