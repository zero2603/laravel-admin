@extends('master')

@section('title','Update Product Image')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Product Gallery</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div>
	<a href="{{url('/product/images/create')}}">
		<button class="btn btn-primary">Upload more item images</button>
	</a>
	<span>&nbsp;or&nbsp;</span>
	<a href="{{url('/product')}}">
		<button class="btn btn-success">Return products page</button>
	</a>
</div>
<hr>
<h4>Current Images in Gallery</h4>
<div><p>Hover and click (x) button to delete image</p></div>
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