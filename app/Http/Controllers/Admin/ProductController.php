<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\MyHelper\Helper;
use Helper\Attachment;


class ProductController extends Controller
{
    protected $model ;
    protected $viewsDomain = 'admin/products.';
    protected $url = 'admin/products';
    public function __construct()
    {
        $this->model = new Product();
    }
    public function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //
        $records = $this->model->where(function ($q) use ($request)
        {
            if ($request->name) {
                

                $q->where('name', 'LIKE', '%' . $request->name . '%');
            
        }

        if ($request->des) {
                

            $q->where('des', 'LIKE', '%' . $request->des . '%');

        }

        if ($request->price_after_discount) {
                

            $q->where('price_after_discount', 'LIKE', '%' . $request->price_after_discount . '%');   
    }

        })->latest()->paginate(6);
        return $this->view('index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
        $model = $this->model;
        return $this->view('create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        //
        $rules =
            [
                'name' => 'required',
                'des' => 'required',
                'price' => 'required',
                'price_after_discount' => 'required',
                'discount_value' => 'required',
                'category_id' => 'required',
                'attachments' => 'required'
            ];

        $error_sms =
            [
                'name.required' => 'الرجاء ادخال الاسم ',
                'des.required' => 'الرجاء ادخال الوصف ',
                'price.required' => 'الرجاء ادخال قيمه ',
                'price_after_discount.required' => 'الرجاء ادخال قيمه ',
                'discount_value.required' => 'الرجاء ادخال قيمه ',
                'category_id' => 'الرجاء اختيار قيمه ',
                'attachments.required' => 'الرجاء ادخال صوره الاعلان ',
            ];

        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }


        $record = Product::create($request->all());
        Attachment::addAttachment($request->file('attachments'), $record, 'products/product', ['save' => 'original']);

        session()->flash('success', 'تمت الاضافة بنجاح');
        return redirect($this->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $model = $this->model->findOrFail($id);
        return $this->view('edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules =
            [
                'name' => 'required',
                'des' => 'required',
                'price' => 'required',
                'price_after_discount' => 'required',
                'discount_value' => 'required',
                'category_id' => 'required',
                'attachments' => 'nullable'
            ];

        $error_sms =
            [
                'name.required' => 'الرجاء ادخال الاسم ',
                'des.required' => 'الرجاء ادخال الوصف ',
                'price.required' => 'الرجاء ادخال قيمه ',
                'price_after_discount.required' => 'الرجاء ادخال قيمه ',
                'discount_value.required' => 'الرجاء ادخال قيمه ',
                'category_id' => 'الرجاء اختيار قيمه ',
                'attachments.required' => 'الرجاء ادخال صوره الاعلان ',
            ];


        $data = validator()->make($request->all(), $rules, $error_sms);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        }

        $record = $this->model->findOrFail($id);

        $record->update($request->all());
        $oldFile = $record->attachmentRelation[0];

        Attachment::updateAttachment($request->file('attachments'),$oldFile ,$record, 'products/product', ['save' => 'original']);

        session()->flash('success', 'تمت تحديث بنجاح');
        return redirect($this->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        $record->delete();

        $data = [
            'status' => 1,
            'message' => 'تم الحذف بنجاح',
            'id' => $id
        ];
        return Response::json($data, 200);
    }

    public function toggleBoolean($id, $action)
    {
        $record = $this->model->findOrFail($id);
        Helper::toggleBoolean($record);

        return Helper::responseJson(1, 'تمت العملية بنجاح');
    }

}




