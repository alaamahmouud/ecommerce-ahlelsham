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
class MainController extends ParentApi
{

    public function __construct()
    {
        $this->helper = new Helper();

    }

        public function index()
        {
            $slider = Slider::where('is_active',1)->with('attachmentRelation')->get();

            $products =Product::with('attachmentRelation')->get() ;

            return $this->helper->responseJson(1,'done',
                ['slider' => $slider,
                'peoducts' => $products,
                ]);
        }

        public function orderdetails()
        {
         $record = Order::get();
         return $this->helper->responseJson(1,'done',$record);

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
     }

     public function about()
     {
     $about = About::with('attachmentRelation')->latest()->get();

      return $this->helper->responseJson(1,'done',$about);
     }


}


///////////////////////////////

//         public function certificate()
//         {

//             $record = Certificate::first();
//             return $this->helper->responseJson(1,'done',$record);
//         }


//     public function is_certificate()
//     {
//         $client = auth()->user() ;
//         if ($client->certificate == 0)
//         {
//             $client->certificate = 1 ;
//             $client->save();
//             return $this->helper->responseJson(1,'done');
//         }else
//         {
//             return $this->helper->responseJson(0,'تم الاشتراك في شهاده الضمان لا يمكن الالغاء');

//         }
//     }


//     public function serviceDetails(Request $request)
//     {
//         $id = $request->id ;
//         $service = Service::whereId($id)->get();
//         $details = Detail::whereServiceId($id)->with('attachmentRelation')->get();
//         return $this->helper->responseJson(1,'done',[
//             'service' => $service ,
//             'details' => $details
//         ]);

//     }


//         $record = Contact::create($request->all());
//         return $this->helper->responseJson(1,'done');

//     }


//     public function addresses()
//     {
//         $record = Address::get();
//         return $this->helper->responseJson(1,'done',$record);

//     }



//     public function order(Request $request)
//     {

//         $rules =
//             [
//                 'service_id' => 'required',
//             ];

//         $data = validator()->make($request->all(), $rules);

//         if ($data->fails()) {

//             return $this->helper->responseJson(0, $data->errors()->first());
//         }

//        $toDeploy =  env("APP_STORE") ;

//         if ($toDeploy == 0)
//         {
//         $find = Service::findOrFail($request->service_id);


//         $order = Order::create([
//             'service_id' => $find->service_id ?? 1 ,
//             'total_price' => rand(11,99),
//             'client_id' => auth()->user()->id
//         ]);

//         return $this->helper->responseJson(1, 'dn',$order);
//             }
// else{
//     return $this->helper->responseJson(2, 'لا يمكن الاضافه الان علشان التطبيق اترفع :)');

// }
//     }


