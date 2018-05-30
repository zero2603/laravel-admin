@extends('master')

@section('title','Update Product Image')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.product_gallery.page_header')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row text-lg-left">
	<div class="col-lg-12">
		<form action="{{action('ProductImageController@store')}}" method="post" enctype="multipart/form-data">
			@csrf
			<label class="custom-file-label" for="images">{{__('content.product_gallery.text_3')}}</label>
			<input type="file" class="custom-file-input" id="customFile" name="images[]" multiple><br>

			<div class="form-group">
				<button type="submit" class="btn btn-success">
					{{__('content.product_gallery.button_1')}}
				</button>
				<button type="reset" class="btn btn-defult">
					{{__('content.product_gallery.button_2')}}
				</button>
			</div>
		</form>
	</div>
</div>

@endsection