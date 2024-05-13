<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./index.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap"
    />
  </head>
  <body>
    <div class="auth">
      <section class="auth-inner">
        <form class="frame-parent">
          <div class="jilora-wrapper">
            <h3 class="jilora">JILORA</h3>
          </div>
          <button class="button">
            <img class="google-icon" alt="" src="./public/google.svg" />

            <div class="sign-up-with">Sign up with Google</div>
          </button>
          <div class="frame-group">
            <div class="rectangle-wrapper">
              <div class="frame-child"></div>
            </div>
            <div class="or-continue-with">or continue with</div>
            <div class="rectangle-container">
              <div class="frame-item"></div>
            </div>
          </div>
          <div class="field">
            <input class="label" placeholder="Entrer identifiant" type="text" />
          </div>
          <div class="field1">
            <input class="label1" placeholder="Entrer mot de passe" type="text" />
          </div>
          <button class="button1">
            <div class="continue">Continue</div>
          </button>
        </form>
      </section>
    </div>
    <?php
    // Connect to the database (place this at the beginning of your PHP code)
    // Database credentials (replace with your actual details)
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "gestion_stock";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    include 'connect.php'; // Assuming you saved the connection code in a separate file named 'connect.php'
    ?>
  
    <?php
    // Login logic (replace with your actual validation)
    if (isset($_POST['id']) && isset($_POST['password'])) {
      $email = $_POST['id'];
      $password = $_POST['password'];

      // Validate credentials against database (use prepared statements for security)
      $sql = "SELECT * FROM agent WHERE identifiant = ? AND mot_de_passe = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $email, password_hash($password, PASSWORD_DEFAULT)); // Hash password before comparison
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        // Login successful (handle session or redirect)
        echo "Login successful!";
      }
      else {
        echo "Invalid credentials";
      }

      $stmt->close();
      }
    ?>
  </body>
</html>

