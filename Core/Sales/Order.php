<?php

namespace IrishTitan\Handshake\Core\Sales;

use IrishTitan\Handshake\Core\Catalog\MagentoEntity;
use IrishTitan\Handshake\Exceptions\OrderNotFoundException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Model\OrderFactory;
use Magento\Sales\Model\OrderRepository;

class Order extends MagentoEntity
{
    /**
     * The Magento order instance.
     *
     * @var \Magento\Sales\Model\Order
     */
    protected $entity;

    /**
     * Order constructor.
     *
     * @param OrderFactory $factory
     * @param OrderRepository $repository
     */
    public function __construct(OrderFactory $factory, OrderRepository $repository)
    {
        parent::__construct();

        $this->factory = $factory;
        $this->repository = $repository;
    }

    public function find($id, $store = null)
    {

    }

    /**
     * Try to find the order by id or throw an exception
     * if not found.
     *
     * @param $id
     * @param null $store
     * @return mixed|void
     * @throws OrderNotFoundException
     */
    public function findOrFail($id, $store = null)
    {
        try {

            $this->entity = $this->repository->get($id);

        } catch (NoSuchEntityException $exception) {

            throw new OrderNotFoundException;

        }

        return $this;
    }

    public function firstOrNew(array $attributes, $store = null)
    {

    }

    public function fillDefaults()
    {

    }

}