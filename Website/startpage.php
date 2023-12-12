<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Start Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>

    
    <style>
      html {
        font-size: 75%;
        font-family: "Poppins", sans-serif;
      }
      * {
        box-sizing: border-box;
      }
      body {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: linear-gradient(
          to right top,
          #0390fc,
          #ffc781,
          #fffefc
        );
      }
      .container{
          display: flex;
          justify-content: center;
          align-items: center;
      }
      #signup {
        width: 100%;
        max-width: 60rem;
        border-radius: 10px;
        background-color: white;
        padding: 4rem 3.5rem;
        display: block;
      }
      #signin {
        width: 100%;
        max-width: 60rem;
        border-radius: 10px;
        background-color: white;
        padding: 4rem 3.5rem;
        display: none;
        height: 600px;
      }
      .heading {
        text-align: center;
        font-size: 4rem;
        margin-bottom: 1rem;
        font-weight: bold;
      }
      .already {
        text-align: center;
        font-size: 1.5rem;
      }
      .signina {
        text-decoration: underline;
      }
      .form-group {
        margin-bottom: 1.5rem;
      }
      .label {
        font-size: 1.3rem;
        font-weight: 500;
      }
      .form-input {
        color: black;
        font-family: "Poppins", sans-serif;
        padding: 1.5rem;
        border-radius: 1rem;
        font-size: 1.3rem;
        border: 1px solid #eee;
        background-color: #eee;
        transition: 0.25s linear;
      }
      .form-signup-submit {
        border-radius: 1rem;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin: 2.5rem 0;
        padding: 1.5rem;
        font-size: 1.5rem;
        font-weight: 500;
        outline: none;
        cursor: pointer;
        font-family: "Poppins", sans-serif;
      }
      .form-signin {
        border-radius: 1rem;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 1.5rem;
        font-size: 1.5rem;
        font-weight: 500;
        outline: none;
        cursor: pointer;
        font-family: "Poppins", sans-serif;
      }
      .form-signin-submit {
        border-radius: 1rem;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin: 2rem 0;
        padding: 1.5rem;
        font-size: 1.5rem;
        font-weight: 500;
        outline: none;
        cursor: pointer;
        font-family: "Poppins", sans-serif;
      }
    </style>

    <div class="container">
      <div id="signup">
        <h2 class="heading">Create account</h2> 
        <form action="controller.php" method="POST" class="form-horizontal">
    		<input type='hidden' name='page' value='StartPage'>
    		<input type='hidden' name='command' value='SignUp'>
          <div class="form-group">
            <label for="username" class="label">Username:</label> <?php if (!empty($error_msg_username1)) echo $error_msg_username1;?><br> 
            <input type="text" class="form-control form-input" name="username" required />
          </div>

          <div class="form-group">
            <label for="password" class="label">Password:</label>
            <?php if (!empty($error_msg_password1)) echo $error_msg_password1;?><br> 
            <input type="password" class="form-control form-input" name="password" id="password" onkeyup="checkPasswordStrength()" required />
            <input type="hidden" name="password_strength" id="password_strength" value="">  
            <div>
              <span>Password Strength: </span><span id="strength"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="email" class="label">Email:</label> <?php if (!empty($error_msg_email1)) echo $error_msg_email1;?><br>
            <input type="text" class="form-control form-input" name="email" required />.
          </div>

          <div class="form-group">
            <div class="row">
                      <div class="col text-left">
                        <input type="button" class="btn btn-secondary form-signup-submit" id="backBtn" value="Back">
                      </div>
                      <div class="col text-right">
                        <button type="submit" class="btn btn-primary form-signup-submit">
                          Sign Up
                        </button>
                      </div>
                  </div>
          </div>
        </form>
      </div>

      <div id="signin">
        <h2 class="heading">Sign In</h2>

        <form action="controller.php" method="POST" class="form-horizontal">
		  <input type='hidden' name='page' value='StartPage'>
		  <input type='hidden' name='command' value='SignIn'>
          <div class="form-group">
            <label for="username" class="label">Username:</label> <?php if (!empty($error_msg_username)) echo $error_msg_username;?><br> 
            <input type="text" class="form-control form-input" name="username" required />
          </div>

          <div class="form-group">
            <label for="password" class="label">Password:</label> <?php if (!empty($error_msg_password)) echo $error_msg_password;?><br>
            <input type="password" class="form-control form-input" name="password" required />
          </div>

          <div class="form-group">
                  <div class="row">
                      <div class="col text-left">
                        <input type="reset" class="btn btn-secondary form-signin-submit" value="Reset">
                      </div>
                      <div class="col text-right">
                        <button type="submit" class="btn btn-primary form-signin-submit">
                            Sign In
                        </button>
                      </div>
                  </div>
          </div>

          <div class="already form-group">
            Don't have an account? Register here!
          </div>

          <div class="form-group">
            <button type="button" class="btn btn-primary form-signin" value="Sign In" id="signinmodal">
                Sign Up
            </button>
          </div>
        </form>
      </div>
    </div>
  </body>
  <?php
    if(isset($display_modal_window))
    {
      if ($display_modal_window == 'signin'):
      ?>
        <script>
        $('#signup').css('display', 'none');
        $('#signin').css('display', 'block');
        </script>
      <?php elseif ($display_modal_window == 'signup'): ?>
       <script>
        $('#signup').css('display', 'block');
        $('#signin').css('display', 'none');
        </script>

      <?php endif; 
    }
    else{?>
      <script>
        $('#signup').css('display', 'none');
        $('#signin').css('display', 'block');
        
      </script>
      
<?php } ?>
<!-- <script>
      function show_signin() {
        document.getElementById('signin').style.display = 'block';
        document.getElementById('signup').style.display = 'none';
      }  
      function show_signup() {
        document.getElementById('signup').style.display = 'block';
        document.getElementById('signin').style.display = 'none';
      }
      function show_no_modal_window() {
        document.getElementById('signup').style.display = 'block';
      }


    </script> -->
  <script>
      document.getElementById('signinmodal').addEventListener('click',function(){
            document.getElementById('signup').style.display = 'block';
            document.getElementById('signin').style.display = 'none';
      }); 
      document.getElementById('backBtn').addEventListener('click',function(){
            document.getElementById('signup').style.display = 'none';
            document.getElementById('signin').style.display = 'block';
      });

    function checkPasswordStrength() {
      var password = document.getElementById('password').value;
      var strength = document.getElementById('strength');
      var passwordStrengthInput = document.getElementById('password_strength');

      var lowercaseRegex = /[a-z]/;
      var uppercaseRegex = /[A-Z]/;
      var numberRegex = /[0-9]/;
      var specialCharRegex = /[$&+,:;=?@#|'<>.^*()%!-]/; 

      var strengthValue = 0;

      if (password.length >= 8) {
        strengthValue += 1;
      }
      if (lowercaseRegex.test(password)) {
        strengthValue += 1;
      }
      if (uppercaseRegex.test(password)) {
        strengthValue += 1;
      }
      if (numberRegex.test(password)) {
        strengthValue += 1;
      }
      if (specialCharRegex.test(password)) {
        strengthValue += 1;
      }

      if (strengthValue < 3) {
        strength.innerHTML = 'Weak';
        strength.style.color = 'red';
        passwordStrengthInput.value = 'Weak';
      } else if (strengthValue < 5) {
        strength.innerHTML = 'Moderate';
        strength.style.color = 'orange';
        passwordStrengthInput.value = 'Moderate';
      } else {
        strength.innerHTML = 'Strong';
        strength.style.color = 'green';
        passwordStrengthInput.value = 'Strong';
      }
    }
</script>
</html>