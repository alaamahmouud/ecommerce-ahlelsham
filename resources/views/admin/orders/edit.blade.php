
@extends('admin.layouts.main',[
                                'page_header'       => 'الطلبات',
                                'page_description'  => ' تعديل   ',
                                'link' => url('admin/orders')
                                ])
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
    {!! Form::model($model,[
                            'url'=>url('admin/orders/'.$model->id),
                            'id'=>'myForm',
                            'role'=>'form',
                            'method'=>'PUT',
                            'files' => true
                            ])!!}

    <div class="box-body">
        <div class="clearfix"></div>
        <br>
        @include('admin.orders.form')

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>

    </div>
    {!! Form::close()!!}

</div>

@endsection
