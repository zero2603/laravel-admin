@extends('master')

@section('title','All Transactions')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('All Transactions')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Partner ID</th>
					<th scope="col">Balance Change</th>
					<th scope="col">Status</th>
					<th scope="col">Content</th>
					<th scope="col">Date</th>
					<th scope="col" colspan="2">Option</th>
				</tr>
			</thead>
			<tbody>
				@foreach($transactions as $transaction)
				<tr class="odd gradeX">
					<td>{{ $transaction->id }}</td>
					<td>{{ $transaction->partner_id }}</td>
					<td>{{ $transaction->balance_change }}</td>
					<td>{{ $transaction->status }}</td>
					<td>{{ $transaction->content }}</td>
					<td>{{ $transaction->updated_at }}</td>
					<td>
						<a href="{{action('PartnerTransactionController@show', $transaction->id)}}">
							<button class="btn btn-primary btn-sm">{{__('content.order.button_view')}}</button>
						</a>
					</td>
					<td>
						<form method="POST" action="{{action('PartnerTransactionController@destroy', $transaction->id)}}">
							@csrf
							<input type="hidden" name="_method" value="DELETE">
							<button type="submit" class="btn btn-danger btn-sm">Delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div>
			{{ $transactions->appends(['sort' => 'ID'])->links() }}
		</div>
	</div>
</div>


@endsection