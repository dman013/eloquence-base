<?php

namespace Dmn013\Eloquence\Contracts;

interface CleansAttributes
{
    public static function getColumnListing();
    public function getDirty();
}
