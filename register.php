<?php include 'header.php'; ?>

  <div class="bg-white  shadow-lg rounded-lg p-10 w-full max-w-md">
    
    <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Register</h2>
    
    <!-- Login Form -->
    <form name="loginForm" action="php/write_user.php" method="post" class="space-y-6">
      
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

    <!-- Email Input Field -->
      <div>
        <input 
          type="text" 
          id="email" 
          name="email" 
          class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-800 shadow-sm" 
          required 
          placeholder="Email">
      </div>

      <!-- <label>Admin Flag：
        User<input type="radio" name="adminFlag" value="0">　
        Admin<input type="radio" name="adminFlag" value="1">
      </label> -->

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
          <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M18 9H4V8h14zm-5 3H4v1h9zm8-8v9h-1V5H2v13h9v1H1V4zm2.07 11.637l-.707-.707-5.863 5.863-2.863-2.863-.707.707 3.57 3.57z"></path><path fill="none" d="M0 0h24v24H0z"></path></g></svg>
        </button>
      </div>


    </form>
  </div>
<!-- </div> -->




<?php include 'footer.php'; ?>

