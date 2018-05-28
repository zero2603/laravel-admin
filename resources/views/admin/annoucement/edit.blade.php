@extends('master')

@section('title','Annoucement Detail')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('Annoucement Detail')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<form action="{{action('AnnoucementController@update', $annoucement->id)}}" method="POST">
			{{ csrf_field() }}
            <input name="_method" type="hidden" value="PATCH">

			<div class="form-group">
				<label for="eng_title">English Title<span class="require">*</span></label>
				<input type="text" class="form-control" name="eng_title" value="{{$annoucement->eng_title}}" />
			</div>

			<div class="form-group">
				<label for="vie_title">Vietnamese Title<span class="require">*</span></label>
				<input type="text" class="form-control" name="vie_title" value="{{$annoucement->vie_title}}" />
			</div>

			<div class="form-group">
				<label for="eng_content">English Content</label>
				<textarea rows="5" class="form-control" name="eng_content">{{ $annoucement->eng_content }}</textarea>
			</div>

			<div class="form-group">
				<label for="vie_content">Vietnamese Content</label>
				<textarea rows="5" class="form-control" name="vie_content">{{ $annoucement->vie_content }}</textarea>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-success">
					Submit
				</button>
				<button type="reset" class="btn btn-default">
					Cancel
				</button>
			</div>
		</form>
	</div>
</div>

@endsection