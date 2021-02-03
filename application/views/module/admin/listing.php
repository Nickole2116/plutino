<div class="page_blank"></div>
<div class="col-12">
    <h3 class="text-success text-center">
    <?php 
        if($this->session->userdata('success')){
            echo $this->session->userdata('success');
        } 
    ?>
    </h3>
</div>
<div class="page-header">
    <h3><?php echo lang($page_header) ?></h3>
</div>
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body admin-background">

      <form id="package_search" action="" method="get" class="form-inline">
        
        <input name="search_title" type="text" class="form-control mb-2 mr-sm-2 search_input" id="inlineFormInputName2" placeholder="<?=lang('username')?>" value="<?php echo $this->input->get_post("search_title"); ?>">
      
        <button type="submit" name="search_submit" value="Submit" class="btn btn-primary admin-action-btn"><?=lang('search')?></button>
      </form>
    </div>
  </div>
</div>

<div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body admin-background">
          <h4 class="card-title table-title"><?=lang('admin_listing')?></h4>
          <p class="card-description">          
            <?if($this->session->userdata('admin_role')!=2){?>
            <a  href="#" class="btn btn-primary admin-action-btn create_button"><?=lang('add_admin')?></a>
            <?}?>
          </p>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                    <th><?=lang('no')?></th>
                    <th><?=lang('name')?></th>
                    <th><?=lang('email')?></th>
                    <th><?=lang('role')?></th>
                    <th><?=lang('action')?></th>
                    <th class="admin_id"></th>
                </tr>
              </thead>
              <tbody>
                <?php $offset++; ?>
                 <?php
                if(!empty($admin)){
                ?>
                    <?php foreach ($admin as $row): ?>
                    <?php if($this->session->userdata('admin_role')==2){
                                if($this->session->userdata('admin_id')!=$row['admin_id']){
                                    continue;
                                }
                            }?>
                        <tr class="admin_row">
                            <td data-title="No"><?php echo $offset++; ?></td>
                            <td style="display: none;" class="admin_id"><?php echo $this->encrypt->encode($row['admin_id']);?></td> 
                            <td data-title="Name"><?php echo $row['admin_name']?></td>
                            <td data-title="Email"><?php echo $row['admin_email']?></td>
                            <td data-title="Role"><?php echo $admin_role[$row['admin_role']];  ?></td>
                            <td data-title="Action" class="display_block_a">
                                <? if($this->session->userdata('admin_role')!=2){?>
                                <a href="#" action="p_update" class="btn btn-primary admin-action-btn admin_modify"><?=lang('modify')?></a>
                                <a href="#" class="btn btn-dark admin-action-btn change_password_button_admin"><?=lang('change_passowrd')?></a> 
                                
                                <a href="#" class="btn btn-danger admin-action-btn delete_button"><?=lang('deactive')?></a>
                                <?}?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                
                    <tr>
                        <td class="remove_padding_50" colspan="5">
                        <div class="total_rows"><?=lang('total_entries')?>: <?php echo $total_rows ?></div>
                        <?php echo $pagination->create_links(); ?></td>
                    </tr>
                <?php
                }
                else{
                ?>
                    <tr>
                        <td class="remove_padding_50" colspan="5" style="text-align: center;"><?=lang('no_result')?></td>
                    </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>