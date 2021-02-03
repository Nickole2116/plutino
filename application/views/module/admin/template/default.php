<?php $this->load->view("module/admin/template/header"); ?>
  
    <div class="main-panel">
        <div class="content-wrapper">          
      <div class="row">
              <!-- page content -->
        <input type="hidden" name="ajax_url" value="<?php echo site_url(); ?>">
       <!--  <input type="hidden" name="aws_file_url" value="<?php echo AWS_FILE_URL; ?>"> -->

          <?php $this->load->view($content); ?>
          <?php
            if($content1!=''){

            $this->load->view($content1);
            }
          ?>
        <!-- page content -->
            </div>
        </div>
<?php $this->load->view("module/admin/template/footer"); ?>



