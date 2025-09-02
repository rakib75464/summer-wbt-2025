<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f5f5f5;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        .col {
            flex: 1;
            padding: 0 10px;
        }
        input[type="text"], 
        input[type="email"], 
        input[type="password"], 
        input[type="date"],
        select, 
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .dob-group, .mobile-group {
            display: flex;
            gap: 10px;
        }
        .dob-group select, .dob-group input,
        .mobile-group select, .mobile-group input {
            flex: 1;
        }
        .radio-group {
            display: flex;
            gap: 15px;
        }
        .radio-option {
            display: flex;
            align-items: center;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 20px auto 0;
        }
        button:hover {
            background-color: #45a049;
        }
        .hint {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Registration Form</h1>
        
        <?php
        $rollNo = $firstName = $lastName = $fatherName = $dobDay = $dobMonth = $dobYear = "";
        $mobile = $email = $password = $gender = $department = $course = $city = $address = "";
        
        $rollNoErr = $firstNameErr = $lastNameErr = $fatherNameErr = $dobErr = "";
        $mobileErr = $emailErr = $passwordErr = $genderErr = $departmentErr = $courseErr = $cityErr = $addressErr = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST["rollNo"])) {
                $rollNoErr = "Roll No is required";
            } else {
                $rollNo = test_input($_POST["rollNo"]);
                if (!preg_match("/^[0-9]*$/", $rollNo)) {
                    $rollNoErr = "Only numbers allowed";
                }
            }
            
            if (empty($_POST["firstName"])) {
                $firstNameErr = "First Name is required";
            } else {
                $firstName = test_input($_POST["firstName"]);
                if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
                    $firstNameErr = "Only letters and white space allowed";
                }
            }
            
            if (empty($_POST["lastName"])) {
                $lastNameErr = "Last Name is required";
            } else {
                $lastName = test_input($_POST["lastName"]);
                if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
                    $lastNameErr = "Only letters and white space allowed";
                }
            }
            
            if (empty($_POST["fatherName"])) {
                $fatherNameErr = "Father's Name is required";
            } else {
                $fatherName = test_input($_POST["fatherName"]);
                if (!preg_match("/^[a-zA-Z ]*$/", $fatherName)) {
                    $fatherNameErr = "Only letters and white space allowed";
                }
            }

            if (empty($_POST["dobDay"]) || empty($_POST["dobMonth"]) || empty($_POST["dobYear"])) {
                $dobErr = "Date of Birth is required";
            } else {
                $dobDay = test_input($_POST["dobDay"]);
                $dobMonth = test_input($_POST["dobMonth"]);
                $dobYear = test_input($_POST["dobYear"]);
                
                if (!checkdate($dobMonth, $dobDay, $dobYear)) {
                    $dobErr = "Invalid date";
                }
            }
            if (empty($_POST["mobile"])) {
                $mobileErr = "Mobile No is required";
            } else {
                $mobile = test_input($_POST["mobile"]);
                if (!preg_match("/^[0-9]{10}$/", $mobile)) {
                    $mobileErr = "Invalid mobile number (10 digits required)";
                }
            }

            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {
                $email = test_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }

            if (empty($_POST["password"])) {
                $passwordErr = "Password is required";
            } else {
                $password = test_input($_POST["password"]);
                if (strlen($password) < 6) {
                    $passwordErr = "Password must be at least 6 characters";
                }
            }

            if (empty($_POST["gender"])) {
                $genderErr = "Gender is required";
            } else {
                $gender = test_input($_POST["gender"]);
            }

            if (empty($_POST["department"])) {
                $departmentErr = "Department is required";
            } else {
                $department = test_input($_POST["department"]);
            }
            
            if (empty($_POST["course"]) || $_POST["course"] == "default") {
                $courseErr = "Course is required";
            } else {
                $course = test_input($_POST["course"]);
            }
            
            if (empty($_POST["city"])) {
                $cityErr = "City is required";
            } else {
                $city = test_input($_POST["city"]);
            }
            
            if (empty($_POST["address"])) {
                $addressErr = "Address is required";
            } else {
                $address = test_input($_POST["address"]);
            }
        }
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <!-- Roll No -->
            <div class="form-group">
                <label for="rollNo">Roll no. :</label>
                <input type="text" id="rollNo" name="rollNo" value="<?php echo $rollNo; ?>">
                <span class="error">* <?php echo $rollNoErr; ?></span>
            </div>
            
            <!-- Student Name -->
            <div class="form-group">
                <label>Student name :</label>
                <div class="row">
                    <div class="col">
                        <input type="text" name="firstName" placeholder="First Name" value="<?php echo $firstName; ?>">
                        <span class="error">* <?php echo $firstNameErr; ?></span>
                    </div>
                    <div class="col">
                        <input type="text" name="lastName" placeholder="Last Name" value="<?php echo $lastName; ?>">
                        <span class="error">* <?php echo $lastNameErr; ?></span>
                    </div>
                </div>
            </div>
            
            <!-- Father's Name -->
            <div class="form-group">
                <label for="fatherName">Father's name :</label>
                <input type="text" id="fatherName" name="fatherName" value="<?php echo $fatherName; ?>">
                <span class="error">* <?php echo $fatherNameErr; ?></span>
            </div>
            
            <!-- Date of Birth -->
            <div class="form-group">
                <label>Date of birth :</label>
                <div class="dob-group">
                    <input type="text" name="dobDay" placeholder="Day" value="<?php echo $dobDay; ?>" maxlength="2" size="2">
                    <input type="text" name="dobMonth" placeholder="Month" value="<?php echo $dobMonth; ?>" maxlength="2" size="2">
                    <input type="text" name="dobYear" placeholder="Year" value="<?php echo $dobYear; ?>" maxlength="4" size="4">
                </div>
                <div class="hint">(DD-MM-YYYY)</div>
                <span class="error">* <?php echo $dobErr; ?></span>
            </div>
            
            <!-- Mobile No -->
            <div class="form-group">
                <label>Mobile no. :</label>
                <div class="mobile-group">
                    <select name="countryCode" style="max-width: 80px;">
                        <option value="+91">+91</option>
                    </select>
                    <input type="text" name="mobile" placeholder="" value="<?php echo $mobile; ?>">
                </div>
                <span class="error">* <?php echo $mobileErr; ?></span>
            </div>
            
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email id :</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>">
                <span class="error">* <?php echo $emailErr; ?></span>
            </div>
            
            <!-- Password -->
            <div class="form-group">
                <label for="password">Password :</label>
                <input type="password" id="password" name="password">
                <span class="error">* <?php echo $passwordErr; ?></span>
            </div>
            
            <!-- Gender -->
            <div class="form-group">
                <label>Gender :</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="male" name="gender" value="male" <?php if (isset($gender) && $gender=="male") echo "checked"; ?>>
                        <label for="male" style="display: inline; font-weight: normal;">Male</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="female" name="gender" value="female" <?php if (isset($gender) && $gender=="female") echo "checked"; ?>>
                        <label for="female" style="display: inline; font-weight: normal;">Female</label>
                    </div>
                </div>
                <span class="error">* <?php echo $genderErr; ?></span>
            </div>
            
            <!-- Department -->
            <div class="form-group">
                <label for="department">Department :</label>
                <select id="department" name="department">
                    <option value="">Select Department</option>
                    <option value="CSE" <?php if ($department == "CSE") echo "selected"; ?>>CSE</option>
                    <option value="IT" <?php if ($department == "IT") echo "selected"; ?>>IT</option>
                    <option value="ECE" <?php if ($department == "ECE") echo "selected"; ?>>ECE</option>
                    <option value="Civil" <?php if ($department == "Civil") echo "selected"; ?>>Civil</option>
                    <option value="Mech" <?php if ($department == "Mech") echo "selected"; ?>>Mech</option>
                </select>
                <span class="error">* <?php echo $departmentErr; ?></span>
            </div>
            
            <!-- Course -->
            <div class="form-group">
                <label for="course">Course :</label>
                <select id="course" name="course">
                    <option value="default">--- Select Current Course's ---</option>
                    <option value="B.Tech" <?php if ($course == "B.Tech") echo "selected"; ?>>B.Tech</option>
                    <option value="M.Tech" <?php if ($course == "M.Tech") echo "selected"; ?>>M.Tech</option>
                    <option value="B.Sc" <?php if ($course == "B.Sc") echo "selected"; ?>>B.Sc</option>
                    <option value="M.Sc" <?php if ($course == "M.Sc") echo "selected"; ?>>M.Sc</option>
                    <option value="BCA" <?php if ($course == "BCA") echo "selected"; ?>>BCA</option>
                    <option value="MCA" <?php if ($course == "MCA") echo "selected"; ?>>MCA</option>
                </select>
                <span class="error">* <?php echo $courseErr; ?></span>
            </div>
            
            <!-- Student Photo -->
            <div class="form-group">
                <label>Student photo :</label>
                <input type="file" id="photo" name="photo">
            </div>
            
            <!-- City -->
            <div class="form-group">
                <label for="city">City :</label>
                <input type="text" id="city" name="city" value="<?php echo $city; ?>">
                <span class="error">* <?php echo $cityErr; ?></span>
            </div>
            
            <!-- Address -->
            <div class="form-group">
                <label for="address">Address :</label>
                <textarea id="address" name="address" rows="4"><?php echo $address; ?></textarea>
                <span class="error">* <?php echo $addressErr; ?></span>
            </div>
            
            <button type="submit" name="submit">Register</button>
        </form>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($rollNoErr) && empty($firstNameErr) && empty($lastNameErr) && empty($fatherNameErr) && 
                empty($dobErr) && empty($mobileErr) && empty($emailErr) && empty($passwordErr) && 
                empty($genderErr) && empty($departmentErr) && empty($courseErr) && empty($cityErr) && empty($addressErr)) {
                
                echo "<h2>Registration Successful:</h2>";
                echo "Roll No: " . $rollNo . "<br>";
                echo "Name: " . $firstName . " " . $lastName . "<br>";
                echo "Father's Name: " . $fatherName . "<br>";
                echo "Date of Birth: " . $dobDay . "-" . $dobMonth . "-" . $dobYear . "<br>";
                echo "Mobile: +91 " . $mobile . "<br>";
                echo "Email: " . $email . "<br>";
                echo "Gender: " . $gender . "<br>";
                echo "Department: " . $department . "<br>";
                echo "Course: " . $course . "<br>";
                echo "City: " . $city . "<br>";
                echo "Address: " . $address . "<br>";
            }
        }
        ?>
    </div>
</body>
</html>