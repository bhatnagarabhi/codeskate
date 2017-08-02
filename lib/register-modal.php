<!-- Success modal -->
<center><div id="modal-username-success" class="modal fade" role="dialog" style="margin-top: 65px;">
      <div class="alert alert-dismissible alert-success" id="alert-success" style="margin-right: -16px !important;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="margin-top: 10px;" class="white-fg">The username is available.</h4>
      </div>
</div>

<!-- Success modal -->
<center><div id="modal-success" class="modal fade" role="dialog" style="margin-top: 65px;">
      <div class="alert alert-dismissible alert-success" id="alert-success" style="margin-right: -16px !important;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="margin-top: 10px;" class="white-fg">Great! You're now signed up with Codeskate &copy;</a></h4>
      </div>
</div>

<!-- Passwords don't match modal -->
<div id="modal-pass-mismatch" class="modal fade" role="dialog" style="margin-top: 65px;">
      <div class="alert alert-dismissible alert-danger" id="alert-danger" style="margin-right: -16px !important;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="margin-top: 10px;" class="white-fg">Bummer! The passwords do not match.</h4>
      </div>
</div>

<!-- Username exists modal -->
<div id="modal-username-failure" class="modal fade" role="dialog" style="margin-top: 65px;">
      <div class="alert alert-dismissible alert-danger" id="alert-danger" style="margin-right: -16px !important;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="margin-top: 10px;" class="white-fg">That username already exists.</h4>
      </div>
</div>

<!-- Email exists modal -->
<div id="modal-email-failure" class="modal fade" role="dialog" style="margin-top: 65px;">
      <div class="alert alert-dismissible alert-danger" id="alert-danger" style="margin-right: -16px !important;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="margin-top: 10px;" class="white-fg">That email is already in use.</h4>
      </div>
</div></center>


<button class="hidden btn btn-success" id="show-success-modal" data-target="#modal-success" data-toggle="modal">Show</button>
<button class="hidden btn btn-success" id="show-username-success-modal" data-target="#modal-username-success" data-toggle="modal">Show</button>
<button class="hidden btn btn-danger" id="show-pass-mismatch-modal" data-target="#modal-pass-mismatch" data-toggle="modal">Show</button>
<button class="hidden btn btn-danger" id="show-username-failure-modal" data-target="#modal-username-failure" data-toggle="modal">Show</button>
<button class="hidden btn btn-danger" id="show-email-failure-modal" data-target="#modal-email-failure" data-toggle="modal">Show</button>