<!DOCTYPE html>
<html lang="en">
  <head>

  <?php include(HEAD_PATH); ?>

  </head>
  
  <body>
    <div class="container-scroller">
   
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="./"><img src="/assets/images/logo.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="./"><img src="/assets/images/logo.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="search" class="form-control bg-transparent border-0" placeholder="Search ..." aria-controls="datatable">
              </div>
            </form>
          </div>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="/accounts/profile" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="/assets/images/faces/default.jpg"  alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <?php
                      if($name):
                  ?>
                  <div class="profile-name">
                    <h5 class="mb-0 font-weight-normal"><?= esc($name) ?></h5>
                    <span><?= esc($type) ?></span>
                  </div>
                  <?php endif ?>
    
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="/accounts/profile">
                  <i class="mdi mdi-cached me-2 text-success"></i>Account settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
            
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="/logout">
                <i class="mdi mdi-power"></i>
              </a>
            </li>

          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="/accounts/profile" class="nav-link">
                <div class="nav-profile-image">
                  <img src="/assets/images/faces/default.jpg" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <?php
                      if($name):
                  ?>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?= esc($name) ?></span>
                  <span class="text-secondary text-small"><?= esc($type) ?></span>
                </div>
                <?php endif ?>

                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            <li class="nav-item menu-items">
              <a class="nav-link" href="/jobs">
                <span class="menu-title">Jobs</span>
                <i class="mdi mdi-account-network menu-icon"></i>
              </a>
            </li>

</ul>
</nav>

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <?= $this->renderSection('content') ?>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © flies-galore 2023</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="/assets/js/edit-fly.js"></script>

    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script>
      const deleteButtons = document.querySelectorAll('[id^="delete_"]');
      deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
          const url = button.getAttribute('data-href');
          window.location.href = url;
        });
      });
    </script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/assets/js/off-canvas.js"></script>
    <script src="/assets/js/chart.js"></script>
    <script src="/assets/js/hoverable-collapse.js"></script>
    <script src="/assets/js/misc.js"></script>
    <script src="/assets/js/dataTables.altEditor.free.js" ></script>

    <!-- endinject -->
    <!-- Custom js for this page -->

    <!-- End custom js for this page -->
  </body>
</html>