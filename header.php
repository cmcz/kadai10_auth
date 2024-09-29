<!DOCTYPE html>
<html lang="ja">

<?php
session_start();
if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
      session_regenerate_id(true);
      $_SESSION["chk_ssid"] = session_id();
  }
?>

<head>
    <meta charset="utf-8">
    <title>Review Site</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/reset.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/general.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/modal.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/review.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/topicdetail.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/topiclist.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    
<div class="background-overlay"></div>


<header class="fixed-top-menu bg-gradient-to-r from-blue-500 to-cyan-500 shadow-md">
    <nav class="container mx-auto px-4 py-3 flex justify-between items-center">
        <?php if ($_SESSION["loginID"]) { ?>
            <span class="text-lg font-semibold text-white">WELCOME : <?php echo $_SESSION["loginID"]; ?> SAN</span>
        <?php } ?>

        <ul class="flex space-x-6 text-white">
            <li><a href="./index.php" class="hover:text-gray-200 transition">Home</a></li>
            <li><a href="./login.php" class="hover:text-gray-200 transition">Login</a></li>
            <li><a href="./register.php" class="hover:text-gray-200 transition">Register</a></li>
            <li><a href="./php/logout.php" class="hover:text-gray-200 transition">Logout</a></li>
        </ul>
    </nav>
</header>


  <div class="content-wrapper w-[80%] max-w-7xl">