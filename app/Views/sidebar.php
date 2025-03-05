 <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
  
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="<?php echo base_url()?>assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Sinarumi</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="<?php echo base_url()?>">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

         <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Users</h6>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo base_url()?>students">
            <i class="fas fa-user-graduate"></i>
            <span class="nav-link-text ms-1">Students</span>
          </a>
        </li>
        <?php if ($_SESSION['role'] == "admin"): ?>
            <li class="nav-item">
              <a class="nav-link text-dark" href="<?php echo base_url()?>teachers">
                <i class="fas fa-chalkboard-user"></i>
                <span class="nav-link-text ms-1">Teachers</span>
              </a>
            </li>
        <?php endif ?>

          <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo base_url()?>classes">
            <i class="fas fa-users"></i>
            <span class="nav-link-text ms-1">Classes</span>
          </a>
        </li>  

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Resources</h6>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo base_url()?>subjects">
            <i class="fas fa-book-open"></i>
            <span class="nav-link-text ms-1">Subjects</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo base_url()?>pedagogys">
            <i class="fas fa-video"></i>
            <span class="nav-link-text ms-1">EMI Videos</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo base_url()?>microcredentials">
            <i class="fab fa-microblog"></i>
            <span class="nav-link-text ms-1">FAQ</span>
          </a>
        </li>
        <li class="nav-item" style="display: none;">
          <a class="nav-link text-dark" href="<?php echo base_url()?>objectives">
            <i class="fas fa-crosshairs"></i>
            <span class="nav-link-text ms-1">Objectives</span>
          </a>
        </li>

          <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Materials</h6>
        </li>

         
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo base_url()?>lesson-plans">
            <i class="fas fa-pencil"></i>
            <span class="nav-link-text ms-1">Lesson Plans</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo base_url()?>cases">
            <i class="fas fa-book"></i>
            <span class="nav-link-text ms-1">Case Study</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo base_url()?>presentations">
            <i class="fas fa-tv"></i>
            <span class="nav-link-text ms-1">Presentations</span>
          </a>
        </li>
        

         <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Accounts</h6>
        </li>
     
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo base_url()?>logout">
           <i class="fas fa-window-close"></i>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
   
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">