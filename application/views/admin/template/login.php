<style type="text/css">
  input::placeholder {
  font-size:12px;
}
.section-height-100 {
    min-height: 100vh;
}
.page-header {
    padding: 0;
    position: relative!important;
    overflow: hidden!important;
    display: flex!important;
    align-items: center!important;
    background-size: cover!important;
    background-position: 50%;
}
.px-7 {
    padding-left: 6rem!important;
    padding-right: 6rem!important;
}
.border-radius-lg {
    border-radius: .75rem;
}
.bg-gradient-primary {
    background-image: linear-gradient(
35deg,#074ea0 ,#ed1b24)!important;
}
.m-3 {
    margin: 1rem!important;
}
.justify-content-center {
    justify-content: center!important;
}
.flex-column {
    flex-direction: column!important;
}
.h-100 {
    height: 100%!important;
}
.h-100{height:100%!important}.h-auto{height:auto!important}.mh-100{max-height:100%!important}.vh-100{height:100vh!important}.min-vh-100{min-height:100vh!important}
.position-relative {
    position: relative!important;
}
.d-flex {
    display: flex!important;
}
.btn-gradient-warning {
    background: linear-gradient(
35deg
,#074ea0 ,#ed1b24 )!important;
    border-left: none;
    border-right: none;
    color: #fff;
    box-shadow: 0 4px 6px rgb(50 50 93 / 11%), 0 1px 3px rgb(0 0 0 / 8%);
}
</style>
<section>
    <div class="page-header section-height-100">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
            <div class="card card-plain shadow-none bg-transparent">
              <div class="card-body">
                 <div class="text-center"><img class="img-fluid pb-4" style="height:120px;" src="<?php echo base_url(); ?>assets/front/images/main-logo.png"></div>
           <?php echo form_open(base_url('auth/admin')) ?>
           <div class="row">
             <div class="col-md-12">
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                    </div>
                    <input class="form-control" name="admin_phone" placeholder="ADMIN PHONE NUMBER..." type="number" required>
                  </div>
                </div>
             </div>
             <div class="col-md-12">
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" name="admin_password" placeholder="PASSWORD..." type="password" required>
                  </div>
                </div>
             </div>
             <div class="col-md-12 text-center">
              <button type="submit" class="btn btn btn-gradient-warning text-uppercase btn-block ">Log in <i class="fas fa-paper-plane pl-2"></i></button>
             </div>
           </div>
              <?php echo form_close(); ?>
              </div>
            </div>
          </div>
          <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 right-0 end-0 text-center justify-content-center flex-column">
            <div class="position-relative bg-gradient-primary h-100  m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
              <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/shapes/pattern-lines.svg" alt="pattern-lines" class="position-absolute opacity-4 start-0">
              <div class="position-relative">
                <!-- <img class="max-width-500 w-100 position-relative z-index-2" src="<?php #echo base_url(); ?>assets/front/images/main-logo.png"> -->
              </div>
              <h3 class="mt-5 text-white font-weight-bolder">"TIRUMALA EDU ADMIN LOGIN"</h3>
              <p class="text-white">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>