<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Contracts\OrderContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderFormRequest;
use App\Services\PayPalService;
use App\Models\Order;
use Cart;

class CheckoutController extends Controller {

    protected $orderRepository;
    protected $payPal;

    public function __construct(OrderContract $orderRepository, PayPalService $payPal) {
        $this->payPal = $payPal;
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout() {
        return view('site.pages.checkout');
    }

    public function placeOrder(OrderFormRequest $request) {
        // Before storing the order we should implement the
        // request validation which I leave it to you
        $order = $this->orderRepository->storeOrderDetails($request->all());
        if ($order && $request->input('forma_pago') === 'PAYPAL') {
            $this->payPal->processPayment($order);
        }
        if ($order) {
            Cart::clear();
            return view('site.pages.success', compact('order'));
        }

        return redirect()->back()->with('message', 'La orden no se pudo procesar.');
    }

    public function complete(Request $request) {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        $status = $this->payPal->completePayment($paymentId, $payerId);

        $order = Order::where('order_number', $status['invoiceId'])->first();
        if (isset($order->status)) {
            $order->status = 'procesando';
            $order->payment_status = 1;
            $order->payment_method = 'PayPal -' . $status['salesId'];
            $order->save();

            Cart::clear();
            return view('site.pages.success', compact('order'));
        } else {
            return view('site.pages.error');
        }
    }

}
