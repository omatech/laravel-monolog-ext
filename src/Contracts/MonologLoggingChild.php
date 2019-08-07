<?php

namespace Omatech\LaravelMonologExt\Contracts;

interface MonologLoggingChild
{

    public function pushHandler(\Monolog\Logger $monolog);
}
