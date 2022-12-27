<?php

use Contracts\Repositories\OrderRepositoryInterface;

class OrderProcessor
{

    public function __construct(
        BillerInterface $biller,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->biller = $biller;
        $this->orderRepository = $orderRepository;
    }

    public function process(Order $order)
    {
        $recent = $this->orderRepository->getRecentOrderCount($order);

        if ($recent > 0) {
            throw new Exception('Duplicate order likely.');
        }

        $this->biller->bill($order->account->id, $order->amount);

        DB::table('orders')->insert(array(
            'account' => $order->account->id,
            'amount' => $order->amount,
            'created_at' => Carbon::now()
        ));
    }
}
