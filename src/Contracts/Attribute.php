<?php

namespace Dmn013\Eloquence\Contracts;

interface Attribute
{
    /**
     * Create new AttributeBag.
     *
     * @param  array  $models
     * @return \Dmn013\Eloquence\Metable\AttributeBag
     */
    public function newCollection(array $models = []);

    /**
     * Get the meta attribute value.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Get the meta attribute key.
     *
     * @return string
     */
    public function getKey();
    /**
     * Get the meta attribute group.
     *
     * @return string
     */
    public function getMetaGroup();
    /**
     * Set value of the meta attribute.
     *
     * @param mixed $value
     *
     * @throws \Dmn013\Eloquence\Exceptions\InvalidTypeException
     */
    public function setValue($value);

    /**
     * Handle casting value to string.
     *
     * @return string
     */
    public function castToString();
}
