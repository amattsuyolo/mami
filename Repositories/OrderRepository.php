<?php

use Contracts\Repositories\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getRecentOrderCount($order)
    {
        $timestamp = Carbon::now()->subMinutes(5);

        return DB::table('orders')
            ->where('account', $order->account->id)
            ->where('created_at', '>=', $timestamp)
            ->count();
    }
    /**
     * @inheritDoc
     */
    public function create($data)
    {
        DB::table('orders')->insert($data);
    }
}
