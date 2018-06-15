<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          <i class="glyphicon glyphicon-credit-card"></i> Payment Fields
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#addressmodal">
                    <i class="glyphicon glyphicon-dollar"></i> Billing Form</button>
                    <?php echo $admin->field_modal($field, "addressmodal", $admin->add_form_field_form($formid,0), "Add Email Address Field"); ?>
            </div>
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#firstnamemodal">
                    <i class="glyphicon glyphicon-home"></i> Shipping Form</button>
                    <?php echo $admin->field_modal($field, "firstnamemodal", $admin->add_form_field_form($formid,0), "Add First Name Field"); ?>
            </div>
        </div>
        <br class="clear clearfix clearfx" />
        
        <div class="row">            
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#telephonemodal">
                    <i class="glyphicon glyphicon-credit-card"></i> Credit Card Form</button>
                    <?php echo $admin->field_modal($field, "telephonemodal", $admin->add_form_field_form($formid,0), "Add Phone Number Field"); ?>
            </div>
            
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#emailmodal">
                    <i class="glyphicon glyphicon-paypal"></i> PayPal Payment Button</button>
                    <?php echo $admin->field_modal($field, "emailmodal", $admin->add_form_field_form($formid,0), "Add Email Address Field"); ?>
            </div>
        </div>
        <br class="clear clearfix clearfx" />
        
        <div class="row">    
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <button type="button" class="btn btn-default form-control input form-control-sm text-left" data-toggle="modal" data-target="#lastnamemodal">
                    <i class="glyphicon glyphicon-user"></i> Stripe Payment Button</button>
                    <?php echo $admin->field_modal($field, "lastnamemodal", $admin->add_form_field_form($formid,0), "Add Last Name Field"); ?>
            </div>
        </div>
        <br class="clear clearfix clearfx" />
        <!-- end user fields -->
      </div>
    </div>
  </div>
