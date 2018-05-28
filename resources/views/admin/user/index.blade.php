@extends('master')

@section('title','All Partners')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('admin.user.title_1')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">{{__('admin.user.tbl_header_1')}}</th>
					<th scope="col">{{__('admin.user.tbl_header_2')}}</th>
					<th scope="col">{{__('admin.user.tbl_header_3')}}</th>
					<th scope="col">{{__('admin.user.tbl_header_4')}}</th>
					<th scope="col">{{__('admin.user.tbl_header_5')}}</th>
					<th scope="col">{{__('admin.user.tbl_header_6')}}</th>
					<th scope="col">{{__('admin.user.tbl_header_7')}}</th>
					<th scope="col" colspan="3">{{__('admin.user.tbl_header_8')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr class="odd gradeX">
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td class="center">{{ $user->email }}</td>
					<td class="center">{{ $user->restaurent_name }}</td>
					<td class="center">{{ $user->country }}</td>
					<td class="center">{{ $user->phone }}</td>
					<td class="center">{{ $user->enable }}</td>
					@if($user->role == 0)
					<td>
						<a href="{{action('UserController@show', $user->id)}}"><button type="button" class="btn btn-primary btn-sm">{{__('admin.user.btn_1')}}</button></a>
					</td>
					<td>
						@if($user->enable == 0)
							<a href="{{action('UserController@edit', $user->id)}}"><button type="button" class="btn btn-success btn-sm">{{__('admin.user.btn_2')}}</button></a>
						@else 
							<a href="{{action('UserController@edit', $user->id)}}"><button type="button" class="btn btn-warning btn-sm">{{__('admin.user.btn_3')}}</button></a>
						@endif
					</td>
					<td>
						<form action="{{action('UserController@destroy', $user->id)}}" method="POST">
							@csrf
							<input name="_method" type="hidden" value="DELETE">
							<button class="btn btn-danger btn-sm" type="submit">{{__('admin.user.btn_4')}}</button>
						</form>
					</td>
					@elseif($user->role == 1)
					<td colspan="3">
						Administrator
					</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
		<div>
			{{ $users->appends(['sort' => 'id'])->links() }}
		</div>
	</div>
</div>

@endsection