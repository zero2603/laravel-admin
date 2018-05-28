@extends('layouts.app')

@section('content')

<div class="center col-lg-12">
    <div class="line-1">EatPlayWatch</div>
    <div class="line-2">Partner</div>
</div>

@endsection
<link href='https://fonts.googleapis.com/css?family=Miltonian Tattoo' rel='stylesheet'>
<style type="text/css">
.center { 
    height: 80%;
    position: relative;
}

.center .line-1, .center .line-2 {
    margin: 0;
    position: absolute;
    left: 50%;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    font-family: 'Miltonian Tattoo';font-size: 8vw;
}

.line-1 {
    top: 40%;
}
.line-2 {
    top: 60%;
}

@media only screen and (max-width: 768px) {
    .center .line-1, .center .line-2 {
        margin: 0;
        position: absolute;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        font-family: 'Miltonian Tattoo';font-size: 12vw;
    }
    .line-1 {
        top: 40%;
    }
    .line-2 {
        top: 50%;
    }
}
</style>