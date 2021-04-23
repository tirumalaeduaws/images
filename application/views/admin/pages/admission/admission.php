 <!-- Header -->

 <div class="header bg-gradient-white pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-dark d-inline-block mb-0"><i class="fa fa-users"></i> REGISTERED STUDENTS LIST</h6><br>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
        <!-- Light table -->
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-9">
             <form action="<?php echo base_url('admin/createExcel');?>" enctype="multipart/form-data" method="post">
                <div class="input-group">
                    <input type="date"  class="form-control form-control-sm" name="from" required>
                    <!-- <input type="time"  class="form-control form-control-sm" name="tfrom" required> -->
                    <input type="date" class="form-control form-control-sm" name="to" required>
                    <!-- <input type="time" class="form-control form-control-sm" name="tto" required> -->
                    <div class="input-group-prepend">
                    <button type="submit" class="btn btn-primary btn-sm">EXPORT <i class="fas fa-file-excel pl-2"></i></button>
                    </div>
                  </div>
             </form>
          </div>
        </div>
        <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>APPLICATIONID</th>
                    <th>STUDENT NAME</th>
                    <th>STUDENT MOBILE NUMBER</th>
                    <th>STUDENT TYPE</th>
                    <th>STATUS</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($admission as $boy): ?>
                <tr>
                <td>
                  <span><?php echo $boy['id']; ?></span>
                </td> 
                <td>
                  <span><?php echo $boy['t_unique']; ?></span>
                </td>
                <td> <span><?php echo $boy['t_sname']; ?> <?php echo $boy['t_mname']; ?> <?php echo $boy['t_lname']; ?></span> </td>
                <td><span><?php echo $boy['t_mobile']; ?></span></td>
                <td><span class="badge badge-primary"><?php echo $boy['t_type']; ?></span></td>
                <td>                
                  <?php if ($boy['t_status'] === '1'): ?>
                  <span class="badge badge-lg badge-dot" data-toggle="tooltip" data-original-title="Student verified">
                        <i class="bg-success"></i>
                  </span>
                <?php endif; ?>
                <?php if ($boy['t_status'] == '2'): ?>
                  <span class="badge badge-lg badge-dot" data-toggle="tooltip" data-original-title="Student Not Verified">
                        <i class="bg-primary"></i>
                  </span>
                <?php endif; ?>
               
                <?php if ($boy['t_status'] == '0'): ?>
                  <span class="badge badge-lg badge-dot" data-toggle="tooltip" data-original-title="Student Blocked/Pending">
                      <i class="bg-danger"></i>
                  </span>
                  <?php endif; ?>
                </td>
                <td class="table-actions">
                <a target="_blank" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle="tooltip" data-original-title="<?php echo $boy['t_sname'];?>" 
                href="<?php echo base_url();?>admin/admission/view_admission/<?php echo $boy['id']; ?>"> <i class="fa fa-file-pdf"></i></a>
                </td>
              </tr>
              <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>

