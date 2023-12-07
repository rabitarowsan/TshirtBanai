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
<form action="{{ route('customize.store') }}" method="POST" enctype ="multipart/form-data">
@csrf
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
        <label for="tshirt-type" class="form-label">T-Shirt Type:</label>
        <select name="type" id="tshirt-type" class="form-select mb-3" onchange="tshirtCustomizer.updateTshirtType()">
                <option value="" disabled selected>Select T-Shirt Type</option>
                <option value="shortsleeve">Short Sleeve</option>
                <option value="fullsleeve">Full Sleeve</option>
                <option value="poloshirt">Polo Shirt</option>
                <!-- Add more T-shirt types as needed -->
            </select>
            <label for="tshirt-fabric" class="form-label">T-Shirt Fabric:</label>
        <select name="fabric" id="tshirt-fabric" class="form-select mb-3">
                <option value="" disabled selected>Select Fabric</option>
                <option value="cotton">Cotton</option>
                <option value="polyester">Polyester</option>
                <option value="spandex">Spandex</option>
                <!-- Add more T-shirt types as needed -->
            </select>
                      
            <p>Pick Color for T-Shirt: <input type="color" name="color" value="#ffffff" id="clr" onchange="updateTshirtColor()"></p>

            <label for="tshirt-custompicture" class="form-label">Upload your own design:</label>
            <input type="file" name="custom_design" id="tshirt-custompicture" class="form-control mb-3" />
            <label for="tshirt-type" class="form-label">T-Shirt Type:</label>
        <select name="print_type" id="print-type" class="form-select mb-3">
        <option value="" disabled selected>Select Print Type</option>
                <option value="embroidery">Embroidery</option>
                <option value="screenprinting">Screen Printing</option>
                <!-- Add more T-shirt types as needed -->
            </select>

            <label for="text-color" class="form-label" style="display: inline-block; margin-right: 10px;">Text Color:</label>
            <input type="color" name="textcolor" value="#000000" id="text-color" onchange="updateTextColor()" style="display: inline-block; vertical-align: middle;">
            <br>

            <label for="text-font" class="form-label" style="display: inline-block; margin-right: 10px;">Text Font:</label>
            <select name="textfont" id="text-font" class="form-select mb-3" style="display: inline-block; vertical-align: middle;">
                <option value="" disabled selected>Select Font</option>
                <option value="Arial">Arial</option>
                <option value="Helvetica">Helvetica</option>
                <option value="Times New Roman">Times New Roman</option>
                <!-- Add more font options as needed -->
            </select>
            <label for="tshirt-text" class="form-label">Add Text:</label>
            <input type="text" name="text" id="tshirt-text" class="form-control mb-3" placeholder="Enter text">
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
<input type="hidden" name="exported_image" id="exported-image">

<button type="submit" class="btn btn-success" id="export-button">Export T-Shirt Image</button>


<!-- Include jQuery from a CDN -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
    $('#export-button').on('click', function(e) {
    e.preventDefault(); // Prevent the default form submission
    tshirtCustomizer.exportTshirtImage();
});

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

<script>
class TshirtCustomizer {
    constructor() {
        this.canvas = new fabric.Canvas("tshirt-canvas");
        this.rotateThisImage = null;
    }

    init() {
        $('#tshirt-design').on('change', () => this.updateTshirtImage());
        $('#tshirt-color').on('change', () => this.updateTshirtColor());
        $('#tshirt-custompicture').on('change', (e) => this.handleCustomPictureChange(e));
        $('#tshirt-text').on('input', () => this.updateTextColor());
        $('#text-font').on('change', () => this.updateTextFont());
        $('#add-text-button').on('click', () => this.addTextToCanvas());
        $('#export-button').on('click', () => this.exportTshirtImage());
        $('#rotate').on('click', () => this.rotateSelectedImage());
    }

    handleCustomPictureChange(e) {
        const reader = new FileReader();
    
        reader.onload = (event) => {
            const imgObj = new Image();
            imgObj.src = event.target.result;
    
            imgObj.onload = () => {
                const img = new fabric.Image(imgObj);
                img.scaleToHeight(100);
                img.scaleToWidth(100);
                this.canvas.centerObject(img);
                this.addCloseAndRemoveButtons(img);
                this.canvas.add(img);
                this.canvas.renderAll();
            };
    
            imgObj.onerror = (error) => {
                console.error('Error loading image:', error);
            };
        };
    
        if (e.target.files[0]) {
            reader.readAsDataURL(e.target.files[0]);
        }
    }
    

    updateTextColor() {
        const selectedColor = $('#text-color').val();
        $('#tshirt-text').css('color', selectedColor);
    }

    addTextToCanvas() {
        const text = $('#tshirt-text').val();
        const font = $('#text-font').val();
        const textColor = $('#text-color').val();
    
        const canvasText = new fabric.IText(text, {
            left: 50,
            top: 50,
            fontFamily: font,
            fill: textColor,
        });
    
        this.addCloseAndRemoveButtons(canvasText);
        this.canvas.add(canvasText);
        this.canvas.renderAll(); // Add this line to render the canvas after adding text
    }
    

    addCloseAndRemoveButtons(object) {
        const closeButton = new fabric.Text('X', {
            fontFamily: 'Arial',
            fontSize: 16,
            fill: 'red',
            originX: 'right',
            originY: 'top',
            selectable: false,
        });

        const removeButton = new fabric.Text('Remove', {
            fontFamily: 'Arial',
            fontSize: 16,
            fill: 'blue',
            originX: 'left',
            originY: 'top',
            selectable: false,
        });

        closeButton.on('mousedown', () => this.removeObject(object, closeButton, removeButton));
        removeButton.on('mousedown', () => this.removeObject(object, closeButton, removeButton));

        object.on('selected', () => {
            this.canvas.add(closeButton);
            this.canvas.add(removeButton);
        });

        object.on('deselected', () => {
            this.canvas.remove(closeButton);
            this.canvas.remove(removeButton);
        });
    }

    removeObject(object, closeButton, removeButton) {
        this.canvas.remove(object);
        this.canvas.remove(closeButton);
        this.canvas.remove(removeButton);
        this.canvas.renderAll();
    }

    exportTshirtImage() {
        // Create a new fabric canvas to compose the entire design
        const exportCanvas = new fabric.Canvas();
    
        // Set canvas dimensions to cover the entire design
        exportCanvas.setDimensions({
            width: this.canvas.width,
            height: this.canvas.height
        });
    
        // Add background image
        const backgroundImage = new fabric.Image(document.getElementById('tshirt-backgroundpicture'));
        exportCanvas.add(backgroundImage);
    
        // Set background color
        const tshirtColor = $('#tshirt-div').css('background-color');
        exportCanvas.setBackgroundColor(tshirtColor, exportCanvas.renderAll.bind(exportCanvas));
    
        // Clone and add all objects from the original canvas
        this.canvas.getObjects().forEach(obj => {
            const objClone = fabric.util.object.clone(obj);
            exportCanvas.add(objClone);
        });
    
        // Convert the composite canvas to PNG
        const dataUrl = exportCanvas.toDataURL({
            format: 'png',
            multiplier: 3, // You can adjust the multiplier for better resolution
        });
    
        // Trigger download
        const a = document.createElement('a');
        a.href = dataUrl;
        a.download = 'tshirt_design.png';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
    updateTshirtType() {
        const selectedType = $('#tshirt-type').val();
        
        let imagePath;
    
        // Set the image path based on the selected T-shirt type
        switch (selectedType) {
            case 'shortsleeve':
                imagePath = "{{ asset('uploads/shortsleeve.png') }}";
                break;
            case 'fullsleeve':
                imagePath = "{{ asset('uploads/fullsleeve.png') }}";
                break;
            case 'poloshirt':
                imagePath = "{{ asset('uploads/poloshirt.png') }}";
                break;
            // Add more cases for other T-shirt types as needed
            default:
                // Default to a fallback image if the selected type is not recognized
                imagePath = '{{ asset("uploads/default.png") }}';
                break;
        }
    
        // Update the background image of tshirt-div
        $('#tshirt-backgroundpicture').attr('src', imagePath);
    
        // Call the function to update the canvas with the new T-shirt type
        tshirtCustomizer.updateTshirtImage();
    }
    
    
    updateTshirtImage() {
        const imageURL = $('#tshirt-design').val();
        console.log('Image URL:', imageURL); // Log the image URL to the console
    
        fabric.Image.fromURL(imageURL, (img) => {
            img.scaleToHeight(75);
            img.scaleToWidth(75);
    
            // Remove existing objects from canvas
            this.canvas.clear();
    
            // Add the new background image
            const backgroundImage = new fabric.Image(document.getElementById('tshirt-backgroundpicture'));
            this.canvas.add(backgroundImage);
    
            // Add the new image
            this.canvas.centerObject(img);
            this.addCloseAndRemoveButtons(img);
            this.canvas.add(img);
            this.canvas.renderAll();
        });
    }
    
    

    updateTshirtColor() {
        const selectedColor = $('#tshirt-color').val();
        $('#tshirt-div').css('background-color', selectedColor);
    }

    updateTextFont() {
        const font = $('#text-font').val();
        $('#tshirt-text').css('font-family', font);
    }

    rotateSelectedImage() {
        if (this.canvas._activeObject) {
            const curAngle = this.canvas._activeObject.angle;
            this.canvas._activeObject.angle = curAngle + 15;
            this.canvas.renderAll();
        }
    }
}

const tshirtCustomizer = new TshirtCustomizer();
tshirtCustomizer.init();

    

</script>

@endsection