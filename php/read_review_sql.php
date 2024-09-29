<?php
session_start();

//1. POSTデータ取得
$place_id = $_POST['place_id'];

//2. DB接続します
include 'util/db_connect.php';

//３．SQL
$sql = "SELECT * FROM review_table WHERE place_id = :place_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':place_id', $place_id, PDO::PARAM_INT); 
$status = $stmt->execute();

if($status==false) {
  $error = $stmt->errorInfo();
  exit("SQL_SELECT_ERROR: " . htmlspecialchars($error[2], ENT_QUOTES));
}

$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); 

$h = '';

if ($values) {
    foreach($values as $value) {
        // Escape special characters to prevent XSS attacks
        $review_id = $value["id"];
        // $review_id = htmlspecialchars($value["id"], ENT_QUOTES, 'UTF-8');
        $user_photo = htmlspecialchars($value["user-photo"], ENT_QUOTES, 'UTF-8');
        $username = htmlspecialchars($value["username"], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($value["email"], ENT_QUOTES, 'UTF-8');
        $rating = (int)$value["rating"]; // Ensure rating is an integer
        $review = htmlspecialchars($value["review"], ENT_QUOTES, 'UTF-8');
        $timestamp = htmlspecialchars($value["timestamp"], ENT_QUOTES, 'UTF-8');

        $h .= '<div class="comment-card">';

        // User block with photo and name
        $h .= '<div class="userblock">';
        $h .= '<img src="' . $user_photo . '" class="w-20 h-auto object-cover border-2 border-transparent rounded-full">';
        $h .= '<p class="username">' . $username . '</p>';
        $h .= '<p class="location-detail">' . $email . '</p>';

        // Star Rating
        $h .= '<div class="star-rating readonly">';
        for ($i = 0; $i < 5 - $rating; $i++) {
            $h .= '<span>★</span>';
        }
        for ($i = 0; $i < $rating; $i++) {
            $h .= '<span class="filled">★</span>';
        }
        $h .= '</div>'; // Closing star rating div
        $h .= '</div>'; // Closing userblock div

        // Review content
        $h .= '<p class="comment-content">';
        $h .= $review;
        $h .= '</p>';

        // Only when UserID matches the loginID, or when adminFlag = 1, show update and delete button
        if (isset($_SESSION["loginID"]) && $_SESSION["loginID"] !== "" && ($_SESSION["loginID"] == $username || $_SESSION["adminFlag"] == 1)) {
        
            // Update button
            $h .= '<span class="db_link">';
            $h .= '<button class = "px-3" id = "updateReviewBtn" review_id=' . $review_id . ' place_id=' . $place_id . '>';
            $h .= '<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.25 3.5C5.83579 3.5 5.5 3.83579 5.5 4.25V19.75C5.5 20.1642 5.83579 20.5 6.25 20.5H10.0293C9.92216 21.0483 10.0375 21.5732 10.3007 22H6.25C5.00736 22 4 20.9926 4 19.75V4.25C4 3.00736 5.00736 2 6.25 2H12.3358C12.7999 2 13.245 2.18437 13.5732 2.51256L19.4874 8.42678C19.8156 8.75497 20 9.20009 20 9.66421V10H19.8698C19.7592 9.99447 19.6484 9.99447 19.5378 10H14C12.8954 10 12 9.10457 12 8V3.5H6.25ZM13.5 4.56066V8C13.5 8.27614 13.7239 8.5 14 8.5H17.4393L13.5 4.56066Z" fill="#3d3d3d"></path> <path d="M19.7133 11H19.7154C20.3 11.0003 20.8845 11.2234 21.3305 11.6695C22.2231 12.5621 22.2231 14.0093 21.3305 14.9019L15.4281 20.8043C15.084 21.1485 14.6528 21.3926 14.1806 21.5106L12.3499 21.9683C11.5538 22.1674 10.8326 21.4462 11.0317 20.6501L11.4894 18.8194C11.6074 18.3472 11.8515 17.916 12.1957 17.5719L18.0981 11.6695C18.5441 11.2234 19.1287 11.0003 19.7133 11ZM20.2699 12.7301C19.963 12.4233 19.4656 12.4233 19.1587 12.7301L13.2563 18.6325C13.1044 18.7844 12.9967 18.9748 12.9446 19.1832L12.6538 20.3462L13.8168 20.0554C14.0252 20.0033 14.2155 19.8956 14.3674 19.7437L20.2699 13.8412C20.5767 13.5344 20.5767 13.0369 20.2699 12.7301Z" fill="#3d3d3d"></path> </g></svg>';
            $h .= '</button>';

            // Delete button
            $h .= '<a href="php/delete_review.php?review_id=' . $review_id . '&place_id=' . $place_id . '">';
            $h .='<svg fill="#000000" width="20px" height="20px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><defs><style>.cls-1{fill:none;}</style></defs><title>trash-can</title><rect x="12" y="12" width="2" height="12"></rect><rect x="18" y="12" width="2" height="12"></rect><path d="M4,6V8H6V28a2,2,0,0,0,2,2H24a2,2,0,0,0,2-2V8h2V6ZM8,28V8H24V28Z"></path><rect x="12" y="2" width="8" height="2"></rect><rect id="_Transparent_Rectangle_" data-name="<Transparent Rectangle>" class="cls-1" width="32" height="32"></rect></g></svg>';
            $h .= '</a>';

            $h .= '</span>';
        
        } 

        $h .= '</div>';

        }      

    // Output all reviews
    echo $h;
} else {
    echo "No reviews yet. Be the first to add one here!";
}

?>





