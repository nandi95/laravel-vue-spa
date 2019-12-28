<?php

namespace Tests\Unit;

use Tests\TestCase;

class HelpersTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function snake_array_keys()
    {
        // Arrange
        $data = ['testKey' => 'value'];

        // Act
        $data = snake_array_keys($data);

        // Assert
        $this->assertEquals(['test_key' => 'value'], $data);
    }


    /**
     * @test
     *
     * @return void
     */
    public function camel_array_keys()
    {
        // Arrange
        $data = ['test_key' => 'value'];

        // Act
        $data = camel_array_keys($data);

        // Assert
        $this->assertEquals(['testKey' => 'value'], $data);
    }
}
