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
