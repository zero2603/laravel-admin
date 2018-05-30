@extends('master')

@section('title','Add Product')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.products.create.page_header')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-12">
		<form action="{{ action('ProductController@store') }}" method="POST" enctype="multipart/form-data">
			<small><span>*</span> {{__('content.products.create.text')}}</small>
      {{ csrf_field() }}
      <div class="form-group">
        <label for="product_name">{{__('content.products.create.label_1')}}<span class="require">*</span></label>
        <input type="text" class="form-control" name="product_name" required/>
      </div>

      <div class="form-group">
        <label for="description">{{__('content.products.create.label_2')}}</label>
        <textarea rows="5" class="form-control" name="description" ></textarea>
      </div>

      <div class="form-group">
        <label for="price">{{__('content.products.create.label_3')}}<span class="require">*</span></label>
        <input type="number" class="form-control" id="price" name="price" required/>
      </div>

      <div class="form-group">
        <label for="private_price">{{__('content.products.create.label_4')}}<span class="require">*</span></label>
        <input type="number" class="form-control" id="private_price" name="private_price" required onchange="check()" />
      </div>

      <div class="form-group">
        <label for="map">{{__('content.products.create.label_5')}}<span class="require">*</span></label>
        <div>
          <div>
            <input class="form-control" id="address" type="text" name="address" required>
          </div>
        </div><br>
        <div id="map"></div>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3X4Z-4xD7iuYynSKwjR1Jk3AlKyYPbvI&callback=initMap"></script>
      </div>

      <div class="form-group">
        <label for="lat">{{__('content.products.create.label_6')}}</label>
        <input type="text" class="form-control" name="lat" id="lat" readonly="yes" />
        <label for="lng">{{__('content.products.create.label_7')}}</label>
        <input type="text" class="form-control" name="lng" id="lng" readonly="yes" />
      </div>

      <div class="custom-file">
        <label class="custom-file-label" for="images">{{__('content.products.create.label_8')}} *</label>
        <input type="file" class="custom-file-input" id="customFile" name="images[]" multiple required>
      </div><br>

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
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->


<script type="text/javascript">
	function initMap() {
    var latlng = new google.maps.LatLng(21.028511, 105.804817);
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: latlng 
    });
    var geocoder = new google.maps.Geocoder();
    var marker = new google.maps.Marker({
      position: latlng,
      map: map,
    });

    google.maps.event.addListener(map, 'click', function(event) {
      placeMarker(event.latLng);
    });

    function placeMarker(location) {
      marker.setMap(map);
      marker.setPosition(location);
      document.getElementById('lat').value = marker.getPosition().lat();
      document.getElementById('lng').value = marker.getPosition().lng();
   }

   document.getElementById('address').addEventListener('change', function() {
    geocodeAddress(geocoder, map, marker);
  });
 }

 function geocodeAddress(geocoder, resultsMap, marker) {
  var address = document.getElementById('address').value;
  geocoder.geocode({'address': address}, function(results, status) {
    if (status === 'OK') {
      resultsMap.setCenter(results[0].geometry.location);

      marker.setMap(resultsMap);
      marker.setPosition(results[0].geometry.location);

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