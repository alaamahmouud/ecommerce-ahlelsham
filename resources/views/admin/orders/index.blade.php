@extends('admin.layouts.main',[
								'page_header'		=> 'الطلبات',
								'page_description'	=> 'الطلبات ',
								'link' => url('admin/orders')
								])
@section('content')

    <div class="ibox box-primary">
        <div class="ibox-title">
            <!-- <div class="pull-right">
                <a href="{{url('admin/orders/create')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> إضافة جديد
                </a>
            </div> -->
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
                        <th>رقم الاوردر</th>
                        <th>اسم العميل</th>
                        <th>رقم العميل</th>
                        <th class="text-center"> تفعيل الظهور في الموقع</th>
                        <!-- <th class="text-center">اظهار التفاصيل</th> -->
                        <!-- <th class="text-center">حذف</th> -->
                        </thead>
                        <tbody>
                        @foreach($records as $record)
                            <tr id="removable{{$record->id}}">
                                <td>{{($records->perPage() * ($records->currentPage() - 1)) + $loop->iteration}}</td>
                                <td>{{optional($record)->id}}</td>
                                <td>{{optional($record->client)->full_name}}</td>
                                <td>{{optional($record->client)->phone}}</td>
                                <!-- client -> relation name -->
                                <!-- <td class="text-center">
                                    {!! \App\MyHelper\Helper::toggleBooleanView($record , url('admin/orders/toggle-boolean/'.$record->id.'/is_active'),'is_active') !!}
                                </td> -->
                                <td class="text-center"><a href="{{url('admin/orders/' . $record->id )}}" class="btn btn-xs btn-success">view</i></a></td>
                                <!-- <td class="text-center">
                                    <button
                                            id="{{$record->id}}"
                                            data-token="{{ csrf_token() }}"
                                            data-route="{{url('admin/orders/'.$record->id)}}"
                                            type="button"
                                            class="destroy btn btn-danger btn-xs">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </td> -->
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
