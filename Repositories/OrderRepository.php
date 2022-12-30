<?php

use Contracts\Repositories\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    private const  RECENT_MINUTE = 5;

    /**
     * @inheritDoc
     */
    public function getRecentOrderCount($order)
    {
        $timestamp = Carbon::now()->subMinutes(self::RECENT_MINUTE);

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
