<?php

  function whatisLookup($email) {
    $result = shell_exec("/home/mailadmin/bin/gam/gam whatis $email");
    $result_array = explode("\n",$result);
    //echo "*$email* 0-$result_array[0]   \   1-$result_array[1]";
    if (strpos($result_array[0], "User:") !== false) {
      // echo "$email - is an EMAIL ADDRESS";
      $id = $email; $type = "0"; $result = $email;
      return array ($id, $type, $result);
    }
    if (strpos($result_array[1], "Group Settings:") !== false) {
      // echo "$email - is a  GROUP";
      $id = $email; $type = "1"; $result = $email;
      return array ($id, $type, $result);
    }

    if (strpos($result_array[1], "User Email:") !== false) {
      // echo "$email - is an EMAIL ALIAS";
      $id = $email; $type = "2"; $result = str_replace("User Email:","",$result_array[1]);
      return array ($id, $type, $result);
  B  }
    if (strpos($result_array[1], "Group Email:") !== false) {
      // echo "$email - is a  GROUP ALIAS";
      $id = $email; $type = "3"; $result = str_replace("Group Email:","",$result_array[1]);
      return array ($id, $type, $result);
    }
  }

  function emailLookup($email) {
    $org = shell_exec("/home/mailadmin/bin/gam/gam info user $email | grep 'Google Org Unit Path:'");
    $org = str_replace("Google Org Unit Path: ","",$org);
    $vacation = shell_exec("/home/mailadmin/bin/gam/gam user $email show vacation");
    $delegates = shell_exec("/home/mailadmin/bin/gam/gam user $email show delegates | grep 'Delegate Email:'");
    return array ($org, $delegates, $vacation);
    }

  function groupLookup($group_email) {
    $managers = shell_exec("/home/mailadmin/bin/gam/gam info group $group_email | grep 'manager:'");
    $managers = str_replace("manager: ","",$managers);
    $members = shell_exec("/home/mailadmin/bin/gam/gam info group $group_email | grep 'member:'");
    $members = str_replace("member: ","",$members);
    return array ($managers, $members);
  }

?>
