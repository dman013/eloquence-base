<?php

namespace Dmn013\Eloquence\Contracts;

interface AttributeBag
{
    public function set($key, $value, $group = null);
    public function getValue($key);
    public function getMetaByGroup($group);
}
