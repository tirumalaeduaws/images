 <!-- Header -->
 <div class="header bg-gradient-white pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-dark d-inline-block mb-0 text-uppercase"><i class="ni ni-active-40"></i> results List</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
            <button class="btn btn-secondary btn-round btn-icon" data-toggle="tooltip" data-original-title="Add results" onclick="add_results()">
                <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                <span class="btn-inner--text text-uppercase">Add results</span>
              </button>
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
        <div class="card-header border-0">
        <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>YEAR</th>
                    <th>CAMPUS</th>
                    <th>Status</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($results as $gal): ?>
                <tr>   
                <td>
                  <span><?php echo $gal['results_id']; ?></span>
                </td>
                <td>
                  <span><?php echo $gal['results_name']; ?></span>
                </td>
                <td>
                <a href="#" class="fa open_model ml-auto mr-1" data-toggle="modal"  data-imgsrc="<?php echo base_url();?><?php echo $gal['results_image']; ?>">
                <img src="<?php echo base_url().$gal['results_image']; ?>" alt="Image" class="avatar avatar-lg">
                 </a> 
                </td>
                <td>
                  <span><?php echo $gal['results_year']; ?></span>
                </td>
                <td>
                  <span><?php echo $gal['results_campus']; ?></span>
                </td>
                <td>                
                  <?php if ($gal['results_status'] == '1'): ?>
                  <span class="badge badge-lg badge-dot">
                        <i class="bg-success"></i>
                  </span>
                <?php endif; ?>
                <?php if ($gal['results_status'] == '0'): ?>
                  <span class="badge badge-lg badge-dot">
                        <i class="bg-warning"></i>
                  </span>
                  <?php endif; ?>
                </td>
                <td class="table-actions">
                <button type="button" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle="tooltip" data-original-title="Edit <?php echo $gal['results_name'];?>" onclick="edit_results(<?php echo $gal['results_id'];?>)"> <i class="fa fa-edit"></i></button>

               </td>
              </tr>
              <?php endforeach; ?>
                </tbody>
              </table>
            </div>
      </div>



<script type="text/javascript">
var save_method;
function add_results()
{
    save_method = 'add';
    $('#form')[0].reset(); 
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty(); 
    $('#img').hide();
    $('#modal_form').modal('show'); 
    $('.modal-title').text('Add results'); 
}
 
function edit_results(id)
{
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty();
    $.ajax({
        url : "<?php echo site_url('admin/results/edit_results/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="results_id"]').val(data.results_id);
            $('[name="results_name"]').val(data.results_name);
            $('[name="results_year"]').val(data.results_year);
            $('[name="results_campus"]').val(data.results_campus);
            $('[name="results_status"]').val(data.results_status);
            $('#img').show();
            var imgSrc = '<?php echo base_url()?>'+data.results_image;
            $("#imgsrc").attr('src',imgSrc);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit results'); 
            $('#results_img').text('Update Image');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
         alert('Error get data from ajax');
        }
    });
}

function save()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 
    var url;
    var formulario = new FormData($('#form').get(0));    
    formulario.append('file', $('#customFile')[0].files[0]);
    if(save_method == 'add') {
        url = "<?php echo site_url('admin/results/add_results')?>";
    } else {
        url = "<?php echo site_url('admin/results/update_results')?>";
    }
    $.ajax({
        url : url,
        type: "POST",
        data: formulario,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status)
            {
                $('#modal_form').modal('hide');
                location.reload();
            }else{
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                }
            }
            $('#btnSave').text('save');
            $('#btnSave').attr('disabled',false);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            alert('Error!  Something Wrong');
            $('#btnSave').text('save'); 
            $('#btnSave').attr('disabled',false); 
        }
    });
}
</script>

 <!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-uppercase">results Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
            <form method="post" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="" name="results_id"/>
                        <div class="form-group" id="img">
                        <img src="" id="imgsrc" alt="Image" class="avatar avatar-lg">
                        </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-uppercase small text-dark">results Name (for Admin)</label>
                                <input name="results_name" placeholder="Results Name" class="form-control" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label text-uppercase small text-dark" id="cat_img">results Image (jpg,jpeg,png,gif)</label>
                                <input name="results_image" placeholder="results Image" id="customFile" class="form-control" type="file" required onchange="document.getElementById('resultsIMG').src = window.URL.createObjectURL(this.files[0])">
                                <span class="help-block"></span>
                                <img id="resultsIMG" width="100%" height="90"/>
                        </div>
                        </div>
                        <div class="col-md-6">                        
                        <div class="form-group">
                            <label class="control-label text-uppercase small text-dark">YEAR</label>
                                <select name="results_year" class="form-control" required>
                                    <option disabled selected>SELECT YEAR</option>
                                    <option value="2024-25">2025-26</option>
                                    <option value="2021-22">2024-25</option>
                                    <option value="2023-24">2023-24</option>
                                    <option value="2022-23">2022-23</option>
                                    <option value="2021-22">2021-22</option>
                                    <option value="2020-21">2020-21</option>
                                    <option value="2019-20">2019-20</option>
                                    <option value="2018-19">2018-19</option>
                                    <option value="2017-18">2017-18</option>
                                    <option value="2016-17">2016-17</option>
                                </select>
                                <span class="help-block"></span>
                        </div>
                        </div>
                        <div class="col-md-6">                        
                        <div class="form-group">
                            <label class="control-label  text-uppercase small text-dark">CAMPUS</label>
                                <select name="results_campus" class="form-control" required>
                                    <option disabled selected>SELECT CAMPUS</option>
                                    <option value="RAJAHMUNDRY">RAJAHMUNDRY</option>
                                    <option value="VISAKAPATNAM">VISAKAPATNAM</option>
                                    <option value="BHIMAVARAM">BHIMAVARAM</option>
                                </select>
                                <span class="help-block"></span>
                        </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label  text-uppercase small text-dark">Status</label>
                                <select name="results_status" class="form-control" required>
                                    <option disabled selected>SELECT STATUS</option>
                                    <option value="0">Disabled</option>
                                    <option value="1">Active</option>
                                </select>
                                <span class="help-block"></span>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">SAVE</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<script type="text/javascript">
$(document).on("click", ".open_model", function () {
var imgSrc = $(this).data('imgsrc');
$("#modalcontent #model_img").attr('src',imgSrc);
$('#modalcontent').modal('show');
});
</script>
<div class="modal fade" id="modalcontent" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">      
                <h6 class="modal-title text-uppercase" id="modal-title-default">Image</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">          
                <img class="img-fluid" id="model_img" src="">
            </div>
        </div>
    </div>
</div>