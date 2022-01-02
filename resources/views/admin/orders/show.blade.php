@extends('admin.layouts.main',[
								'page_header'		=> 'تفاصيل الطلبات',
								'page_description'	=> 'تفاصيل الطلبات ',
								'link' => url('admin/orders')
								])

@section('content')

<style>

#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)}
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)}
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>

<div class="ibox">
<div class="ibox-content">
    <div class="table-responsive">
        <h3 class="">{{__('تفاصيل الطلب')}}</h3>
        <table class="table m-b-xs">
            <tbody>

            <tr>
                <td>
                    {{__('التكلفه')}} : <strong>{{optional($record)->total_price}}</strong>
                </td>
                <td>
                {{__('التوصيل')}} : <strong>{{optional($record)->delivery}}</strong>
                </td>
            </tr>

            <tr>
                <td>
                {{__('اجمالي السعر')}} : <strong>{{optional($record)->price_after_delivery}}</strong>
                </td>
                <td>
                    {{__('الحاله')}} : <strong>{{optional($record)->status}}</strong>
                </td>
            </tr>

                </tbody>
            </table>
        </div>
</div>
</div>


<hr>
<div class="clearfix"></div>
    <br>
    <br>
<div class="ibox">
    <div class="ibox-title">
        <h4>{{__('المنتجات')}}</h4>
                </div>
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="data-table table table-bordered dataTables-example">
                <thead>
                    <!-- <th class="text-center">#</th> -->
                    <th>اسم المنتج</th>
                    <th>الكميه</th>
                    <th>السعر</th>
                </thead>
                <tbody>

                @php $count = 1; @endphp

                <!-- @dd($record->products); -->

                @foreach($record->products as $rec)
  
                    <tr id="removable{{$record->id}}">
                    <td>{{optional($rec)->name}}</td> 
                    <td>{{optional($rec)->qua}}</td>
                    <td>{{optional($rec)->price}}</td>
                            <td class="text-center"><div style="
                                    width: 3rem;
                                    height: 3rem;
                                    border-radius: 50%;
                                    background-color: {{$product->ColorDetail->color ?? ''}};
                                    margin: 0 0.05rem;"></div>
                             </td>
                        </tr>
                        
                    @endforeach
                    @php $count ++; @endphp
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}


</script>
@endpush
