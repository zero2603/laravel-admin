@extends('master')

@section('title','Annoucements')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('Annoucements')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">English Title</th>
					<th scope="col">Vietnamese Title</th>
					<th scope="col">English Content</th>
					<th scope="col">Vietnamese Content</th>
					<th scope="col">Date</th>
					<th scope="col" colspan="2">Option</th>
				</tr>
			</thead>
			<tbody>
				@foreach($annoucements as $annoucement)
				<tr class="odd gradeX">
					<td>{{ $annoucement->id }}</td>
					<td>{{ $annoucement->eng_title }}</td>
					<td>{{ $annoucement->vie_title }}</td>
					<td>{{ $annoucement->eng_content }}</td>
					<td>{{ $annoucement->vie_content }}</td>
					<td>{{ $annoucement->updated_at }}</td>
					<td>
						<a href="{{action('AnnoucementController@edit', $annoucement->id)}}">
							<button class="btn btn-primary btn-sm">{{__('Edit')}}</button>
						</a>
					</td>
					<td>
						<form  method="POST" action="{{action('AnnoucementController@destroy', $annoucement->id)}}">
							@csrf
							<input name="_method" type="hidden" value="DELETE">
							<button class="btn btn-danger btn-sm" type="submit">{{__('Delete')}}</button>
						</form>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div>
			{{ $annoucements->appends(['sort' => 'id'])->links() }}
		</div>
	</div>
</div>

@endsection