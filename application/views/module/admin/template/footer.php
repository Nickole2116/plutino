<!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">&#169; <?=date('Y')?> <a href="https://kryptonion.co">Kryptonion Station</a> <?php echo lang('all_right'); ?></span>
                    <ul class="list-inline quicklinks">
                      
                    </ul>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
    <script src="<?=base_url().'assets/';?>/admin/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
    
    <script type="text/javascript" src="<?php echo base_url('inc/js/jquery.datetimepicker.full.min.js'); ?>"></script>
    
    
  <!-- Plugin js for this page-->
  <script src="<?=base_url().'assets/';?>/admin/vendors/chart.js/Chart.min.js"></script>
  <script src="<?=base_url().'assets/';?>/admin/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="<?=base_url().'assets/';?>/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?=base_url().'assets/';?>/admin/js/off-canvas.js"></script>
  <script src="<?=base_url().'assets/';?>/admin/js/hoverable-collapse.js"></script>
  <script src="<?=base_url("assets/admin/js/template.js?v=".VERSION)?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?=base_url().'assets/';?>/admin/js/dashboard.js"></script>
  <script src="<?=base_url().'assets/';?>/admin/js/data-table.js"></script>
  <script src="<?=base_url().'assets/';?>/admin/js/jquery.dataTables.js"></script>
  <script src="<?=base_url().'assets/';?>/admin/js/dataTables.bootstrap4.js"></script>
  <!-- End custom js for this page-->
    
    
  <script type="text/javascript" src="<?php echo base_url('inc/js/jquery-2.1.1.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('inc/js/bootstrap.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('inc/js/bootstrapValidator.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('inc/js/jquery.datetimepicker.full.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('inc/js/1.11.4_jquery-ui.js'); ?>"></script>
  <script src="<?=base_url("inc/js/main_new.js?v=".VERSION)?>"></script>
  
  <script>
        var adminpath = "/<?= ADMINPATH ?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url('inc/js/admin_component.js?').VERSION ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('inc/js/custom.min.js?').VERSION ?>"></script>

    <script>
        $(".datepicker").attr("autocomplete", "off");
    </script>
</body>

</html>

