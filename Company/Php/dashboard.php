<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/dash.css"/>
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
        <div class="welcome-panel">
          <b>Welcome Bob</b>
        </div>
      </div>
      <hr />
      <div class="footer">Copyright &copy; 2017</div>
    </div>
  </body>
</html>