@extends('master')

@section('title','Update Product Image')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.products.add_image_title')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row text-lg-left">
	<form action="{{action('ProductImageController@store')}}" method="post" enctype="multipart/form-data">
		@csrf
		<label class="custom-file-label" for="images">{{__('content.products.add_image_subtitle')}}</label>
		<input type="file" class="custom-file-input" id="customFile" name="images[]" multiple><br>

		<div class="form-group">
			<button type="submit" class="btn btn-success">
				{{__('content.products.button_next')}}
			</button>
			<button type="reset" class="btn btn-default">
				{{__('content.products.button_cancel')}}
			</button>
		</div>
	</form>
</div>

@endsection