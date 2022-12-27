<?php

namespace Contracts\Repositories;

interface OrderRepositoryInterface
{
    /**
     *  @param Order $order
     *  @return Int
     */
    public function getRecentOrderCount($order);
    /**
     * @param Array $data
     * @return Void
     */
    public function create($data);
}
