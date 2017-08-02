<!-- Login success modal -->
<center><div id="modal-success" class="modal fade" role="dialog" style="margin-top: 65px;">
      <div class="alert alert-dismissible alert-success" id="alert-success" style="margin-right: -16px !important;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="margin-top: 10px;" class="white-fg">Voila! You're now logged in.</a></h4>
      </div>
</div>

<!-- Invalid credentials modal -->
<div id="modal-pass-mismatch" class="modal fade" role="dialog" style="margin-top: 65px;">
      <div class="alert alert-dismissible alert-danger" id="alert-danger" style="margin-right: -16px !important;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="margin-top: 10px;" class="white-fg">Bummer! Invalid credentials.</h4>
      </div>
</div>

<!-- Not verified modal -->
<div id="modal-not-verified" class="modal fade" role="dialog" style="margin-top: 65px;">
      <div class="alert alert-dismissible alert-danger" id="alert-danger" style="margin-right: -16px !important;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="margin-top: 10px;" class="white-fg">Your email id is not verified.</h4>
      </div>
</div>

<button class="hidden btn btn-success" id="show-success-modal" data-target="#modal-success" data-toggle="modal">Show</button>
<button class="hidden btn btn-success" id="show-modal-pass-mismatch" data-target="#modal-pass-mismatch" data-toggle="modal">Show</button>
<button class="hidden btn btn-success" id="show-modal-not-verified" data-target="#modal-not-verified" data-toggle="modal">Show</button>