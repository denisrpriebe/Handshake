<?php

namespace IrishTitan\Handshake\Core\Entities;

use Illuminate\Support\Collection;
use IrishTitan\Handshake\Core\MagentoEntity;
use IrishTitan\Handshake\Exceptions\CategoryNotFoundException;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;

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
     */
    public function __construct(CategoryFactory $factory, CategoryRepository $repository, CollectionFactory $collection)
    {
        parent::__construct();

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
     * Save the category.
     *
     * @return $this
     */
    public function save()
    {
        $this->entity = $this->repository->save($this->entity);

        return $this;
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
     * Get the children of the category.
     *
     * @param int $level
     * @param null $store
     * @return Collection
     */
    public function children($level = 1, $store = null)
    {
        return collect($this->collection->create()
            ->setStoreId($store)
            ->addAttributeToSelect('*')
            ->addPathsFilter($this->entity->getPath() . '/')
            ->addLevelFilter($this->entity->getLevel() + $level))
            ->map(function ($item, $key) {

                $instance = $this->instantiate();
                $instance->entity = $item;

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


}