<?php

namespace App\Http\Controllers;

use App\Http\Middleware\donotallowusertomakepayment;
use App\Http\Middleware\IsEmployer;
use App\Mail\PurchaseMail;
use App\Models\User;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Stripe\Stripe;
 use Illuminate\Support\Facades\URL;
 use Illuminate\Support\Facades\Mail;
//  use Illuminate\Contracts\Mail\Mailable;

class SubscriptionController extends Controller
{
    const WEEKLY_AMOUNT =  20;
    const MONTHLY_AMOUNT =  80;
    const YEARLY_AMOUNT =  200;
    const CURRENCY = 'USD'; // US Dollar is the default

    public function __construct()
    {
       $this->middleware(['auth',IsEmployer::class,donotallowusertomakepayment::class])->except('subscribe');  //bloquea
    }

    public function subscribe(){
        return  view('subscription.index');
    }

    public function initiatePayment(Request $request){
        // PAYMENT PLANS
        $plans = [
            "weekly" => [
                'name'=>'weekly',
                'description'=>'weekly payment',
                'amount'=>self::WEEKLY_AMOUNT,
                'currency'=> self::CURRENCY,
                'quantity'=>1
            ],
            "monthly" => [
                'name'=>'monthly',
                'description'=>'monthly payment',
                'amount'=>self::MONTHLY_AMOUNT,
                'currency'=> self::CURRENCY,
                'quantity'=>1
            ],
            "yearly" => [
                'name'=>'yearly',
                'description'=>'yearly payment',
                'amount'=>self::YEARLY_AMOUNT,
                'currency'=> self::CURRENCY,
                'quantity'=>1
            ],
        ];

        // INITIATING PAYMENT
        Stripe::setApiKey(config('services.stripe.secret'));

        try{

            $selectPlan = null;
            if($request -> is('pay/weekly')){
                $selectPlan = $plans['weekly'];
                $billingEnds = now()->addweek()->startOfDay()->toDateString();
            }elseif($request -> is('pay/monthly')){
                $selectPlan = $plans['monthly'];
                $billingEnds = now()->addMonth()->startOfDay()->toDateString();
            }elseif($request -> is('pay/yearly')){
                $selectPlan = $plans['yearly'];
                $billingEnds = now()->addYear()->startOfDay()->toDateString();
            }

            if($selectPlan){
                $successUrl = URL::SignedRoute('payment.success',[
                    'name'=>$selectPlan['name'],
                    'billing_ends' => $billingEnds
                ]);
                $product = \Stripe\Product::create([
                    'name' => $selectPlan['name'],
                    'description' => $selectPlan['description']
                ]);
                $price = \Stripe\Price::create([
                    'product'=>$product->id,
                    'unit_amount'=>$selectPlan['amount']*100,
                    'currency'=>$selectPlan['currency']
                ]);
                $session=Session::create([
                    'payment_method_types'=>['card'],
                    'line_items'=>[
                        [
                            // OLD WAY
                            // 'name'=>$selectPlan['name'],
                            // 'description'=>$selectPlan[ 'description'] ,
                            // 'price'=>$selectPlan['amount' ]* 100 ,
                            // 'currency'=>$selectPlan['currency' ] ,
                            // 'quantity'=>$selectPlan['quantity' ]

                            // NEW WAY (create product and price objects)
                            'price'=>$price->id,
                            'quantity'=>1
                        ]
                    ],
                    'mode'=>'payment',
                    'success_url'=> $successUrl,
                    'cancel_url' => route('payment.cancel')
                ]);
                return redirect( $session->url );
            }
        }catch(\Exception $e){
            return response()->json($e);
        }
    }

    public function paymentSuccess(Request $request){
        $plan = $request->name;
        $billingEnds = $request->billing_ends;

        User::where('id',auth()->user()->id)->update([
            'plan'=>$plan,
            'billing_ends'=>$billingEnds,
            'status'=>'paid'
        ]);

        $username = auth()->user()->name;
        try{
            Mail::to(auth()->user())->queue(new PurchaseMail($plan,$billingEnds,$username));
        }catch(\Exception $e){
            return response()->json($e);
        }
        

        return redirect()->route('dashboard')->with('success','Payment was successiful processed');
    }

    public function cancel(){
        //redirecting away
        return redirect()->route('dashboard')->with('error','Payment was unsuccessiful');
    }
}
