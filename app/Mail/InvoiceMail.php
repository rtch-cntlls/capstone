<?php

namespace App\Mail;

use App\Models\Sale;
use App\Models\Shop;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public Sale $sale;
    public Shop $shop;

    public function __construct(Sale $sale, Shop $shop)
    {
        $this->sale = $sale;
        $this->shop = $shop;
    }

    public function build()
    {
        return $this->subject('Your Invoice - ' . $this->shop->shop_name)
                    ->view('emails.orders.invoice')
                    ->with([
                        'sale' => $this->sale,
                        'shop' => $this->shop,
                    ]);
    }
}
