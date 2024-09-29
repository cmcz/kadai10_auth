<?php
//1. POSTデータ取得
$place_id = $_POST['place_id'];

//2. DB接続します
include 'util/db_connect.php';

//３．SQL
$sql_img = "SELECT * FROM place_image_table WHERE place_id = :place_id";
$stmt_img = $pdo->prepare($sql_img);
$stmt_img->bindParam(':place_id', $place_id, PDO::PARAM_INT); 
$status_img = $stmt_img->execute();

if($status_img==false) {
    $error = $stmt_img->errorInfo();
    exit("SQL_SELECT_ERROR: " . htmlspecialchars($error[2], ENT_QUOTES));
}
$values_img = $stmt_img->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="comment-card">

  <!-- The image -->
  <div class="slideshow-container">
    <?php foreach ($values_img as $index => $value_img): ?>
      <div class="mySlides fade">
        <img src="<?= htmlspecialchars($value_img['filepath'], ENT_QUOTES, 'UTF-8') ?>" 
             alt="<?= htmlspecialchars($value_img['filename'], ENT_QUOTES, 'UTF-8') ?>" 
             class="fixed-size-image">
      </div>
    <?php endforeach; ?>
  </div>

  <!-- The dots -->
  <div style="text-align:center">
    <?php foreach ($values_img as $index => $value_img): ?>
      <span class="dot" onclick="currentSlide(<?= $index + 1 ?>)"></span>
    <?php endforeach; ?>
  </div>

<?php
// Read Place Info from database
$sql = "SELECT * FROM place_table WHERE id = :place_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':place_id', $place_id, PDO::PARAM_INT); 
$status = $stmt->execute();

if($status==false) {
  $error = $stmt->errorInfo();
  exit("SQL_SELECT_ERROR: " . htmlspecialchars($error[2], ENT_QUOTES));
}
$values = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($values)): 
  $value = $values[0]; // Get the first data point
  $photo = $value["loc-photo"];
  $address = $value["address"];
  $description = $value["description"];
  $lat = $value["lat"];
  $lon = $value["lon"];
?>

  <!-- Name block -->
  <div class="userblock">
      <!-- icon -->
      <img src="<?= htmlspecialchars($photo, ENT_QUOTES, 'UTF-8'); ?>" 
           class="w-20 h-auto object-cover border-2 border-transparent rounded-full">
      <!-- address -->
      <p class="location-name"><?= htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?></p>
  </div>

  <!-- Description -->
  <p class="comment-content">
      <?= nl2br(htmlspecialchars($description, ENT_QUOTES, 'UTF-8')); ?>
  </p>

  <!-- Coordination -->
  <p class="location-detail">
    Coordinate: <?= htmlspecialchars($lat, ENT_QUOTES, 'UTF-8'); ?>, 
    <?= htmlspecialchars($lon, ENT_QUOTES, 'UTF-8'); ?>
  </p><br>

<?php 
// Included file will have access to $place_id
include 'fetch_avg_rating.php';
endif; ?>


