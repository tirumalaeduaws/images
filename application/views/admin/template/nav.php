
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-gradient-white" id="sidenav-main" data-aos="fade-right">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  d-flex  align-items-center">
        <a class="navbar-brand" href="<?php echo base_url(); ?>admin/dashboard">
          <img src="<?php echo base_url();?>assets/front/images/main-logo.png" style="height:90px;" class="navbar-brand-img" alt="...">
        </a>
        <div class=" ml-auto ">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav" data-aos="fade-down">
    
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>admin/dashboard">
                <i class="ni ni-chart-pie-35 text-primary"></i>
                <span class="nav-link-text  text-uppercase small">DASHBOARD</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-pages" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-pages">
                <i class="ni ni-ungroup text-orange"></i>
                <span class="nav-link-text small">PAGES</span>
              </a>
              <div class="collapse" id="navbar-pages">
                <ul class="nav nav-sm flex-column">

                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>admin/gallery" class="nav-link">
                      <span class="sidenav-mini-icon"> G </span>
                      <span class="sidenav-normal small"> GALLERY </span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>admin/sliders" class="nav-link">
                      <span class="sidenav-mini-icon"> S </span>
                      <span class="sidenav-normal small"> SLIDERS </span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>admin/activities" class="nav-link">
                      <span class="sidenav-mini-icon"> A </span>
                      <span class="sidenav-normal small"> ACTIVITIES </span>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="<?php echo base_url(); ?>admin/results" class="nav-link">
                      <span class="sidenav-mini-icon"> R </span>
                      <span class="sidenav-normal small"> RESULTS </span>
                    </a>
                  </li>

                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>admin/admission">
                <i class="fa fa-store text-info"></i>
                <span class="nav-link-text  text-uppercase small">REGISTERED STUDENTS</span>
              </a>
           </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>admin/settings">
              <i class="fa fa-cog text-warning"></i>
              <span class="nav-link-text  text-uppercase small">Settings</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
         
        </div>
      </div>
    </div>
  </nav>