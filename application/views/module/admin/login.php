  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <!--img src="<?=base_url().'assets/';?>/admin/images/logo.svg" alt="logo"-->
				<h3  class="admin_login_title"><?=lang('admin_panel')?></h3>
              </div>
              <div class="alert-success"><?php if($this->session->flashdata('msg_success')){ echo $this->session->flashdata('msg_success'); } ?></div>
              <div class="alert-danger">
			  
				<?php if($this->session->flashdata('msg_error')){ echo $this->session->flashdata('msg_error'); } ?>
			
				<?php
					if($this->input->get_post('error')){
				?>
						<p class="error_message"><?=lang('invalid_login')?></p>
				<?php
					}
				?>
			  </div>
			  <?php echo validation_errors('<div class="alert-danger">', '</div>'); //class: alert ?>
              <form class="pt-3" method="post" id="admin_login_form" action="<?php echo base_url(ADMINPATH.'/login/p_login') ?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="username" name="txt_admin_name" placeholder="<?=lang('username')?>">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="txt_admin_password" placeholder="<?= lang('password'); ?>">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="login" value="login"><?php echo lang('login'); ?></button>
                </div>
              </form>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->