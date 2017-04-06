<?php

namespace IrishTitan\Handshake\Core;

use IrishTitan\Handshake\Exceptions\ProductNotFoundException;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class Product
{

    /**
     * The product factory instance.
     *
     * @var ProductFactory
     */
    protected $factory;

    /**
     * The product repository instance.
     *
     * @var ProductRepository
     */
    protected $repository;

    /**
     * The product collection instance.
     *
     * @var ProductCollection
     */
    protected $collection;

    /**
     * The magento product instance.
     *
     * @var
     */
    protected $product;

    public function __construct(ProductFactory $factory, ProductRepository $repository, CollectionFactory $collection)
    {
        Handshake::start();

        $this->factory = $factory;
        $this->repository = $repository;
        $this->collection = $collection;
    }

    /**
     * Get the product attributes as properties.
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($name === 'id') {
            return $this->product->getData('entity_id');
        }

        return $this->product->getData($name);
    }

    /**
     * Set the product attributes dynamically via properties.
     *
     * @param $name
     * @param $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        return $this->product->setData($name, $value);
    }

    /**
     * Get the product instance.
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function get()
    {
        return $this->product;
    }

    /**
     * Get all products.
     *
     * @return $this
     */
    public function all()
    {
        return $this->collection->create()->addAttributeToSelect('*');
    }

    /**
     * Find the product by the given id and throw an error
     * if it is not found.
     *
     * @param $id
     * @return ProductInterface|mixed
     * @throws ProductNotFoundException
     */
    public function findOrFail($id)
    {
        try {

            $this->product = $this->repository->getById($id);

        } catch (NoSuchEntityException $exception) {

            throw new ProductNotFoundException;

        }

        return $this;
    }

    /**
     * Find the product by the given id.
     *
     * @param $id
     * @return ProductInterface|mixed|null
     */
    public function find($id)
    {
        try {

            $this->product = $this->repository->getById($id);

        } catch (NoSuchEntityException $exception) {

            return null;

        }

        return $this;
    }

    /**
     * Get a product by sku.
     *
     * @param $sku
     * @return $this|null
     */
    public function whereSku($sku)
    {
        try {

            $this->product = $this->repository->get($sku);

        } catch (NoSuchEntityException $exception) {

            return null;

        }

        return $this;
    }

    /**
     * Save the product.
     *
     * @return $this
     */
    public function save()
    {
        $this->product = $this->repository->save($this->product);

        return $this;
    }

    /**
     * Delete the given product.
     *
     * @return void
     */
    public function delete()
    {
        $this->repository->delete($this->product);
    }

    /**
     * Create a new product.
     *
     * @param $attributes
     * @return $this
     */
    public function create($attributes)
    {
        $this->product = $this->factory->create();

        $this->product->setSku($attributes['sku']);
        $this->product->setName($attributes['name']);
        $this->product->setAttributeSetId(isset($attributes['attributeSetId']) ?: 4);
        $this->product->setStatus(isset($attributes['status']) ?: 1);
        $this->product->setWeight($attributes['weight']);
        $this->product->setVisibility(isset($attributes['visibility']) ?: 4);
        $this->product->setTaxClassId(isset($attributes['taxClassId']) ?: 0);
        $this->product->setTypeId(isset($attributes['typeId']) ?: 'simple');
        $this->product->setPrice($attributes['price']);
        $this->product->setDescription(isset($attributes['description']) ?: 'description');
        $this->product->setStockData([
            'use_config_manage_stock' => 0,
            'manage_stock' => 1,
            'is_in_stock' => isset($attributes['inStock']) ?: 1,
            'qty' => $attributes['qty']
        ]);

        return $this->save();
    }

}