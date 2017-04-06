<?php

namespace IrishTitan\Handshake\Core;

use IrishTitan\Handshake\Exceptions\CategoryNotFoundException;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;

class Category
{

    /**
     * The category factory instance.
     *
     * @var ProductFactory
     */
    protected $factory;

    /**
     * The category repository instance.
     *
     * @var ProductRepository
     */
    protected $repository;

    /**
     * The category collection instance.
     *
     * @var ProductCollection
     */
    protected $collection;

    /**
     * The magento category instance.
     *
     * @var
     */
    protected $category;

    public function __construct(CategoryFactory $factory, CategoryRepository $repository, CollectionFactory $collection)
    {
        $this->factory = $factory;
        $this->repository = $repository;
        $this->collection = $collection;
    }

    /**
     * Get the category attributes as properties.
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->category->getData($name);
    }

    /**
     * Set the category attributes dynamically via properties.
     *
     * @param $name
     * @param $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        return $this->category->setData($name, $value);
    }

    /**
     * Get the category instance.
     *
     * @return \Magento\Catalog\Model\Category
     */
    public function get()
    {
        return $this->category;
    }

    /**
     * Find the category by the given id and throw an error
     * if it is not found.
     *
     * @param $id
     * @return $this
     * @throws CategoryNotFoundException
     */
    public function findOrFail($id)
    {
        try {

            $this->category = $this->repository->get($id);

        } catch (NoSuchEntityException $exception) {

            throw new CategoryNotFoundException;

        }

        return $this;
    }

    /**
     * Find the category by the given id.
     *
     * @param $id
     * @return $this|null
     */
    public function find($id)
    {
        try {

            $this->category = $this->repository->get($id);

        } catch (NoSuchEntityException $exception) {

            return null;

        }

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

        $existingCategories[] = $this->category->getId();

        $product->get()->setCategoryIds($existingCategories);

        $product->save();
    }

}