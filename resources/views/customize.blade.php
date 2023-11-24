@extends('layout')

@section('title', 'T-Shirt Banai - Home')
<link href="{{ asset('assets/css/customize.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>


@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
        <label for="tshirt-type" class="form-label">T-Shirt Type:</label>
        <select id="tshirt-type" class="form-select mb-3" onchange="tshirtCustomizer.updateTshirtType()">
                <option value="shortsleeve">Short Sleeve</option>
                <option value="fullsleeve">Full Sleeve</option>
                <option value="poloshirt">Polo Shirt</option>
                <!-- Add more T-shirt types as needed -->
            </select>
            <label for="tshirt-design" class="form-label">Sample Design:</label>
            <select id="tshirt-design" class="form-select mb-3">
                <option value="">Select a sample design...</option>
                <option value="https://cdn.ourcodeworld.com/public-media/gallery/gallery-5d5b0e95d294c.png">Batman</option>
            </select>

            <label for="tshirt-color" class="form-label">T-Shirt Color:</label>
            <p>
                <input type="color" value="#ffffff" id="clr" onchange="updateTshirtColor()">
                Pick Color for T-Shirt
            </p>

            <label for="tshirt-custompicture" class="form-label">Upload your own design:</label>
            <input type="file" id="tshirt-custompicture" class="form-control mb-3" />

            

            <label for="text-color" class="form-label" style="display: inline-block; margin-right: 10px;">Text Color:</label>
            <input type="color" value="#000000" id="text-color" onchange="updateTextColor()" style="display: inline-block; vertical-align: middle;">
            <br>

            <label for="text-font" class="form-label" style="display: inline-block; margin-right: 10px;">Text Font:</label>
            <select id="text-font" class="form-select mb-3" style="display: inline-block; vertical-align: middle;">
                <option value="Arial">Arial</option>
                <option value="Helvetica">Helvetica</option>
                <option value="Times New Roman">Times New Roman</option>
                <!-- Add more font options as needed -->
            </select>
            <label for="tshirt-text" class="form-label">Add Text:</label>
            <input type="text" id="tshirt-text" class="form-control mb-3" placeholder="Enter text">
            <button class="btn btn-primary" onclick="tshirtCustomizer.addTextToCanvas()">Add Text to Canvas</button>


        </div>

        <div class="col-md-8">
            <div id="tshirt-div" class="text-center">
                <img id="tshirt-backgroundpicture" src="{{ asset('uploads/shortsleeve.png') }}" class="img-fluid border-0" alt="T-Shirt Image">
                <div id="drawingArea" class="drawing-area">
                    <div class="canvas-container">
                        <canvas id="tshirt-canvas" width="440" height="530"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add this button where you want it in your HTML -->
<button class="btn btn-success" onclick="tshirtCustomizer.exportTshirtImage()">Export T-Shirt Image</button>




<!-- Include jQuery from a CDN -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('assets/js/customize.js') }}"></script>

<script>
    function updateTshirtColor() {
        const selectedColor = $('#clr').val();
        $('#tshirt-div').css('background-color', selectedColor);
    }

    // Add event listener to update T-shirt design
    $('#tshirt-design').change(function() {
        updateTshirtImage($(this).val());
    });

    // Add event listener to update T-shirt color when the color picker changes
    $('#clr').change(updateTshirtColor);
    // Add event listener to update color viewer when the color is changed
    $('#tshirt-color').change(function() {
        const selectedColor = $(this).val();
        $('#color-viewer').css('background-color', selectedColor);
    });
</script>

@endsection