 <!-- Header -->
 <div class="header bg-gradient-white pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-dark d-inline-block mb-0 text-uppercase"><i class="ni ni-active-40"></i> gallery List</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
            <button class="btn btn-secondary btn-round btn-icon" data-toggle="tooltip" data-original-title="Add gallery" onclick="add_gallery()">
                <span class="btn-inner--icon"><i class="fa fa-plus"></i></span>
                <span class="btn-inner--text text-uppercase">Add gallery</span>
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
                    <th>For</th>
                    <th>Status</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($gallery as $gal): ?>
                <tr>   
                <td>
                  <span><?php echo $gal['gallery_id']; ?></span>
                </td>
                <td>
                  <span><?php echo $gal['gallery_name']; ?></span>
                </td>
                <td>
                <a href="#" class="fa open_model ml-auto mr-1" data-toggle="modal"  data-imgsrc="<?php echo base_url();?><?php echo $gal['gallery_image']; ?>">
                <img src="<?php echo base_url().$gal['gallery_image']; ?>" alt="Image" class="avatar avatar-lg">
                 </a> 
                </td>
                <td>
                  <span><?php echo $gal['gallery_type']; ?></span>
                </td>
                <td>                
                  <?php if ($gal['gallery_status'] == '1'): ?>
                  <span class="badge badge-lg badge-dot">
                        <i class="bg-success"></i>
                  </span>
                <?php endif; ?>
                <?php if ($gal['gallery_status'] == '0'): ?>
                  <span class="badge badge-lg badge-dot">
                        <i class="bg-warning"></i>
                  </span>
                  <?php endif; ?>
                </td>
                <td class="table-actions">
                <button type="button" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle="tooltip" data-original-title="Edit <?php echo $gal['gallery_name'];?>" onclick="edit_gallery(<?php echo $gal['gallery_id'];?>)"> <i class="fa fa-edit"></i></button>

               </td>
              </tr>
              <?php endforeach; ?>
                </tbody>
              </table>
            </div>
      </div>



<script type="text/javascript">
var save_method;
function add_gallery()
{
    save_method = 'add';
    $('#form')[0].reset(); 
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty(); 
    $('#img').hide();
    $('#modal_form').modal('show'); 
    $('.modal-title').text('Add gallery'); 
}
 
function edit_gallery(id)
{
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty();
    $.ajax({
        url : "<?php echo site_url('admin/gallery/edit_gallery/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="gallery_id"]').val(data.gallery_id);
            $('[name="gallery_name"]').val(data.gallery_name);
            $('[name="gallery_type"]').val(data.gallery_type);
            $('[name="gallery_status"]').val(data.gallery_status);
            $('#img').show();
            var imgSrc = '<?php echo base_url()?>'+data.gallery_image;
            $("#imgsrc").attr('src',imgSrc);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit gallery'); 
            $('#gallery_img').text('Update Image');
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
        url = "<?php echo site_url('admin/gallery/add_gallery')?>";
    } else {
        url = "<?php echo site_url('admin/gallery/update_gallery')?>";
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
                <h3 class="modal-title text-uppercase">gallery Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
            <form method="post" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="" name="gallery_id"/>
                        <div class="form-group" id="img">
                        <img src="" id="imgsrc" alt="Image" class="avatar avatar-lg">
                        </div>
                        <div class="row">
                      <div class="col-md-12">
                      <div class="form-group">
                            <label class="control-label text-uppercase text-dark small">gallery Name (for Admin)</label>
                            <input name="gallery_name" placeholder="gallery Name" class="form-control" type="text" required>
                            <span class="help-block"></span>
                        </div>
                      </div>
                      <div class="col-md-12">
                      <div class="form-group">
                            <label class="control-label text-uppercase text-dark small" id="cat_img">gallery Image (jpg,jpeg,png,gif)</label>
                            <input name="gallery_image" placeholder="gallery Image" id="customFile" class="form-control" type="file" required onchange="document.getElementById('galleryIMG').src = window.URL.createObjectURL(this.files[0])">
                            <span class="help-block"></span>
                            <img id="galleryIMG" width="100%" height="100"/>
                        </div>
                      </div>
                      <div class="col-md-6">
                      <div class="form-group">
                            <label class="control-label text-uppercase text-dark small">CAMPUS</label>
                                <select name="gallery_type" class="form-control" required>
                                    <option disabled selected>SELECT CAMPUS</option>
                                    <option value="RAJAHMUNDRY">RAJAHMUNDRY</option>
                                    <option value="VISAKAPATNAM">VISAKAPATNAM</option>
                                    <option value="BHIMAVARAM">BHIMAVARAM</option>
                                </select>
                                <span class="help-block"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                      <div class="form-group">
                            <label class="control-label text-uppercase text-dark small">STATUS</label>
                                <select name="gallery_status" class="form-control" required>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
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
                <h6 class="modal-title" id="modal-title-default">Image</h6>
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