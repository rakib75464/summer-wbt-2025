<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/view.css"/>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h1>xCompany</h1>
        <div class="nav-right">
          Logged in as <a href="#" class="user-link">Bob</a> |
          <a href="#" class="logout-link">Logout</a>
        </div>
      </div>
      <hr />
      <div class="main-content">
        <div class="sidebar">
          <div class="sidebar-title">Account</div>
          <ul class="sidebar-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="view.php">View Profile</a></li>
            <li><a href="#">Edit Profile</a></li>
            <li><a href="#">Change Profile Picture</a></li>
            <li><a href="#">Change Password</a></li>
            <li><a href="../rakib.php">Logout</a></li>
          </ul>
        </div>

        <!-- Profile Section -->
        <div class="profile-panel">
          <h3>PROFILE</h3>
          <div class="profile-content">
            <div class="profile-info">
              <p><b>Name</b> : Bob</p>
              <p><b>Email</b> : bob@aiub.edu</p>
              <p><b>Gender</b> : Male</p>
              <p><b>Date of Birth</b> : 19/09/1998 <a href="#">Change</a></p>
              <p><a href="#">Edit Profile</a></p>
            </div>
            <div class="profile-image">
              <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Profile Picture" class="profile-pic"/>
            </div>
          </div>
        </div>
      </div>
      <hr />
      <div class="footer">Copyright &copy; 2017</div>
    </div>
  </body>
</html>
