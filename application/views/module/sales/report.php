<div class="page_blank"></div>
<div class="page-header">
    <h3><?php echo lang($page_header) ?></h3>
</div>
<div class="success">
    <?php 
        if($this->session->userdata('success')){
            echo $this->session->userdata('success');
        } 
    ?>
</div>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body admin-background">
            <form id="announcement_search" action="" method="get" class="form-inline">
                <input name="search_start_date" class="form-control mb-2 mr-sm-2 search-col search_input datepicker" placeholder="<?=lang('start_date')?>" value="<?php echo $this->input->get_post('search_start_date') ?>">
                <input name="search_end_date" class="form-control mb-2 mr-sm-2 search-col search_input datepicker" placeholder="<?=lang('end_date')?>" value="<?php echo $this->input->get_post('search_end_date') ?>">
                <input name="search_trxno" class="form-control mb-2 mr-sm-2 search-col search_input" placeholder="<?=lang('trx_no')?>" value="<?php echo $this->input->get_post('search_trxno') ?>">
                <input name="search_submit" type="submit" class="btn btn-primary admin-action-btn" value="<?=lang('search')?>">
            </form>
        </div>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body admin-background">
          <h4 class="card-title table-title"><?php echo lang($page_header) ?></h4>
          <div class="table-responsive">
                    <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><?=lang('no')?></th>
                                <th><?=lang('purchase_date')?></th>
                                <th><?=lang('type')?></th>
                                <th><?=lang('trx_no')?></th>
                                <th><?=lang('username')?></th>
                                <th><?=lang('mobile_number')?></th>
                                <th><?=lang('email')?></th>
                                <th><?=lang('usdt_address')?></th>
                                <th><?=lang('amount')?></th>
                                <th><?=lang('status')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $offset = 1; ?>
                             <?php
                            if(!empty($sales)){
                            ?>
                                <?php foreach($sales as $row): ?>
                                     <?php $originalDate = $row['order_payment_created_date'];
                                        $newDate = date("d M Y H:i:s", strtotime($originalDate));
                                    ?>
                                    <tr class="product_row">
                                        <td data-title="No"><?php echo $offset++; ?></td>                         
                                        <td data-title="Date"><?=$newDate?></td>
                                        <td data-title="Type"><?=$row['payment_type_value']?></td>
                                        <td data-title="Trx No"><?=$row['order_payment_trx_number']?></td>
                                        <td data-title="Username"><?=$row['order_payment_customer_no']?></td>
                                        <td data-title="Mobile"><?=$row['order_payment_phone_mobile']?></td>
                                        <td data-title="Email"><?=$row['order_payment_email']?></td>
                                        <td data-title="Usdt Address"><?=$row['order_payment_usdt_address']?></td>
                                        <td data-title="Amount"><?=number_format($row['order_payment_amount'],2)?></td>
                                        <td data-title="Status"><?=($row['order_payment_status']==0?lang('pending'):lang('approved'))?></td>
                                      <?php ?>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td class="remove_padding_50" colspan="10">
                                    <div class="total_rows"><?=lang('total_entries')?>: <?php echo $total_rows ?></div>
                                    <?php echo $pagination->create_links(); ?></td>
                                </tr>
                            <?php
                            }
                            else{
                            ?>
                                <tr>
                                    <td class="remove_padding_50" colspan="10" style="text-align: center;"><?=lang('no_result')?></td>
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
