<?php

namespace IrishTitan\Handshake\Core\Entities;

use Illuminate\Support\Collection;
use IrishTitan\Handshake\Core\MagentoEntity;
use IrishTitan\Handshake\Exceptions\ProductNotFoundException;
use IrishTitan\Handshake\Facades\Category as CategoryFacade;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class Product extends MagentoEntity
{
    /**
     * The Magento Product instance.
     *
     * @var \Magento\Catalog\Model\Product
     */
    protected $entity;

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
     * Find the product by the given id.
     *
     * @param $id
     * @param int $store
     * @return ProductInterface|mixed|null
     */
    public function find($id, $store = null)
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
    public function findOrFail($id, $store = null)
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
    public function whereSku($sku, $store = null)
    {
        try {

            $this->entity = $this->repository->get($sku, false, $store);

        } catch (NoSuchEntityException $exception) {

            return null;

        }

        return $this;
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
     * Get all the categories this product is in.
     *
     * @return Collection
     */
    public function categories()
    {
        return collect($this->entity->getCategoryIds())
            ->map(function ($categoryId) {
                return CategoryFacade::find($categoryId);
            });
    }

    /**
     * Add this product to a category.
     *
     * @param Category $category
     * @return $this
     */
    public function assignToCategory(Category $category)
    {
        $existingCategories = $this->entity->getCategoryIds();

        $existingCategories[] = $category->id;

        $this->entity->setCategoryIds($existingCategories);

        return $this->save();
    }

    /**
     * Get all products.
     *
     * @param int $store
     * @return Collection
     */
    public function all($store = null)
    {
        return collect($this->collection->create()
            ->addAttributeToSelect('*')
            ->setStoreId($store)->load())
            ->map(function ($item, $key) {

                $instance = $this->instantiate();
                $instance->entity = $item;

                return $instance;
            });
    }

    /**
     * Fill in the product with default data.
     *
     * @return void
     */
    protected function fillDefaults()
    {
        $this->entity->setName($this->faker->word);
        $this->entity->setSku(uniqid());
        $this->entity->setAttributeSetId(4);
        $this->entity->setStatus(1);
        $this->entity->setWeight($this->faker->numberBetween(1, 10));
        $this->entity->setVisibility(4);
        $this->entity->setTaxClassId(0);
        $this->entity->setTypeId('simple');
        $this->entity->setPrice($this->faker->numberBetween(1, 500));
        $this->entity->setStockData([
            'use_config_manage_stock' => 0,
            'manage_stock' => 1,
            'is_in_stock' => 1,
            'qty' => 10
        ]);
    }

    /**
     * Run through a list of filters before we
     * attempt to return an attribute dynamically.
     *
     * @param $name
     * @return mixed|string
     */
    protected function checkGetFilters($name)
    {
        if ($name === 'id') {
            return $this->entity->getData('entity_id');
        }

        return false;
    }

    /**
     * Run through this list of filters before we attempt
     * to set the product attribute via properties.
     *
     * @param $name
     * @param $value
     * @return bool
     */
    protected function checkSetFilters($name, $value)
    {
        if ($name === 'qty') {
            return $this->entity->setStockData(['qty' => $value]);
        }

        return false;
    }

}