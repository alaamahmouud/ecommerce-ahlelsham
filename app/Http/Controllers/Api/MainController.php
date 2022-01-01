<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Address;
use App\Models\Advertisement;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Slider;
use App\Models\Detail;
use App\Models\Product;
use App\Models\Order;
use App\Models\Service;
use App\MyHelper\Helper;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class MainController extends ParentApi
{

    public function __construct()
    {
        $this->helper = new Helper();

    }

        public function index(Request $request)
        {
            if($request->has('category_id')) {
                $products =Product::where('category_id', $request->category_id)->with('attachmentRelation')->get() ;
            }else {
                $products =Product::with('attachmentRelation')->get() ;
            }

            $slider = Slider::where('is_active',1)->with('attachmentRelation')->get();

            // $products =Product::with('attachmentRelation')->get() ;

            return $this->helper->responseJson(1,'done',
                ['slider' => $slider,
                'products' => $products,
                ]);
        }

                
        // public function discounts()
        // {
        //     $products = Product::where('descount_value', '!=', 0)->get();

        //     return $this->helper->responseJson(1,'done', $products);

        // }


        public function orderdetails()
        {
            $orders = Order::where('client_id', auth()->id())->get();
         
            return $this->helper->responseJson(1,'done', OrderResource::collection($orders));
            // return $this->helper->responseJson(1,'done', $orders);
        }

    
        public function getOrderDetails(Order $order)
        {
            return $this->helper->responseJson(1,'done', new OrderResource($order));
        }
        
     public function contacts(Request $request)
     {
         $rules =
        [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ];

         $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {
            return $this->helper->responseJson(0, $data->errors()->first());
        }

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        return $this->helper->responseJson(1,'done', $contact);
     }

     public function about()
     {
        $about = About::with('attachmentRelation')->latest()->get();

        return $this->helper->responseJson(1,'done',$about);
     }


}

