// Load List of all Topics
export function loadTopicList() {
    $("#topic-list").empty();
    $.ajax({
        url: "php/read_place_list_sql.php", 
        method: "POST",
        success: function(response) {
            $("#topic-list").html(response);
        },
        error: function(xhr, status, error) {
            console.error("An error occurred:", error);
        }
    });
}

// Load Msg of Selected Topic
export function loadTopicMessages(place_id) {
    $("#discussion").empty();
    $.ajax({
        url: "php/read_place_detail_sql.php", 
        method: "POST",
        data: { place_id: place_id }, 
        success: function(response) {
            $("#discussion").html(response);
        },
        error: function(xhr, status, error) {
            console.error("An error occurred:", error);
        }
    });

}

// Load Msg of Selected Topic
export function loadReview(place_id) {
    $("#reviewArea").empty();
    $.ajax({
        url: "php/read_review_sql.php", 
        method: "POST",
        data: { place_id: place_id }, 
        success: function(response) {
            $("#reviewArea").html(response);
        },
        error: function(xhr, status, error) {
            console.error("An error occurred:", error);
        }
    });
}

// Fetch review data for updating
export function fetchReviewData(review_id, place_id) {
    $.ajax({
        url: 'php/fetch_review.php',
        type: 'GET',
        data: { review_id: review_id, place_id: place_id },
        success: function(response) {
            const reviewData = JSON.parse(response);
            openModal(reviewData); // Pass fetched data to the modal
        },
        error: function(error) {
            console.log('Error fetching review data:', error);
        }
    });
}

// Function to open the modal for insert or update
export function openModal(reviewData) {

    // Check if this is an insert or an update
    if (reviewData) {
        // Update form for an existing review
        $(`input[name="user-icon"][value="${reviewData['user-photo']}"]`)
            .prop('checked', true)
            .trigger('change');  // Trigger change manually
        
        $('#reviewFormTitle').text('Update Review');
        $('#reviewForm').attr('action', 'php/update_review_sql.php');
        $('#review_id').val(reviewData.id);
        $('#place_id').val(reviewData.place_id);
        $('#username').val(reviewData.username);
        $('#email').val(reviewData.email);
        $('#review').val(reviewData.review);
        $(`input[name="rating"][value="${reviewData.rating}"]`).prop('checked', true);
    } else {
        // Prepare form for a new review (insert)
        $('#reviewFormTitle').text('New Review');
        $('#reviewForm').attr('action', 'php/write_review_sql.php');
        $('#review_id, #place_id, #username, #email, #review').val('');
    }
    // Show the modal
    $('#reviewFormDiv').show();
}

