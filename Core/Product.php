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
        $this->repository->save($this->product);

        return $this;
    }

}