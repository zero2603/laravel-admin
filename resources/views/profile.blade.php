@extends('master')

@section('title','All Partners')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.profile.page_header', ['id' => $user->id])}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<form method="POST" action="{{action('UserController@updateProfile', $user->id)}}">
		{{ csrf_field() }}
		<input name="_method" type="hidden" value="PATCH">
		<div class="col-md-6">
			<h4>{{__('content.profile.header_1')}}</h4>
			<div class="form-group">
				<label>{{__('content.profile.label_1')}}</label>
				<input type="text"  class="form-control" value="{{$user->name}}" name='name'>
			</div>
			<div class="form-group">
				<label>{{__('content.profile.label_2')}}</label>
				<input type="text"  class="form-control" value="{{$user->email}}" name="email">
			</div>
			<div class="form-group">
				<label>{{__('content.profile.label_3')}}</label>
				<input type="text"  class="form-control" value="{{$user->address}}" name="address">
			</div>
			<div class="form-group">
				<label>{{__('content.profile.label_4')}}</label>
				<input type="text"  class="form-control" value="{{$user->country}}" name="country">
			</div>
			<div class="form-group">
				<label>{{__('content.profile.label_5')}}</label>
				<input type="text"  class="form-control" value="{{$user->phone}}" name="phone">
			</div>
			<div class="form-group">
				<label>{{__('content.profile.label_6')}}</label>
				<input type="text"  class="form-control" value="{{$user->tax}}" name="tax">
			</div>
		</div>
		<div class="col-md-6">
			<h4>{{__('content.profile.header_2')}}</h4>
			<div class="form-group">
				<label>{{__('content.profile.label_7')}}</label>
				<input type="text"  class="form-control" value="{{$user->restaurent_name}}" name="restaurent_name">
			</div>
			<div class="form-group">
				<label>{{__('content.profile.label_8')}}</label>
				<input type="text"  class="form-control" value="{{$user->website}}" name="website">
			</div>
			<div class="form-group">
				<label>{{__('content.profile.label_9')}}</label>
				<input type="text"  class="form-control" value="{{$user->type}}" name="type">
			</div>
			<div class="form-group">
				<label>{{__('content.profile.label_10')}}</label>
				<input type="text"  class="form-control" value="{{$user->currency}}" name="currency">
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<button type="submit" class="btn btn-success">
					{{__('content.profile.button_1')}}
				</button>
				<button type="reset" class="btn btn-default">
					{{__('content.profile.button_2')}}
				</button>
			</div>
		</div>

	</form>
</div>
@endsection