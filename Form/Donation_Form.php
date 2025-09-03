<?php
// Initialize variables
$firstName = $lastName = $company = $address1 = $address2 = $city = $state = $zip = $country = "";
$phone = $fax = $email = $donation = $otherAmount = "";
$recurring = $monthlyAmount = $months = "";
$honor = $honorName = $acknowledge = $honorAddress = $honorCity = $honorState = $honorZip = "";
$additionalName = $comments = "";
$contact = $newsletter = [];
$volunteer = false;

// Error variables
$firstNameErr = $lastNameErr = $address1Err = $cityErr = $stateErr = $zipErr = $countryErr = "";
$emailErr = $donationErr = $otherAmountErr = "";
$phoneErr = $faxErr = $monthlyErr = $monthsErr = "";
$honorErr = $honorNameErr = $acknowledgeErr = $honorAddressErr = $honorCityErr = $honorStateErr = $honorZipErr = "";
$additionalNameErr = $contactErr = "";

// Helper
function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // First Name
    if (empty($_POST["FirstName"])) {
        $firstNameErr = "First Name is required";
    } else {
        $firstName = test_input($_POST["FirstName"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
            $firstNameErr = "Only letters and spaces allowed";
        }
    }

    // Last Name
    if (empty($_POST["LastName"])) {
        $lastNameErr = "Last Name is required";
    } else {
        $lastName = test_input($_POST["LastName"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
            $lastNameErr = "Only letters and spaces allowed";
        }
    }

    // Company (optional)
    if (!empty($_POST["Company"])) $company = test_input($_POST["Company"]);

    // Address1
    if (empty($_POST["Address1"])) {
        $address1Err = "Address is required";
    } else {
        $address1 = test_input($_POST["Address1"]);
    }

    // Address2 (optional)
    if (!empty($_POST["Address2"])) $address2 = test_input($_POST["Address2"]);

    // City
    if (empty($_POST["City"])) {
        $cityErr = "City is required";
    } else {
        $city = test_input($_POST["City"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $city)) {
            $cityErr = "Only letters allowed";
        }
    }

    // State
    if (empty($_POST["State"])) {
        $stateErr = "State is required";
    } else {
        $state = test_input($_POST["State"]);
    }

    // Zip
    if (empty($_POST["Zip"])) {
        $zipErr = "Zip is required";
    } else {
        $zip = test_input($_POST["Zip"]);
        if (!preg_match("/^[0-9]{4}$/", $zip)) {
            $zipErr = "Zip must be 4 digits";
        }
    }

    // Country
    if (empty($_POST["Country"])) {
        $countryErr = "Country is required";
    } else {
        $country = test_input($_POST["Country"]);
    }

    // Phone (+8801XXXXXXXXX)
    if (!empty($_POST["Phone"])) {
        $phone = test_input($_POST["Phone"]);
        if (!preg_match("/^\+8801[3-9][0-9]{8}$/", $phone)) {
            $phoneErr = "Invalid phone format (use +8801XXXXXXXXX)";
        }
    }

    // Fax (optional digits only)
    if (!empty($_POST["Fax"])) {
        $fax = test_input($_POST["Fax"]);
        if (!preg_match("/^[0-9]+$/", $fax)) {
            $faxErr = "Fax must be digits only";
        }
    }

    // Email
    if (empty($_POST["Email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["Email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Donation
    if (empty($_POST["donation"])) {
        $donationErr = "Donation amount is required";
    } else {
        $donation = $_POST["donation"];
        if ($donation == "Other") {
            $otherAmount = test_input($_POST["otherAmount"]);
            if (empty($otherAmount) || !is_numeric($otherAmount)) {
                $otherAmountErr = "Enter valid amount for 'Other'";
            }
        }
    }

    // Recurring Donation
    if (!empty($_POST["recurring"])) {
        $recurring = "yes";
        if (empty($_POST["monthlyAmount"])) {
            $monthlyErr = "Monthly amount required";
        } else {
            $monthlyAmount = test_input($_POST["monthlyAmount"]);
            if (!preg_match("/^[0-9]+$/", $monthlyAmount)) {
                $monthlyErr = "Only numbers allowed";
            }
        }
        if (empty($_POST["months"])) {
            $monthsErr = "Months required";
        } else {
            $months = test_input($_POST["months"]);
            if (!preg_match("/^[0-9]+$/", $months)) {
                $monthsErr = "Only numbers allowed";
            }
        }
    }

    // Honorarium / Memorial
    if (!empty($_POST["honor"])) {
        $honor = $_POST["honor"];
        if (empty($_POST["honorName"])) $honorNameErr = "Name is required"; else $honorName = test_input($_POST["honorName"]);
        if (empty($_POST["acknowledge"])) $acknowledgeErr = "Acknowledge to is required"; else $acknowledge = test_input($_POST["acknowledge"]);
        if (empty($_POST["honorAddress"])) $honorAddressErr = "Address is required"; else $honorAddress = test_input($_POST["honorAddress"]);
        if (empty($_POST["honorCity"])) $honorCityErr = "City is required"; else $honorCity = test_input($_POST["honorCity"]);
        if (empty($_POST["honorState"])) $honorStateErr = "State is required"; else $honorState = test_input($_POST["honorState"]);
        if (empty($_POST["honorZip"])) {
            $honorZipErr = "Zip is required";
        } else {
            $honorZip = test_input($_POST["honorZip"]);
            if (!preg_match("/^[0-9]{4}$/", $honorZip)) {
                $honorZipErr = "Zip must be 4 digits";
            }
        }
    }

    // Additional Information
    if (!empty($_POST["additionalName"])) {
        $additionalName = test_input($_POST["additionalName"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $additionalName)) {
            $additionalNameErr = "Only letters and spaces allowed";
        }
    }

    $comments = test_input($_POST["comments"] ?? "");

    if (!empty($_POST["contact"])) {
        $contact = $_POST["contact"];
    } elseif (!empty($_POST["additionalName"]) || !empty($comments)) {
        $contactErr = "Select at least one contact method";
    }

    $newsletter = $_POST["newsletter"] ?? [];
    $volunteer = isset($_POST["volunteer"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Donor Form</title>
<style>
body { background:#e4e4e4; font-family:Arial; }
.required { color:red; }
.error { color:red; font-size:0.9em; }
.donor-info { display:flex; flex-direction:column; align-items:center; margin-bottom:10px; }
.form-row { display:flex; align-items:center; margin-bottom:12px; width:100%; max-width:600px; }
.form-row label { width:160px; text-align:right; margin-right:12px; flex-shrink:0; }
.form-row input, .form-row select, .form-row textarea { flex:1; max-width:280px; padding:4px 8px; }
input:focus,select:focus,textarea:focus{border:2px solid #4A90E2;outline:none;}
h2{color:red;} .radio-group{display:flex;gap:18px;}
</style>
<script>
function toggleOtherAmount(){
    let radios=document.getElementsByName("donation");
    let other=document.getElementById("otherAmountRow");
    let show=false;
    for(r of radios){ if(r.checked && r.value=="Other") show=true; }
    other.style.display=show?"flex":"none";
}
</script>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<h5><span class="required">*</span> Required</h5>

<h2>Donor Information</h2>
<div class="donor-info">
    <div class="form-row"><label>First Name<span class="required">*</span>:</label>
        <input type="text" name="FirstName" value="<?php echo $firstName;?>">
        <span class="error"><?php echo $firstNameErr;?></span></div>
    <div class="form-row"><label>Last Name<span class="required">*</span>:</label>
        <input type="text" name="LastName" value="<?php echo $lastName;?>">
        <span class="error"><?php echo $lastNameErr;?></span></div>
    <div class="form-row"><label>Company:</label><input type="text" name="Company" value="<?php echo $company;?>"></div>
    <div class="form-row"><label>Address1<span class="required">*</span>:</label>
        <input type="text" name="Address1" value="<?php echo $address1;?>">
        <span class="error"><?php echo $address1Err;?></span></div>
    <div class="form-row"><label>Address2:</label><input type="text" name="Address2" value="<?php echo $address2;?>"></div>
    <div class="form-row"><label>City<span class="required">*</span>:</label>
        <input type="text" name="City" value="<?php echo $city;?>">
        <span class="error"><?php echo $cityErr;?></span></div>
    <div class="form-row"><label>State<span class="required">*</span>:</label>
        <select name="State"><option value="">Select</option>
            <?php foreach(["Dhaka","Chittagong","Khulna","Barisal","Mymensingh","Rangpur","Rajshahi"] as $s){
                echo "<option value='$s' ".($state==$s?"selected":"").">$s</option>"; } ?></select>
        <span class="error"><?php echo $stateErr;?></span></div>
    <div class="form-row"><label>Zip<span class="required">*</span>:</label>
        <input type="text" name="Zip" value="<?php echo $zip;?>">
        <span class="error"><?php echo $zipErr;?></span></div>
    <div class="form-row"><label>Country<span class="required">*</span>:</label>
        <select name="Country"><option value="">Select</option>
            <option value="Bangladesh" <?php if($country=="Bangladesh") echo "selected";?>>Bangladesh</option></select>
        <span class="error"><?php echo $countryErr;?></span></div>
    <div class="form-row"><label>Phone:</label>
        <input type="text" name="Phone" value="<?php echo $phone;?>" placeholder="+8801XXXXXXXXX">
        <span class="error"><?php echo $phoneErr;?></span></div>
    <div class="form-row"><label>Fax:</label>
        <input type="text" name="Fax" value="<?php echo $fax;?>">
        <span class="error"><?php echo $faxErr;?></span></div>
    <div class="form-row"><label>Email<span class="required">*</span>:</label>
        <input type="text" name="Email" value="<?php echo $email;?>">
        <span class="error"><?php echo $emailErr;?></span></div>

    <div class="form-row"><label>Donation<span class="required">*</span>:</label>
        <div class="radio-group">
            <?php foreach(["50","75","100","250","Other"] as $d){
                echo "<label><input type='radio' name='donation' value='$d' ".($donation==$d?"checked":"")." onclick='toggleOtherAmount()'> $d</label>";
            } ?>
        </div>
        <span class="error"><?php echo $donationErr;?></span></div>
    <div class="form-row" id="otherAmountRow" style="display:<?php echo ($donation=="Other"?"flex":"none");?>;">
        <label>Other Amount $</label>
        <input type="text" name="otherAmount" value="<?php echo $otherAmount;?>">
        <span class="error"><?php echo $otherAmountErr;?></span></div>
    <div class="form-row"><label>Recurring</label>
        <input type="checkbox" name="recurring" <?php if($recurring) echo "checked";?>> Monthly $
        <input type="text" name="monthlyAmount" value="<?php echo $monthlyAmount;?>" style="width:60px;"> for
        <input type="text" name="months" value="<?php echo $months;?>" style="width:40px;"> months
        <span class="error"><?php echo $monthlyErr.$monthsErr;?></span></div>
</div>

<?php
// Initialize variables
$honor = $honorName = $acknowledge = $honorAddress = $honorCity = $honorState = $honorZip = "";
$additionalName = $comments = "";
$contact = $newsletter = [];
$volunteer = false;

// Error variables
$honorNameErr = $acknowledgeErr = $honorCityErr = $honorZipErr = $additionalNameErr = $contactErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Honorarium / Memorial Donation Validation (optional fields)
    $honor = $_POST["honor"] ?? "";

    if (!empty($_POST["honorName"])) {
        $honorName = test_input($_POST["honorName"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $honorName)) {
            $honorNameErr = "Only letters and spaces allowed";
        }
    }

    if (!empty($_POST["acknowledge"])) {
        $acknowledge = test_input($_POST["acknowledge"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $acknowledge)) {
            $acknowledgeErr = "Only letters and spaces allowed";
        }
    }

    if (!empty($_POST["honorAddress"])) {
        $honorAddress = test_input($_POST["honorAddress"]);
    }

    if (!empty($_POST["honorCity"])) {
        $honorCity = test_input($_POST["honorCity"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $honorCity)) {
            $honorCityErr = "Only letters allowed";
        }
    }

    $honorState = $_POST["honorState"] ?? "";

    if (!empty($_POST["honorZip"])) {
        $honorZip = test_input($_POST["honorZip"]);
        if (!preg_match("/^[0-9]{4}$/", $honorZip)) {
            $honorZipErr = "Zip must be 4 digits";
        }
    }

    // Additional Information Validation (optional fields)
    if (!empty($_POST["additionalName"])) {
        $additionalName = test_input($_POST["additionalName"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $additionalName)) {
            $additionalNameErr = "Only letters and spaces allowed";
        }
    }

    $comments = test_input($_POST["comments"] ?? "");

    $contact = $_POST["contact"] ?? [];
    $newsletter = $_POST["newsletter"] ?? [];
    $volunteer = isset($_POST["volunteer"]);
}
?>

<!-- HTML Section -->

<h2>Honorarium and Memorial Donation Information</h2>
<div class="donor-info">
    <div class="form-row">
        <label>I would like to make this donation</label>
        <div style="flex:1;">
            <label><input type="radio" name="honor" value="To Honor" <?php if($honor=="To Honor") echo "checked";?>> To Honor</label>
            <label><input type="radio" name="honor" value="In Memory of" <?php if($honor=="In Memory of") echo "checked";?>> In Memory of</label>
        </div>
    </div>
    <div class="form-row">
        <label for="honorName">Name</label>
        <input type="text" id="honorName" name="honorName" value="<?php echo $honorName; ?>">
        <span class="error"><?php echo $honorNameErr;?></span>
    </div>
    <div class="form-row">
        <label for="acknowledge">Acknowledge Donation to</label>
        <input type="text" id="acknowledge" name="acknowledge" value="<?php echo $acknowledge; ?>">
        <span class="error"><?php echo $acknowledgeErr;?></span>
    </div>
    <div class="form-row">
        <label for="honorAddress">Address</label>
        <input type="text" id="honorAddress" name="honorAddress" value="<?php echo $honorAddress; ?>">
    </div>
    <div class="form-row">
        <label for="honorCity">City</label>
        <input type="text" id="honorCity" name="honorCity" value="<?php echo $honorCity; ?>">
        <span class="error"><?php echo $honorCityErr;?></span>
    </div>
    <div class="form-row">
        <label for="honorState">State</label>
        <select id="honorState" name="honorState">
            <option value="">Select a State</option>
            <?php 
            foreach(["Dhaka","Chittagong","Khulna","Barisal","Mymensingh","Rangpur","Rajshahi"] as $s){
                $selected = ($honorState==$s) ? "selected" : "";
                echo "<option value='$s' $selected>$s</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-row">
        <label for="honorZip">Zip</label>
        <input type="text" id="honorZip" name="honorZip" value="<?php echo $honorZip; ?>">
        <span class="error"><?php echo $honorZipErr;?></span>
    </div>
</div>

<h2>Additional Information</h2>
<div class="donor-info">
    <div class="form-row">
        <label>Name</label>
        <input type="text" name="additionalName" value="<?php echo $additionalName; ?>">
        <span class="error"><?php echo $additionalNameErr;?></span>
    </div>
    <div class="form-row">
        <label>Comments</label>
        <textarea name="comments" rows="3" style="width:100%;"><?php echo $comments; ?></textarea>
    </div>
    <div class="form-row">
        <label>How may we contact you?</label>
        <div style="flex:1;">
            <?php 
            foreach(["Email","Postal Mail","Telephone","Fax"] as $c){
                $checked = in_array($c,$contact) ? "checked" : "";
                echo "<label><input type='checkbox' name='contact[]' value='$c' $checked> $c</label><br>";
            }
            ?>
        </div>
    </div>
     <div class="form-row" style="justify-content:center;">
         <button type="reset">Reset</button>
         <button type="submit" style="margin-left:10px;">Continue</button>
     </div>
</div>


</form>
</body>
</html>

