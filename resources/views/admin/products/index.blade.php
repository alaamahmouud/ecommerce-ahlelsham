@extends('admin.layouts.main',[
								'page_header'		=> 'المنتجات',
								'page_description'	=> 'المنتجات ',
								'link' => url('admin/products')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <div class="pull-right">


                <a href="{{url('admin/products/create')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> إضافة جديد
                </a>
            </div>
            <div class="clearfix"></div>
        </div>


{{--        --}}
        <div class="row">
            {!! Form::open([
                'method' => 'GET'
            ]) !!}
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('name',old('name'),[
                        'class' => 'form-control',
                        'placeholder' => 'الاسم'
                    ]) !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('des',old('des'),[
                        'class' => 'form-control',
                        'placeholder' => 'الوصف'
                    ]) !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('price_after_discount',old('price_after_discount'),[
                        'class' => 'form-control',
                        'placeholder' => 'السعر بعد الخصم'
                    ]) !!}
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <button class="btn btn-primary btn-block" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>


        <div class="ibox-content">
            @if(!empty($records) && count($records)>0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الصوره</th>
                        <th>الوصف</th>
                        <th>السعر قبل الخصم</th>
                        <th>قيمه الخصم</th>
                        <th>السعر بعد الخصم</th>
                        <th>اسم القسم</th>
                        <!-- <th class="text-center"> تفعيل الظهور في الموقع</th> -->
                        <th class="text-center">تعديل</th>
                        <th class="text-center">حذف</th>
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{optional($record)->name}}</td>
                                <td>
                                    @forelse($record->attachmentRelation as $img)

                                                                            <img alt="image" class="img-fluid img-responsive"

                                                                            src="{{asset($img->path)}}"  style=" border-radius: 50%; width: 50px ; height: 50px;">
                                    @empty

                                                                                <span>لا يوجد صورة </span

                                    @endempty

                                </td>
                                <td>{{optional($record)->des}}</td>
                                <td>{{optional($record)->price}}</td>
                                <td>{{optional($record)->discount_value}}</td>
                                <td>{{optional($record)->price_after_discount}}</td>
                                <td>{{optional($record)->category->name}}</td>
                                <!-- <td class="text-center">
                                    {!! \App\MyHelper\Helper::toggleBooleanView($record , url('admin/products/toggle-boolean/'.$record->id.'/is_active'),'is_active') !!}
                                </td> -->
                                <td class="text-center"><a href="{{url('admin/products/' . $record->id .'/edit')}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a></td>
                                <td class="text-center">
                                    <button
                                            id="{{$record->id}}"
                                            data-token="{{ csrf_token() }}"
                                            data-route="{{url('admin/products/'.$record->id)}}"
                                            type="button"
                                            class="destroy btn btn-danger btn-xs">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $records->appends(request()->all())->render() !!}
            @else
                <div>
                    <h3 class="text-info" style="text-align: center"> لا توجد بيانات للعرض </h3>
                </div>
            @endif


        </div>
    </div>
@stop

@section('script')
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel':false,

        })
    </script>

@stop
