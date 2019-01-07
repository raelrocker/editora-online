<?php

namespace CodePub\Listeners;

use CodePub\Events\CodeEduBook\Events\BookPreIndexEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookMostSaled
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * Create the event listener.
     *
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        //
        $this->orderRepository = $orderRepository;
    }

    /**
     * Handle the event.
     *
     * @param  BookPreIndexEvent  $event
     * @return void
     */
    public function handle(BookPreIndexEvent $event)
    {
        $book = $event->getBook();

        $ranking = $this->orderRepository->scopeQuery(function($query) use ($book){
            return $query->select(\DB::raw("count(orders.id) AS total"))
                ->where('orderable_id', $book->id);
        })->all()->first()->total;

        $event->setRanking($ranking);
    }
}
