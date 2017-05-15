<?php

namespace IrishTitan\Handshake\Core;

abstract class MagentoEntity
{
    /**
     * The factory instance.
     *
     * @var
     */
    protected $factory;

    /**
     * The repository instance.
     *
     * @var
     */
    protected $repository;

    /**
     * The collection instance.
     *
     * @var
     */
    protected $collection;

    /**
     * The entity instance.
     *
     * @var
     */
    protected $entity;

    /**
     * MagentoEntity constructor.
     *
     */
    public function __construct()
    {
        Handshake::start();
    }

    /**
     * Get the entity attributes as properties.
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($name === 'id') {
            return $this->entity->getData('entity_id');
        }

        return $this->entity->getData($name);
    }

    /**
     * Set the entity attributes dynamically via properties.
     *
     * @param $name
     * @param $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        return $this->entity->setData($name, $value);
    }

    /**
     * Get the entity instance.
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function get()
    {
        return $this->entity;
    }

    /**
     * Create a new instance of the entity.
     *
     * @return static
     */
    protected function instantiate()
    {
        return App::make(static::class);
    }

}