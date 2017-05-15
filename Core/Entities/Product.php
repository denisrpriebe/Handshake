<?php

namespace IrishTitan\Handshake\Core\Entities;

use Illuminate\Support\Collection;
use IrishTitan\Handshake\Core\MagentoEntity;
use IrishTitan\Handshake\Exceptions\ProductNotFoundException;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class Product extends MagentoEntity
{
    /**
     * Product constructor.
     *
     * @param ProductFactory $factory
     * @param ProductRepository $repository
     * @param CollectionFactory $collection
     */
    public function __construct(ProductFactory $factory, ProductRepository $repository, CollectionFactory $collection)
    {
        parent::__construct();

        $this->factory = $factory;
        $this->repository = $repository;
        $this->collection = $collection;
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
        return $this->checkFilters($name, $value) ?:
            $this->entity->setData($name, $value);
    }

    /**
     * Get all products.
     *
     * @param int $store
     * @return Collection
     */
    public function all($store = 0)
    {
        return collect($this->collection->create()
            ->addAttributeToSelect('*')
            ->setStoreId($store)
            ->load())
            ->map(function ($item, $key) {

                $instance = $this->instantiate();
                $instance->entity = $item;

                return $instance;
            });
    }

    /**
     * Find the product by the given id.
     *
     * @param $id
     * @param int $store
     * @return ProductInterface|mixed|null
     */
    public function find($id, $store = 0)
    {
        try {

            $this->entity = $this->repository->getById($id, false, $store);

        } catch (NoSuchEntityException $exception) {

            return null;

        }

        return $this;
    }

    /**
     * Find the product by the given id and throw an error
     * if it is not found.
     *
     * @param $id
     * @param int $store
     * @return ProductInterface|mixed
     * @throws ProductNotFoundException
     */
    public function findOrFail($id, $store = 0)
    {
        try {

            $this->entity = $this->repository->getById($id, false, $store);

        } catch (NoSuchEntityException $exception) {

            throw new ProductNotFoundException;

        }

        return $this;
    }

    /**
     * Get a product by sku.
     *
     * @param $sku
     * @param int $store
     * @return $this|null
     */
    public function whereSku($sku, $store = 0)
    {
        try {

            $this->entity = $this->repository->get($sku, false, $store);

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
        $this->entity = $this->repository->save($this->entity);

        return $this;
    }

    /**
     * Delete the given product.
     *
     * @return void
     */
    public function delete()
    {
        $this->repository->delete($this->entity);
    }

    /**
     * Add an image to the product.
     *
     * @param $image
     * @return $this
     */
    public function addImage($image)
    {
        $this->entity->addImageToMediaGallery($image,
            ['image', 'small_image', 'thumbnail'], false, false);

        $this->entity->save();

        return $this;
    }

    /**
     * Get the product's images.
     *
     * @return Collection
     */
    public function images()
    {
        return collect($this->entity->getMediaGallery('images'));
    }

    /**
     * Create a new product and save it to the database.
     *
     * @param array $attributes
     * @return Product
     */
    public function create(array $attributes)
    {
        $this->make($attributes);

        return $this->save();
    }

    /**
     * Make a new product. Does not save to the
     * database right away.
     *
     * @param array $attributes
     * @return $this
     */
    public function make(array $attributes)
    {
        $this->entity = $this->factory->create();

        $this->fillDefaults();

        foreach ($attributes as $key => $attribute) {
            $this->entity->setData($key, $attribute);
        }

        return $this;
    }

    /**
     * Fill in the product with default data.
     *
     * @return void
     */
    protected function fillDefaults()
    {
        $this->entity->setSku(uniqid());
        $this->entity->setAttributeSetId(4);
        $this->entity->setStatus(1);
        $this->entity->setWeight(1);
        $this->entity->setVisibility(4);
        $this->entity->setTaxClassId(0);
        $this->entity->setTypeId('simple');
        $this->entity->setPrice('5.00');
        $this->entity->setStockData([
            'use_config_manage_stock' => 0,
            'manage_stock' => 1,
            'is_in_stock' => 1,
            'qty' => 10
        ]);
    }

    /**
     * Run through this list of filters before we attempt
     * to set the product attribute via properties.
     *
     * @param $name
     * @param $value
     * @return bool
     */
    private function checkFilters($name, $value)
    {
        switch ($name) {

            case 'qty':
                $this->entity->setStockData(['qty' => $value]);
                return true;

            default:
                return false;
        }
    }

}