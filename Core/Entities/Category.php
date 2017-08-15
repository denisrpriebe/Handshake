<?php

namespace IrishTitan\Handshake\Core\Entities;

use Illuminate\Support\Collection;
use IrishTitan\Handshake\Core\Catalog\MagentoEntity;
use IrishTitan\Handshake\Exceptions\CategoryNotFoundException;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface as Store;

class Category extends MagentoEntity
{
    /**
     * The Magento Category instance.
     *
     * @var \Magento\Catalog\Model\Category
     */
    protected $entity;

    /**
     * Category constructor.
     *
     * @param CategoryFactory $factory
     * @param CategoryRepository $repository
     * @param CollectionFactory $collection
     * @param Store $store
     */
    public function __construct(CategoryFactory $factory, CategoryRepository $repository, CollectionFactory $collection, Store $store)
    {
        parent::__construct();

        //$store->setCurrentStore('all');
        //$store->getStore()->setId(0);

        $this->factory = $factory;
        $this->repository = $repository;
        $this->collection = $collection;
    }

    /**
     * Find the category by the given id and throw an error
     * if it is not found.
     *
     * @param $id
     * @param int|string $store
     * @return $this
     * @throws CategoryNotFoundException
     */
    public function findOrFail($id, $store = null)
    {
        try {

            $this->entity = $this->repository->get($id, $store);

        } catch (NoSuchEntityException $exception) {

            throw new CategoryNotFoundException;

        }

        return $this;
    }

    /**
     * Find the category by the given id.
     *
     * @param $id
     * @param int|string $store
     * @return $this|null
     */
    public function find($id, $store = null)
    {
        try {

            $this->entity = $this->repository->get($id, $store);

        } catch (NoSuchEntityException $exception) {

            return null;

        }

        return $this;
    }

    /**
     * Get a category by url key.
     *
     * @param $key
     * @param int|string $store
     * @return $this
     */
    public function whereUrlKey($key, $store = null)
    {
        $this->entity = $this->collection->create()
            ->setStoreId($store)
            ->addAttributeToFilter('url_key', $key)
            ->addAttributeToSelect('*')
            ->getFirstItem();

        return $this;
    }

    /**
     * Get a category by name;
     *
     * @param $name
     * @param null $store
     * @return $this
     */
    public function whereName($name, $store = null)
    {
        $this->entity = $this->collection->create()
            ->setStoreId($store)
            ->addAttributeToFilter('name', $name)
            ->getFirstItem();

        return $this;
    }

    /**
     * Get all categories.
     *
     * @param null $store
     * @return static
     */
    public function all($store = null)
    {
        $categories = $this->collection->create()
            ->addAttributeToSelect('*')
            ->setStoreId($store)->load();

        return collect($categories)->map(function ($item, $key) {
            $instance = $this->instantiate();
            $instance->entity = $item;

            return $instance;
        });
    }

    /**
     * Assign the given product to the category.
     *
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $existingCategories = $product->get()->getCategoryIds();

        $existingCategories[] = $this->id;

        $product->get()->setCategoryIds($existingCategories);

        $product->save();
    }

    /**
     * Set the parent category.
     *
     * @param Category $category
     * @return Category
     */
    public function setParent(Category $category)
    {
        $this->entity->setParentId($category->id);

        return $this;
    }

    /**
     * Get the parent category.
     *
     * @return Category
     */
    public function parent()
    {
        $parent = $this->instantiate();
        $parent->entity = $this->entity->getParentCategory();

        return $parent;
    }

    /**
     * Get the child categories of the category.
     *
     * @param int $level
     * @param null $store
     * @return Collection
     */
    public function children($level = 1, $store = null)
    {
        $children = $this->collection->create()
            ->setStoreId($store)
            ->addAttributeToSelect('*')
            ->addPathsFilter($this->entity->getPath() . '/')
            ->addLevelFilter($this->entity->getLevel() + $level);

        return collect($children)->map(function ($category) {

            $instance = $this->instantiate();
            $instance->entity = $category;

            return $instance;

        });
    }

    /**
     * Fill in the category with default data.
     *
     * @return void
     */
    protected function fillDefaults()
    {
        $this->entity->setIsActive(true);
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

        if ($name === 'url') {
            return $this->entity->getUrl();
        }

        if ($name === 'img') {
            return $this->entity->getImageUrl();
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
//        if ($name === 'qty') {
//            return $this->entity->setStockData(['qty' => $value]);
//        }

        return false;
    }


}
