<?php

namespace App\Console\Commands\Generators;

use Illuminate\Console\Command;
use Illuminate\Foundation\Console\ModelMakeCommand;
use Illuminate\Support\Str;

/**
 * Class Model
 *
 * @package App\Console\Commands\Generators
 */
class Model extends ModelMakeCommand
{
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('pivot')) {
            return parent::getStub();
        }
        return __DIR__ . '/stubs/model.stub';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        if (!Str::startsWith($name, 'Models\\') && !Str::contains($name, 'Models\\')) {
            $name = 'Models\\' . $name;
        }
        return parent::getPath($name);
    }
}
