<?php

  // Performs all actions necessary to log in an admin
  function log_in_admin($admin) {
  // Renerating the ID protects the admin from session fixation.
    session_regenerate_id();
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $admin['username'];
    return true;
  }

  // is_logged_in() contains all the logic for determining if a 
  // request should be considered a "logged in" request or not.
  // It is the core of require_login() but it can also be called
  // on its own in other contexts (e.g. display one link if an admin
  // is logged in and display another link if they are not)
  function is_logged_in() {
    // having a admin_id in the session serves a dual-purpose:
    // - its presense indivates the admin is logged in.
    // - its value tells which admin for looking up their record.
    return isset($_SESSION['admin_id']); // if true then don't redirect
  }

  // Call require_login() at the top of any page which needs to 
  // require a valid login before granting access to the page.
  function require_login() {
    if(!is_logged_in()) {
      redirect_to(url_for('/staff/login.php'));
    } else {
      // do nothing, let the rest of the page proceed
    }
  }  

?>
