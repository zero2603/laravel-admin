@extends('master')

@section('title','Add Product')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.products.create_product_title')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-12">
		<form action="{{ action('ProductController@store') }}" method="POST" enctype="multipart/form-data">
			<small><span>*</span> Feild is required.</small>
      {{ csrf_field() }}
			<div class="form-group">
				<label for="product_name">{{__('content.products.product_title')}}<span class="require">*</span></label>
				<input type="text" class="form-control" name="product_name" required/>
        <small>{{__('content.products.product_subtitle')}}</small>
      </div>

      <div class="form-group">
        <label for="description">{{__('content.products.description')}}</label>
        <textarea rows="5" class="form-control" name="description" ></textarea>
        <small>{{__('content.products.sub_description')}} </small>
      </div>

      <div class="form-group">
        <label for="price">{{__('content.products.regular_price')}}<span class="require">*</span></label>
        <input type="number" class="form-control" id="price" name="price" required/>
      </div>

      <div class="form-group">
        <label for="private_price">{{__('content.products.resell_price')}}<span class="require">*</span></label>
        <input type="number" class="form-control" id="private_price" name="private_price" required onchange="check()" />
      </div>

      <div class="form-group">
        <label for="map">{{__('content.products.address')}}<span class="require">*</span></label>
        <div>
          <div>
            <input class="form-control" id="address" type="text" name="address" required>
          </div>
        </div><br>
        <div id="map"></div>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3X4Z-4xD7iuYynSKwjR1Jk3AlKyYPbvI&callback=initMap"></script>
      </div>

      <div class="form-group">
        <label for="lat">{{__('content.products.lat')}}</label>
        <input type="text" class="form-control" name="lat" id="lat" readonly="yes" />
        <label for="lng">{{__('content.products.lng')}}</label>
        <input type="text" class="form-control" name="lng" id="lng" readonly="yes" />
      </div>

      <div class="custom-file">
        <label class="custom-file-label" for="images">{{__('content.products.add_image_title')}} *</label>
        <input type="file" class="custom-file-input" id="customFile" name="images[]" multiple required>
      </div><br>

      <div class="form-group">
        <button type="submit" class="btn btn-success">
         {{__('content.products.button_complete')}}
       </button>
       <button type="reset" class="btn btn-default">
         {{__('content.products.button_cancel')}}
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
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->


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