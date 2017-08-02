<!-- MODAL
======================================== -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" style="width: 100% !important; overflow-y: scroll;">
  <div class="modal-dialog" style="width: 90% !important">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="modal-close" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title black-fg font-bold">Image Details</h3>
      </div>
      <div class="modal-body">
      	<div class="container">
      		<div class="row">
      			<div class="col-sm-8 text-center" style="background-color: #f0f0f0; border-radius: 5px; padding:16px;" id="modal-img-selector">
      				<center><img src="../images/ben.png" align="center" class="img-responsive" id="modal-img-preview"></center>
      				<label for="modal-imgfile" class="modal-img-popover" style="margin-bottom: 39px; cursor: pointer;"><div class="font-bold bg-primary"><center><i class="fa fa-refresh"></i> Change*</center></div></label>
      			</div>
      			<div class="col-sm-4">
      				<form class="form-horizontal modal-form-img" action="" method="post" enctype="multipart/form-data">
      					<div class="form-group">
					      <label for="imgname" class="col-lg-2 control-label" required>Name</label>
						      <div class="col-lg-10">
							        <input type="text" class="form-control" placeholder="Image name" id="modal-imgtitle" name="imgtitle">
						      </div>
					</div><!-- form-group -->
					<div class="form-group">
					      <label for="imgalt" class="col-lg-2 control-label" required>Alt</label>
						      <div class="col-lg-10">
							        <input type="text" class="form-control" placeholder="Alternate Text" id="modal-imgalt" name="imgalt">
						      </div>
					</div><!-- form-group -->

					<div class="form-group">
					      <label for="imgalt" class="col-lg-2 control-label" required>Image</label>
						      <div class="col-lg-10">
							       <input type="file" name="modal-imgfile" class="form-control" id="modal-imgfile" accept="image/*">
						      </div>
					</div><!-- form-group -->

                                        <input type="text" id="show-img-id" class="hidden"/>
			
					<div class="col-lg-12 text-center">
					        <button type="reset" class="btn btn-primary"><i class="fa fa-eraser"></i> Clear</button>
					        <button type="button" name="modal-img-submit" value="2" class="btn btn-success"><i class="fa fa-check"></i> Confirm</button>
					        <button type="button" name="modal-img-submit" value="3" class="btn btn-danger"><i class="fa fa-remove"></i> Delete</button>
					</div><!-- form-group -->
      				</form>
      			</div>
      		</div>
      		
      	</div>
      </div>
      <div class="modal-footer">
      	<footer><p class="small" align="left">*Image size must not exceed 1 Mb</p></footer>
      </div>
    </div>

  </div>
</div>
