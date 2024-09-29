<?php
//1. POSTデータ取得
// $place_id = $_GET['place_id'];

//2. DB接続します
// include 'util/db_connect.php';

//３．SQL
$sql = "SELECT * FROM review_table WHERE place_id = :place_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':place_id', $place_id, PDO::PARAM_INT); 
$status = $stmt->execute();

if($status==false) {
  $error = $stmt->errorInfo();
  exit("SQL_SELECT_ERROR: " . htmlspecialchars($error[2], ENT_QUOTES));
}

$total = 0;
$count = 0;
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); 

$h ='';

// Initialize the ratings data array with count 0 for each level
$ratingsData = [
    5 => ['level' => 5, 'count' => 0],
    4 => ['level' => 4, 'count' => 0],
    3 => ['level' => 3, 'count' => 0],
    2 => ['level' => 2, 'count' => 0],
    1 => ['level' => 1, 'count' => 0]
];

if ($values){

    foreach($values as $value){
        $rating = $value["rating"];
        $total+=$rating;
        $count+=1;

        if (isset($ratingsData[$rating])) {
            $ratingsData[$rating]['count']++;
        }
    }

    // Calculate average rating and determine number of stars
    $avg_rating = $total / $count;    
    $fullStars = floor($avg_rating);
    $hasHalfStar = ($avg_rating - $fullStars) >= 0.5;
    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);

    $finalRating = '<div class="rating-container">';
    $finalRating .= '<span class="location-name"> Average Rating: ' . round($avg_rating, 2) . '</span>';
    $finalRating .= '<span class="star-rating readonly">';

    // Empty Stars
    for ($i = 0; $i < $emptyStars; $i++) {
        $finalRating .= '<span>★</span>';
    }

    // Half Star
    if ($hasHalfStar) {
        $finalRating .= '<span class="half-filled">★</span>';
    }

    // Full Stars
    for ($i = 0; $i < $fullStars; $i++) {
        $finalRating .= '<span class="filled">★</span>';
    }

    $finalRating .= '</span>';
    $finalRating .= '</div>';
    echo $finalRating;

    // Calculate the maximum count for scaling the bars
    $maxCount = max(array_column($ratingsData, 'count'));

    echo '<div id="chart">';

    foreach ($ratingsData as $data) : 
        // Calculate the width percentage of the bar based on the count
        $widthPercent = ($data['count'] / $maxCount) * 100;
    ?>
        <div class="flex items-center mb-4">
            <!-- Star Label -->
            <div class="w-16 text-center text-gray-700 font-medium">
                <?= htmlspecialchars($data['level'], ENT_QUOTES) ?> ★
            </div>
            <!-- Bar Container -->
            <div class="flex-1 bg-gray-200 rounded-lg overflow-hidden">
                <!-- Bar Fill -->
                <div 
                    class="bg-gradient-to-r from-cyan-500 to-blue-500 h-6 rounded-lg flex items-center justify-end pr-4 text-white font-medium rating-bar-fill" 
                    style="--bar-width: <?= htmlspecialchars($widthPercent, ENT_QUOTES) ?>%;">
                    <span class="text-sm"><?= htmlspecialchars($data['count'], ENT_QUOTES) ?></span>
                </div>
            </div>
        </div>
    <?php endforeach;
        echo '</div>';

} else {
    echo "No rating yet. Be the first to add one here!";
}
?>


