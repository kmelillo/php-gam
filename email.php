<?php
  $PageTitle = "G Suite Email Lookup";
  include 'header.php';
  include 'functions.php';
  if(isset($_POST['button'])) {
    $email = $_POST['email'];
    list ($id, $type, $result) = whatisLookup($email);
    if ($type == "0") {
        list ($org, $delegates, $vacation) = emailLookup($email);
        $delegate_array = explode("Delegate Email: ", $delegates);
        $strip_first = array_shift($delegate_array);
        echo "<center><b>Report for Email Account:</b> $email</center>";
        echo "<center><b>Org Unit:</b> $org</center><br>";
        echo "<center><b>Delegates:</b></center>";
        foreach ($delegate_array as $delegate) {
          echo "<center>$delegate</center>";
        }
        echo "<center><b>Total Delegates:</b> "; echo count($delegate_array); echo "</center>";
        echo "<center><br><br><b>Out of Office</b></center>";
        echo "<center><pre>$vacation</pre></center>";
    } elseif ($type == "1") {
        // echo "$id is a Google Group";
        list ($managers, $members) = groupLookup($email);
        echo "<center><b>Report for Group:</b> $email</center><br>";
        echo '<center><b>Managers</b></center>';
        echo "<center><pre>$managers</pre></center>";
        echo '<center><b>Members</b></center>';
        echo "<center><pre>$members</pre></center>";
    } elseif ($type == "2") {
        list ($org, $delegates, $vacation) = emailLookup($email);
        $delegate_array = explode("Delegate Email: ", $delegates);
        $strip_first = array_shift($delegate_array);
        echo "<center><b>Report for Email Alias:</b> $email [Account:$result]</center>";
        echo "<center><b>Org Unit:</b> $org</center><br>";
        echo "<center><b>Delegates:</b></center>";
        foreach ($delegate_array as $delegate) {
          echo "<center>$delegate</center>";
        }
        echo "<center><b>Total Delegates:</b> "; echo count($delegate_array); echo "</center>";
        echo "<center><br><br><b>Out of Office</b></center>";
        echo "<center><pre>$vacation</pre></center>";
    } elseif ($type == "3") {
        list ($managers, $members) = groupLookup($email);
        echo "<center><b>Report for Group Alias:</b> $email [Account:$result]</center><br>";
        echo '<center><b>Managers</b></center>';
        echo "<center><pre>$managers</pre></center>";
        echo '<center><b>Members</b></center>';
        echo "<center><pre>$members</pre></center>";
    } else {
        echo "<center><p style='color:red;'>The email address provided [$email] is not a GSuite Email, Group, or Alias</p></center>"; }
  } else { echo '<center><form action="" method="post"> Name: <input type="email" name="email"> <button type="submit" name="button" formmethod="post">Check Email</button></form></center>'; }
  echo '<center><a href="./email.php">Check Another Email</a>';
  echo '<center><a href="./index.php">Return to Menu</a>';
  include 'footer.php';
?>
