<style>
  .nav-link {
    border-right: solid #ccc 1px;
  }

  .nav-link:first-child {
    border-left: solid #ccc 1px;
  }
  .nav {
    border-bottom: solid #ccc 1px;
  }
  </style>

<!-- <ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="btn btn-outline-primary" href="newcustomer.php" role="button">Create Account</a>
  </li>
  <li class="nav-item">
    <a class="btn btn-outline-primary" href="additionalinfo.php" role="button">Create Account</a>
  </li>
</ul> -->
<div class="borderbottom">
  <div class="navcontainer">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link <?php print($createaccount);?>" href="showcustomers.php">Show New Customers</a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link <?php print($additionalinfo);?>" href="additionalinfo.php">Additional Information</a>
    </li> -->
  </ul>
  </div>
</div>