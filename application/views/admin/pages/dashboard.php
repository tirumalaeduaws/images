

  <div class="main-content" id="panel">
    <!-- Header -->
    <div class="header bg-white pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
          </div>
          <!-- Card stats -->
          <div class="row">
            <div class="col-md-4">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">REGISTERED STUDENTS</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $admissions; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-dark rounded-circle shadow">
                        <i class="fa fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <div class="row pt-5">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">NON VERIFIED STUDENTS</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $admissionss; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-dark rounded-circle shadow">
                        <i class="fa fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="text-dark text-uppercase pt-4 small font-weight-bold">TOTAL REGISTERED STUDENTS : <span class="text-danger"><?php echo $admissionss+$admissions;; ?></span></p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">SLIDER IMAGES</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $sliders; ?></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                          <i class="fa fa-users"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">GALLERY IMAGES</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $gallery; ?></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                          <i class="fa fa-users"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">ACTIVITIES IMAGES</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $activities; ?></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                          <i class="fa fa-users"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">RESULTS IMAGES</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $results; ?></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                          <i class="fa fa-users"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

