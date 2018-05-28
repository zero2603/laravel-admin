@extends('master')

@section('title','All Partners')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('admin.user.title_2', ['id' => $user->id])}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<form method="POST" action="{{action('UserController@updateProfile', $user->id)}}">
		{{ csrf_field() }}
		<input name="_method" type="hidden" value="PATCH">
		<div class="col-md-6">
			<h4>{{__('admin.user.show_title_1')}}</h4>
			<div class="form-group">
				<label>{{__('admin.user.name')}}</label>
				<input type="text"  class="form-control" value="{{$user->name}}" name='name'>
			</div>
			<div class="form-group">
				<label>{{__('admin.user.email')}}</label>
				<input type="text"  class="form-control" value="{{$user->email}}" name="email">
			</div>
			<div class="form-group">
				<label>{{__('admin.user.address')}}</label>
				<input type="text"  class="form-control" value="{{$user->address}}" name="address">
			</div>
			<div class="form-group">
				<label>{{__('admin.user.country')}}</label>
				<input type="text"  class="form-control" value="{{$user->country}}" name="country">
			</div>
			<div class="form-group">
				<label>{{__('admin.user.phone')}}</label>
				<input type="text"  class="form-control" value="{{$user->phone}}" name="phone">
			</div>
			<div class="form-group">
				<label>{{__('admin.user.tax')}}</label>
				<input type="text"  class="form-control" value="{{$user->tax}}" name="tax">
			</div>
		</div>
		<div class="col-md-6">
			<h4>{{__('admin.user.show_title_2')}}</h4>
			<div class="form-group">
				<label>{{__('admin.user.restaurent_name')}}</label>
				<input type="text"  class="form-control" value="{{$user->restaurent_name}}" name="restaurent_name">
			</div>
			<div class="form-group">
				<label>{{__('admin.user.website')}}</label>
				<input type="text"  class="form-control" value="{{$user->website}}" name="website">
			</div>
			<div class="form-group">
				<label>{{__('admin.user.type')}}</label>
				<input type="text"  class="form-control" value="{{$user->type}}" name="type">
			</div>
			<div class="form-group">
				<label>{{__('admin.user.currency')}}</label>
				<input type="text"  class="form-control" value="{{$user->currency}}" name="currency">
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<button type="submit" class="btn btn-success">
					{{__('content.products.button_next')}}
				</button>
				<button type="reset" class="btn btn-default">
					{{__('content.products.button_cancel')}}
				</button>
			</div>
		</div>

	</form>
</div>
@endsection