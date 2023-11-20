@extends('layout')

@section('title', 'T-Shirt Banai - Home')
<link href="{{ asset('assets/css/customize.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
@section('content')
<label for="tshirt-design">Sample Design:</label>
        <select id="tshirt-design">
            <option value="">Select a sample designs ...</option>
            <option value="https://cdn.ourcodeworld.com/public-media/gallery/gallery-5d5b0e95d294c.png">Batman</option>
        </select>
        
         <label for="tshirt-color">T-Shirt Color:</label>
        <select id="tshirt-color">
            <!-- You can add any color with a new option and definings its hex code -->
            <option value="#fff">White</option>
            <option value="#000">Black</option>
            <option value="#f00">Red</option>
            <option value="#008000">Green</option>
            <option value="#ff0">Yellow</option>
        </select>
        
        <label for="tshirt-custompicture">Upload your own design:</label>
        <input type="file" id="tshirt-custompicture" />

      </div>
  
<div class="container h-100">
  <div class="row h-100 justify-content-center align-items-center">
    <!-- Create the container of the tool -->
        <div id="tshirt-div" style="padding-left:0px;">
            <img id="tshirt-backgroundpicture" src="https://cdn.ourcodeworld.com/public-media/gallery/gallery-5d5afd3f1c7d6.png" width="460" height=""/>
            <div id="drawingArea" class="drawing-area">					
                <div class="canvas-container">
                    <canvas id="tshirt-canvas" width="440" height="530"></canvas>
                </div>
            </div>
        </div>
<!-- Include jQuery from a CDN -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('assets/js/customize.js') }}"></script>


@endsection
