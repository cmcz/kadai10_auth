<?php include 'header.php'; 

// Check if already logged in
if (isset($_SESSION["name"])) {
  $message = "You have already logged in as " . $_SESSION["name"]; // Store the message in a variable
  $message .= "<br>Logout first before login to another account!";
  echo '<div class="message" style="color: red;">' . $message . '</div>';
  exit();
}
?>

<!-- <div class="bg-gray-50 bg-opacity-50 w-full shadow-lg rounded-lg flex h-auto"> -->
<!-- <div class="min-h-screen flex items-center justify-center bg-gray-100"> -->
  <div class="bg-white  shadow-lg rounded-lg p-10 w-full max-w-md">
    
    <!-- Google-like Form Heading -->
    <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Log in</h2>
    
    <!-- Login Form -->
    <form name="loginForm" action="php/read_user_login.php" method="post" class="space-y-6">
      
      <!-- ID Input Field -->
      <div>
        <input 
          type="text" 
          id="loginID" 
          name="loginID" 
          class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-800 shadow-sm" 
          required 
          placeholder="ID">
      </div>

      <!-- Password Input Field -->
      <div>
        <input 
          type="password" 
          id="loginPW" 
          name="loginPW" 
          class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-800 shadow-sm" 
          required 
          placeholder="Password">
      </div>

      <!-- Forgot Password Link -->
      <!-- <div class="flex justify-end">
        <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
      </div> -->

      <!-- Submit Button -->
      <div>
        <button 
          type="submit" 
          id="send" 
          class="w-full bg-blue-600 text-white font-semibold p-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 flex justify-center items-center">
          <svg 
          fill="#ffffff" 
          width="20px" 
          height="20px" 
          viewBox="0 0 32 32" 
          xmlns="http://www.w3.org/2000/svg" 
          stroke="#ffffff">
          <path d="M16.642 20.669c-0.391 0.39-0.391 1.023 0 1.414 0.195 0.195 0.451 0.293 0.707 0.293s0.512-0.098 0.707-0.293l5.907-6.063-5.907-6.063c-0.39-0.39-1.023-0.39-1.414 0s-0.391 1.024 0 1.414l3.617 3.617h-19.264c-0.552 0-1 0.448-1 1s0.448 1 1 1h19.326zM30.005 0h-18c-1.105 0-2.001 0.895-2.001 2v9h2.014v-7.78c0-0.668 0.542-1.21 1.21-1.21h15.522c0.669 0 1.21 0.542 1.21 1.21l0.032 25.572c0 0.668-0.541 1.21-1.21 1.21h-15.553c-0.668 0-1.21-0.542-1.21-1.21v-7.824l-2.014 0.003v9.03c0 1.105 0.896 2 2.001 2h18c1.105 0 2-0.895 2-2v-28c-0.001-1.105-0.896-2-2-2z"></path>
          </svg>
        </button>
      </div>

      <!-- Sign Up Link -->
      <div class="text-center mt-4">
        <p class="text-sm text-gray-600">Not a member? <a href="./register.php" class="text-blue-600 hover:underline">Create an account</a></p>
      </div>

    </form>
  </div>
<!-- </div> -->




<?php include 'footer.php'; ?>

