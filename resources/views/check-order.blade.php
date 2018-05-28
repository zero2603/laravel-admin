@extends('master')

@section('title','Charts')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Check Your Order</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
@if(!empty($message))
	@if($flag == 0)
	<div class="alert alert-danger">
		{{$message}}
	</div>
	@elseif($flag == 1)
	<div class="alert alert-success">
		{{$message}}
	</div>
	<hr>
	<div>
		<a href="{{url('/')}}/order/{{$order_id}}"><button class="btn btn-success btn-lg">View order detail here</button></a>
	</div>
	@endif
@endif

@endsection
