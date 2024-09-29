$(document).ready(function() {
    let slideIndex = 1;
    showSlides(slideIndex);

    // Dot click event
    $('.dot').click(function() {
        currentSlide($(this).index() + 1);
    });

    // Image Upload handling
    const $imageInput = $('#image-input');
    const $previewContainer = $('#preview-container');
    
    // Declare filesArray in a higher scope
    window.filesArray = []; // Declare filesArray globally

    // Handle file selection and preview
    $imageInput.on('change', function(event) {
        const files = event.target.files;
        $.each(files, function(_, file) {
            if (file.type.startsWith('image/')) {
                // Check if the file is already in the array based on a unique identifier
                if (!filesArray.some(f => f.name === file.name && f.size === file.size && f.lastModified === file.lastModified)) {
                    previewImage(file);
                    filesArray.push(file); // Push new file to filesArray
                }
            }
        });
        $imageInput.val(''); // Clear input
    });

    // Form submission interception
    $('#locationForm').on('submit', function(e) {
        e.preventDefault();
        const $submitButton = $(this).find('button[type="submit"]');
        $submitButton.prop('disabled', true);

        if (filesArray.length === 0) {
            alert('Please select at least one image to upload.');
            $submitButton.prop('disabled', false); // Re-enable button
            return;
        }

        submitFormData(this, filesArray, $submitButton);
    });
});

// Show Image
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let slides = $(".mySlides");
    let dots = $(".dot");

    if (n > slides.length) slideIndex = 1;
    if (n < 1) slideIndex = slides.length;

    slides.hide();
    dots.removeClass("active");
    slides.eq(slideIndex - 1).show();
    dots.eq(slideIndex - 1).addClass("active");
}

// Show Preview Image
function previewImage(file) {
    const reader = new FileReader();
    const $previewContainer = $('#preview-container');

    reader.onload = function(e) {
        const $previewBox = $('<div class="preview-box"></div>');
        const $img = $('<img>').attr('src', e.target.result);
        const $removeBtn = $('<button class="img-remove-btn">X</button>');

        $removeBtn.on('click', function() {
            $previewBox.remove();
            // Update filesArray to remove the file based on its unique identifier
            filesArray = filesArray.filter(f => f.name !== file.name || f.size !== file.size || f.lastModified !== file.lastModified);
        });

        $previewBox.append($img).append($removeBtn);
        $previewContainer.append($previewBox);
    };

    reader.readAsDataURL(file);
}

// Submit Form
function submitFormData(form, filesArray, $submitButton) {
    const formData = new FormData(form);
    const newFormData = new FormData();

    for (let [key, value] of formData.entries()) {
        if (key !== 'images[]') {
            newFormData.append(key, value);
        }
    }

    $.each(filesArray, function(_, file) {
        if (file.size > 0) {
            newFormData.append('images[]', file);
        }
    });

    $.ajax({
        url: 'php/write_place_upload_image.php',
        type: 'POST',
        data: newFormData,
        processData: false,
        contentType: false,
        success: function(result) {
            $('#error-messages').html(result);
            $('#preview-container').empty(); // Clear previews
            filesArray.length = 0; // Reset files array
        },
        error: function(error) {
            console.error('Error:', error);
        },
        complete: function() {
            $submitButton.prop('disabled', false); // Re-enable button
        }
    });
}
