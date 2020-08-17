<?php

namespace Dmn013\Eloquence\Searchable;

use Dmn013\Eloquence\Contracts\Searchable\ParserFactory as FactoryContract;

class ParserFactory implements FactoryContract
{
    /**
     * Create new parser instance.
     *
     * @param  integer $weight
     * @param  string  $wildcard
     * @return \Dmn013\Eloquence\Contracts\Searchable\Parser
     */
    public static function make($weight = 1, $wildcard = '*')
    {
        return new Parser($weight, $wildcard);
    }
}
