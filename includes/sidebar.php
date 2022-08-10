<?php 
$page = end(explode("/",$_SERVER["PHP_SELF"]));
?>

<div class="div-only-mobile"></div>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse vh-100">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item ms-3">
            <a class="nav-link ps-3" aria-current="page" href="index.php" style="color:white;">
            <i class="fas fa-home"></i>
              Dashboard
            </a>
          </li>
          <hr id="sidebar-separator">
          <li class="nav-item ms-3 mb-1">
            <a class="nav-link ps-3" href="#">
              <span data-feather="file"></span>
              <i class="fas fa-cog"></i>
              Settings
            </a>
          </li>
          <li class="nav-item ms-3 mb-1">
            <a class="nav-link ps-3 " href="#">
                <i class="fas fa-users"></i>
              About Us
            </a>
          </li>
          <li class="nav-item ms-3 mb-1">
            <a class="nav-link ps-3" href="#">
            <i class="fas fa-comment"></i>
              Feedback
            </a>
          </li>
          <hr id="sidebar-separator">
          <li class="nav-item ms-3 mb-1">
            <a class="nav-link ps-3" href="logout.php">
              <i class="fas fa-sign-out-alt"></i>
              Logout
            </a>
          </li>
        </ul>
    </ul>
      </div>
    </nav>