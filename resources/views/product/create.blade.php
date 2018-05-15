@extends('master')

@section('title','Add Product')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Create Products</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-12">
		<form action="{{ action('ProductController@store') }}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="product_name">Item you want to promote<span class="require">*</span></label>
				<input type="text" class="form-control" name="product_name" />
        <small>i.e: a ticket, a seafood meal... </small>
      </div>

      <div class="form-group">
        <label for="description">What is included in this deal?</label>
        <textarea rows="5" class="form-control" name="description" ></textarea>
        <small>Describe your deal (products/services included) </small>
      </div>

      <div class="form-group">
        <label for="price">Regular Price<span class="require">*</span></label>
        <input type="text" class="form-control" name="price" />
      </div>

      <div class="form-group">
        <label for="private_price">Reseller price (Discounted price) for EatPlayWatch<span class="require">*</span></label>
        <input type="text" class="form-control" name="private_price" />
      </div>

      <div class="form-group">
        <label for="map">Address<span class="require">*</span></label>
        <div id="map"></div>
      </div>

      <div class="form-group">
        <label for="lat">Latitude</label>
        <input type="text" class="form-control" name="lat" id="lat" readonly="yes" />
        <label for="lng">Longtitude</label>
        <input type="text" class="form-control" name="lng" id="lng" readonly="yes" />
        <label for="address">Place Name</label>
        <input type="text" class="form-control" name="address" id="address" readonly="yes" />
      </div>

      <div class="custom-file">
        <label class="custom-file-label" for="images">Choose item's gallery</label>
        <input type="file" class="custom-file-input" id="customFile" name="images[]" multiple>
      </div><br>

      <div class="form-group">
        <button type="submit" class="btn btn-success">
         Next
       </button>
       <button type="reset" class="btn btn-default">
         Cancel
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVZhmwQOlfhc-NoaHBFRaUEfOTWSjbwWk&callback=initMap"></script>
<script type="text/javascript">
	//Set up some of our variables.
var map; //Will contain map object.
var marker = false; ////Has the user plotted their location marker? 

//Function called to initialize / create the map.
//This is called when the page has loaded.
function initMap() {

    //The center location of our map.
    var centerOfMap = new google.maps.LatLng(21.0228161, 105.801944);
    var geocoder = new google.maps.Geocoder();

    //Map options.
    var options = {
      center: centerOfMap, //Set center.
      zoom: 10 //The zoom value.
    };

    //Create the map object.
    map = new google.maps.Map(document.getElementById('map'), options);

    //Listen for any clicks on the map.
    google.maps.event.addListener(map, 'click', function(event) {       
     geocoder.geocode({
      'latLng': event.latLng
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
       if (results[0]) {
         document.getElementById('address').value = results[0].formatted_address;
       }
     }
   });
        //Get the location that the user clicked.
        var clickedLocation = event.latLng;
        //If the marker hasn't been added.
        if(marker === false){
            //Create the marker.
            marker = new google.maps.Marker({
            	position: clickedLocation,
            	map: map,
                draggable: true //make it draggable
              });
            //Listen for drag events!
            google.maps.event.addListener(marker, 'dragend', function(event){
            	markerLocation();
            });
          } else{
            //Marker has already been added, so just change its location.
            marker.setPosition(clickedLocation);
          }
        //Get the marker's location.
        markerLocation();
      });
  }

//This function will get the marker's current location and then add the lat/long
//values to our textfields so that we can save the location.
function markerLocation(){
    //Get location.
    var currentLocation = marker.getPosition();
    //Add lat and lng values to a field that we can save.
    document.getElementById('lat').value = currentLocation.lat(); //latitude
    document.getElementById('lng').value = currentLocation.lng(); //longitude
    
  }


//Load the map when the page has finished loading.
google.maps.event.addDomListener(window, 'load', initMap);
</script>