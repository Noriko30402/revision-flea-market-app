<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Item;
use App\Models\User;


class ItemPurchasedMail extends Mailable
{
    use Queueable, SerializesModels;


    public $item;
    public $buyer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Item $item, User $buyer)
    {
        $this->item = $item;
        $this->buyer = $buyer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('商品が購入されました')
                    ->view('item_purchased')
                    ->with([
                        'item' => $this->item,
                        'buyer' => $this->buyer,
                    ]);

    }
}
