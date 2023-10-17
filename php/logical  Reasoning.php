<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
$con = mysqli_connect('localhost', 'root', '', 'exam');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Exam Form Header</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #2E706C;
    }
    
    .header {
      background-color: orange;
      color: white;
      padding: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .logo {
      font-size: 24px;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 2px;
      margin: 0;
    }
    
    .nav {
      display: flex;
    }
    
    .nav li {
      list-style: none;
      margin-right: 20px;
    }
    
    .nav li a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      text-transform: uppercase;
    }
    
    .logout-btn {
      background-color: orange;
      color: #ffffff;
      padding: 15px 25px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      justify-content: center;
    }
    
    .logout-btn:hover {
      background-color: cadetblue;
    }
    
    .credit {
      padding: 3rem 2rem;
      font-size: 2rem;
      color: #fff;
      background: #000;
      text-align: center;
      font-weight: normal;
    }
    
    .timer {
      color: #004085;
      background: orange;
      border: 1px solid #b8daff;
      height: 45px;
      padding: 0 8px;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 145px;
    }
  </style>
  <script>
    function startTimer(duration, display) {
      var timer = duration, minutes, seconds;
      setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
          window.location.replace("http://localhost/login/php/result.php");
        }
      }, 1000);
    }

    window.onload = function () {
      var timerInput = 900; // Set the duration in seconds (15 minutes)
      var display = document.querySelector('#timer');
      startTimer(timerInput, display);
    };
  </script>
</head>
<body>
  <div class="header">
    <h1 class="text-center text-primary"></h1>
    <h1 class="text-center text-success">Welcome <?php echo $_SESSION['username']; ?></h1><br>
    <header>
      <div class="timer">
        <div>Remaining Time: <span id="timer">15:00</span></div>
      </div>
      <div class="time_line"></div>
    </header>
  </div>

  <div class="card"></div><br>
  
  <form action="resultreson.php" method="post">
    <?php
    for ($i = 1; $i < 11; $i++) {
        $q = "SELECT * FROM questionr WHERE q_id = $i";
        $query = mysqli_query($con, $q);
        while ($rows = mysqli_fetch_array($query)) {
    ?>
            <div class="card">
              <h4 class="card-header"><?php echo $rows['question'] ?></h4>
              <?php
              $q = "SELECT * FROM answers WHERE ans_id = $i";
              $query = mysqli_query($con, $q);
              while ($rows = mysqli_fetch_array($query)) {
              ?>
                  <div class="card-body">
                      <input type="radio" name="quizcheck[<?php echo $rows['ans_id']; ?>]" value="<?php echo $rows['ans_id']; ?>">
                      <?php echo $rows['answers']; ?>
                  </div>
              <?php
              }
              ?>
            </div>
    <?php
        }
    }
    ?>
    <br><br>
    <button class="logout-btn" type="submit">Submit</button>
  </form>
  
  <button class="logout-btn"><a href="dashboard.php">Logout</a></button>
  
  <div>
    <h5 class="credit">mr. ABHISHEK KAILAS JADHAO</h5>
    <h5 class="credit">mr. KUNAL RAMESH KOLSE</h5>
    <h5 class="credit">mr. HIMANSHU ARUNRAO THOMBRE</h5>
  </div>
</body>
</html>
