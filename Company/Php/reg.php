<?php
// Define variables and set to empty values
$nameErr = $emailErr = $usernameErr = $passwordErr = $confirmPasswordErr = $genderErr = $dobErr = "";
$name = $email = $username = $gender = $dob_day = $dob_month = $dob_year = "";
$password = $confirm_password = "";
$registration_successful = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $has_errors = false;
  
  // Name validation (Bangladeshi: only letters, spaces, dots, hyphens, at least 2 chars)
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
    $has_errors = true;
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z .'-]{2,}$/", $name)) {
      $nameErr = "Only letters, spaces, dot, hyphen and at least 2 characters allowed";
      $has_errors = true;
    }
  }

  // Email validation (Bangladeshi: must be valid email)
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $has_errors = true;
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $has_errors = true;
    }
  }

  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
    $has_errors = true;
  } else {
    $username = test_input($_POST["username"]);
    if (!preg_match("/^[a-zA-Z0-9_]{3,}$/", $username)) {
      $usernameErr = "Only letters, numbers, underscore, min 3 characters";
      $has_errors = true;
    }
  }

  // Password validation (Bangladeshi: min 8 chars, at least 1 letter, 1 number, 1 special char)
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
    $has_errors = true;
  } else {
    $password = $_POST["password"];
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
      $passwordErr = "Min 8 chars, 1 letter, 1 number, 1 special char";
      $has_errors = true;
    }
  }

  // Confirm password
  if (empty($_POST["confirm_password"])) {
    $confirmPasswordErr = "Confirm password is required";
    $has_errors = true;
  } else {
    $confirm_password = $_POST["confirm_password"];
    if ($password !== $confirm_password) {
      $confirmPasswordErr = "Passwords do not match";
      $has_errors = true;
    }
  }

  // Gender
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
    $has_errors = true;
  } else {
    $gender = $_POST["gender"];
  }

  // Date of Birth (Bangladeshi: valid date, year 1900-2020, month 1-12, day 1-31)
  $dob_day = test_input($_POST["dob_day"] ?? "");
  $dob_month = test_input($_POST["dob_month"] ?? "");
  $dob_year = test_input($_POST["dob_year"] ?? "");
  if (empty($dob_day) || empty($dob_month) || empty($dob_year)) {
    $dobErr = "Date of birth is required";
    $has_errors = true;
  } else if (!is_numeric($dob_day) || !is_numeric($dob_month) || !is_numeric($dob_year)) {
    $dobErr = "Date of birth must be numbers";
    $has_errors = true;
  } else if (!checkdate((int)$dob_month, (int)$dob_day, (int)$dob_year)) {
    $dobErr = "Invalid date";
    $has_errors = true;
  } else if ($dob_year < 1900 || $dob_year > 2020) {
    $dobErr = "Year must be between 1900 and 2020";
    $has_errors = true;
  }
  
  // If no errors, mark registration as successful
  if (!$has_errors) {
    $registration_successful = true;
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Registration - XCompany</title>
  <link rel="stylesheet" href="../css/reg.css" />
</head>
<body>
  <header class="page-header">
    <div class="brand">
      <div class="logo">X</div>
      <div class="company-name">Company</div>
    </div>
    <nav class="top-nav">
      <a href="../rakib.php">Home</a> | <a href="login.php">Login</a> | <a href="">Registration</a>
    </nav>
  </header>

  <main class="container">
    <section class="registration-card">
      <h1 class="title">REGISTRATION</h1>

      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($registration_successful) {
          echo '<div class="success-summary">Registration successful!</div>';
        } else {
          echo '<div class="error-summary">';
          echo '<ul>';
          if ($nameErr) echo "<li>$nameErr</li>";
          if ($emailErr) echo "<li>$emailErr</li>";
          if ($usernameErr) echo "<li>$usernameErr</li>";
          if ($passwordErr) echo "<li>$passwordErr</li>";
          if ($confirmPasswordErr) echo "<li>$confirmPasswordErr</li>";
          if ($genderErr) echo "<li>$genderErr</li>";
          if ($dobErr) echo "<li>$dobErr</li>";
          echo '</ul>';
          echo '</div>';
        }
      }
      ?>
      
      <form class="reg-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off" novalidate>
        <label>
          <span class="label-text">Name</span>
          <span class="colon">:</span>
          <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required />
          <?php if ($nameErr): ?>
            <span class="error"><?php echo $nameErr; ?></span>
          <?php endif; ?>
        </label>

        <label>
          <span class="label-text">Email</span>
          <span class="colon">:</span>
          <div class="email-row">
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required />
            <span class="info">i</span>
          </div>
          <?php if ($emailErr): ?>
            <span class="error"><?php echo $emailErr; ?></span>
          <?php endif; ?>
        </label>

        <label>
          <span class="label-text">User Name</span>
          <span class="colon">:</span>
          <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required />
          <?php if ($usernameErr): ?>
            <span class="error"><?php echo $usernameErr; ?></span>
          <?php endif; ?>
        </label>

        <label>
          <span class="label-text">Password</span>
          <span class="colon">:</span>
          <input type="password" name="password" required />
          <?php if ($passwordErr): ?>
            <span class="error"><?php echo $passwordErr; ?></span>
          <?php endif; ?>
        </label>

        <label>
          <span class="label-text">Confirm Password</span>
          <span class="colon">:</span>
          <input type="password" name="confirm_password" required />
          <?php if ($confirmPasswordErr): ?>
            <span class="error"><?php echo $confirmPasswordErr; ?></span>
          <?php endif; ?>
        </label>

        <fieldset class="gender-fieldset">
          <legend>Gender</legend>
          <label class="radio">
            <input type="radio" name="gender" value="male" <?php if($gender=="male") echo "checked"; ?> /> Male
          </label>
          <label class="radio">
            <input type="radio" name="gender" value="female" <?php if($gender=="female") echo "checked"; ?> /> Female
          </label>
          <label class="radio">
            <input type="radio" name="gender" value="other" <?php if($gender=="other") echo "checked"; ?> /> Other
          </label>
          <?php if ($genderErr): ?>
            <span class="error"><?php echo $genderErr; ?></span>
          <?php endif; ?>
        </fieldset>

        <label class="dob-label">
          <span class="label-text">Date of Birth</span>
          <div class="colon"> </div>
          <div class="dob-row">
            <input type="text" name="dob_day" maxlength="2" placeholder="dd" value="<?php echo htmlspecialchars($dob_day); ?>" />
            <span class="sep">/</span>
            <input type="text" name="dob_month" maxlength="2" placeholder="mm" value="<?php echo htmlspecialchars($dob_month); ?>" />
            <span class="sep">/</span>
            <input type="text" name="dob_year" maxlength="4" placeholder="yyyy" value="<?php echo htmlspecialchars($dob_year); ?>" />
            <small class="format">(dd/mm/yyyy)</small>
          </div>
          <?php if ($dobErr): ?>
            <span class="error"><?php echo $dobErr; ?></span>
          <?php endif; ?>
        </label>

        <div class="form-actions">
          <button type="submit" class="btn">Submit</button>
          <button type="reset" class="btn alt">Reset</button>
        </div>
      </form>

    </section>
  </main>

  <footer class="page-footer">
    <div>Copyright © 2017</div>
  </footer>
</body>
</html>