@extends('master')

@section('title','Update Product Image')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.product_gallery.page_header')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div>
	<a href="{{url('/product/images/create')}}">
		<button class="btn btn-primary">{{__('content.product_gallery.button_1')}}</button>
	</a>
	<span>&nbsp;{{__('content.product_gallery.text_1')}}&nbsp;</span>
	<a href="{{url('/product')}}">
		<button class="btn btn-success">{{__('content.product_gallery.button_2')}}</button>
	</a>
</div>
<hr>
<h4>{{__('content.product_gallery.header_1')}}</h4>
<div><p>{{__('content.product_gallery.text_2')}}</p></div>
<div class="row text-center text-lg-left">
	@foreach($product_images as $image) 

	<div class="col-lg-3 col-md-4 col-xs-6">
		<div class="d-block mb-4 h-100 single-image">
			<img src="{{url('/')}}/storage/app/public/images/{{$image->filename}}" class="img-fluid img-thumbnail">
			<form action="{{action('ProductImageController@destroy', $image->id)}}" method="POST">
				@csrf
				<input name="_method" type="hidden" value="DELETE">
				<button type="submit" class="close" aria-label="Close">
					<span aria-hidden="true" style="font-size: 36px">&times;</span>
				</button>
			</form>
			
		</div>
	</div>

	@endforeach  
</div>

@endsection

<style type="text/css">
.single-image {
	position: relative;
}

.single-image img {
	opacity: 1;
	display: block;
	transition: .5s ease;
	backface-visibility: hidden;
	height: 200px;
	object-fit: contain;
}

.single-image button {
	transition: .5s ease;
	opacity: 0;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%);
	text-align: center;
}

.single-image:hover img {
	opacity: 0.3;
}

.single-image:hover button {
	opacity: 1;
}
</style>