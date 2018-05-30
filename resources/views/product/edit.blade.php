@extends('master')

@section('title','Update Product')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.products.edit.page_header')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-12">
		<form action="{{action('ProductController@update', $product_data['id'])}}" method="POST">
			{{ csrf_field() }}
            <input name="_method" type="hidden" value="PATCH">

			<div class="form-group">
				<label for="product_name">{{__('content.products.edit.label_1')}}<span class="require">*</span></label>
				<input type="text" class="form-control" name="product_name" value="{{$product_data['title']}}"  required/>
			</div>

			<div class="form-group">
				<label for="description">{{__('content.products.edit.label_2')}}</label>
				<textarea rows="5" class="form-control" name="description">{{$product_data['description']}}</textarea>
			</div>

			<div class="form-group">
				<label for="price">{{__('content.products.edit.label_3')}}<span class="require">*</span></label>
				<input type="number" class="form-control" name="price" value="{{$product_data['price']}}" required/>
			</div>

            <div class="form-group">
                <label for="private_price">{{__('content.products.edit.label_4')}}<span class="require">*</span></label>
                <input type="number" class="form-control" name="private_price" value="{{$product_data['private_price']}}" onchange="check()"  required/>
            </div>

			<div class="form-group">
                <label for="map">{{__('content.products.edit.label_5')}}<span class="require">*</span></label>
                <div>
                    <div>
                        <input class="form-control" id="address" type="text" name="address" value="{{$product_data['address']}}" required>
                    </div>
                </div><br>
                <div id="map"></div>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3X4Z-4xD7iuYynSKwjR1Jk3AlKyYPbvI&callback=initMap"></script>
            </div>

			<div class="form-group">
				<label for="lat">{{__('content.products.edit.label_6')}}</label>
				<input type="text" class="form-control" name="lat" id="lat" readonly="yes" value="{{$product_data['lat_value']}}"/>
				<label for="lng">{{__('content.products.edit.label_7')}}</label>
				<input type="text" class="form-control" name="lng" id="lng" readonly="yes" value="{{$product_data['long_value']}}"/>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-success">
					{{__('content.products.button.button_3')}}
				</button>
				<button type="reset" class="btn btn-default">
					{{__('content.products.button.button_4')}}
				</button>
			</div>

		</form>

	</div>
	<!-- /.col-lg-12 -->
</div>


@endsection

<style type="text/css">
    #map{ width:700px; height: 500px; }
</style>
<script type="text/javascript">
    function initMap() {
    var latlng = new google.maps.LatLng(21.028511, 105.804817);
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: latlng 
    });
    var geocoder = new google.maps.Geocoder();

    document.getElementById('address').addEventListener('change', function() {
      geocodeAddress(geocoder, map);
    });
  }

  function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('address').value;
    geocoder.geocode({'address': address}, function(results, status) {
      if (status === 'OK') {
        resultsMap.setCenter(results[0].geometry.location);

        var marker = new google.maps.Marker({
          map: resultsMap,
          position: results[0].geometry.location
        });

        document.getElementById('lat').value = marker.getPosition().lat();
        document.getElementById('lng').value = marker.getPosition().lng();
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }

</script>

<script type="text/javascript">
  function check() {
    var price = document.getElementById('price');
    var private_price = document.getElementById('private_price');
    if(private_price.value >= price.value) 
      alert("Reseller price must be smaller than regular price!");
    private_price.value = null;
  }
</script>