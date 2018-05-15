@extends('master')

@section('title','All Products')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">All Products</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		{{session('message')}}
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Title</th>
					<th scope="col">Price</th>
					<th scope="col">Status</th>
					<th scope="col">Date</th>
					<th scope="col" colspan="2">Option</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
				<tr class="odd gradeX">
					<td>{{ $product->ID }}</td>
					<td>{{ $product->post_title }}</td>
					<td class="center">{{ $product->_regular_price }}</td>
					<td class="center">{{ $product->status }}</td>
					<td class="center">{{ $product->post_date }}</td>
					<td>
						<a href="{{action('ProductController@edit',$product->ID)}}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
					</td>
					<td>
						<form action="{{action('ProductController@destroy', $product->ID)}}" method="POST">
							@csrf
							<input name="_method" type="hidden" value="DELETE">
							<button class="btn btn-danger btn-sm" type="submit">Delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div>
			{{ $products->appends(['sort' => 'ID'])->links() }}
		</div>
	</div>
</div>

@endsection