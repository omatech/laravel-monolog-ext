<?php

namespace Omatech\LaravelMonologExt\Contracts;

interface MonologLogging
{

    public function pushHandler(\Monolog\Logger $monolog);
}
