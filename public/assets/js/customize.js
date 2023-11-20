// Create a single instance of fabric.Canvas
const canvas = new fabric.Canvas("tshirt-canvas");

// Function to update T-shirt design
function updateTshirtImage(imageURL) {
    fabric.Image.fromURL(imageURL, function (img) {
        img.scaleToHeight(300);
        img.scaleToWidth(300);
        canvas.centerObject(img);

        // Add close and remove buttons to the design
        addCloseAndRemoveButtons(img);

        canvas.add(img);
        canvas.renderAll();
    });
}

// Function to add text to the canvas
function addTextToCanvas() {
    const text = $('#tshirt-text').val();
    const font = $('#text-font').val();
    const textColor = $('#text-color').val();

    const canvasText = new fabric.IText(text, {
        left: 50,
        top: 50,
        fontFamily: font,
        fill: textColor,
    });

    // Add close and remove buttons to the text
    addCloseAndRemoveButtons(canvasText);

    // Add the text to the canvas
    canvas.add(canvasText);
}

// Function to add close and remove buttons to the object
function addCloseAndRemoveButtons(object) {
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

    closeButton.on('mousedown', function () {
        canvas.remove(object);
        canvas.remove(this);
        canvas.renderAll();
    });

    removeButton.on('mousedown', function () {
        canvas.remove(object);
        canvas.remove(this);
        canvas.renderAll();
    });

    object.on('selected', function () {
        canvas.add(closeButton);
        canvas.add(removeButton);
    });

    object.on('deselected', function () {
        canvas.remove(closeButton);
        canvas.remove(removeButton);
    });
}

// Update the T-Shirt color according to the selected color by the user
document.getElementById("tshirt-color").addEventListener("change", function () {
    document.getElementById("tshirt-div").style.backgroundColor = this.value;
}, false);

// Update the T-Shirt design according to the selected design by the user
document.getElementById("tshirt-design").addEventListener("change", function () {
    updateTshirtImage(this.value);
}, false);

// When the user clicks on upload a custom picture
document.getElementById("tshirt-custompicture").addEventListener("change", function (e) {
    var reader = new FileReader();

    reader.onload = function (event) {
        var imgObj = new Image();
        imgObj.src = event.target.result;

        // When the picture loads, create the image in Fabric.js
        imgObj.onload = function () {
            var img = new fabric.Image(imgObj);
            img.scaleToHeight(300);
            img.scaleToWidth(300);
            canvas.centerObject(img);

            // Add close and remove buttons to the design
            addCloseAndRemoveButtons(img);

            canvas.add(img);
            canvas.renderAll();
        };
    };

    // If the user selected a picture, load it
    if (e.target.files[0]) {
        reader.readAsDataURL(e.target.files[0]);
    }
}, false);

// When the user selects a picture that has been added and presses the DEL key
// The object will be removed!
document.addEventListener("keydown", function (e) {
    var keyCode = e.keyCode;

    if (keyCode == 46) {
        const activeObject = canvas.getActiveObject();
        if (activeObject) {
            canvas.remove(activeObject);
            canvas.renderAll();
        }
    }
}, false);

// Function to update text color
function updateTextColor() {
    const selectedColor = $('#text-color').val();
    $('#tshirt-text').css('color', selectedColor);
}

// Rest of your existing code...

// Angular module and controller (if needed)...

// Function to load fonts and paging (if needed)...
