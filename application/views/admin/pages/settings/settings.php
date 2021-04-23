<!-- Header -->
<div class="header bg-gradient-white pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
            <h6 class="h3 text-dark d-inline-block mb-0">
                <?php echo $this->session->flashdata('message'); ?>
            </h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="card mb-4">
        <!-- Card body -->
        <?php echo form_open_multipart('admin/settings/updatecred'); ?>
        <div class="card-body">
          <!-- Form groups used in grid -->
          <div class="row">
          <div  class="form-group col-md-6"> <span class="display-6 text-danger"><?php echo form_error('pt_name'); ?></span>
          <label class="form-control-label" for="example3cols2Input">Admin Mobile</label><br>
          <?php $aMob = $this->Admin_Model->get_field('admin_phone', 'admin', array('admin_id' => '1')); ?>
            <input class="form-control" type="number" name="admin_phone" value="<?php echo $aMob; ?>" placeholder="Mobile" required>
          </div>
          </div>

          <div class="row">
          <div  class="form-group col-md-6"> <span class="display-6 text-danger"><?php echo form_error('pt_name'); ?></span>
          <label class="form-control-label" for="example3cols2Input">Admin Password If Update</label><br>
            <input class="form-control" type="password" name="admin_password" value="" placeholder="">
          </div>
          <div  class="form-group col-md-6"> <span class="display-6 text-danger"><?php echo form_error('pt_name'); ?></span>
          <label class="form-control-label" for="example3cols2Input">Confirm Admin Password Update</label><br>
            <input class="form-control" type="password" name="admin_passwordconfirm" value="" placeholder="">
          </div>
          </div>



            <div class="text-right col">
              <div class="form-group">
                    <button class="mt-5 text-right btn btn-warning" type="submit">Update</button>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
      

