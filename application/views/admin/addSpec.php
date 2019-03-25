<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">
  <section class="content">
  <h1 class="text-center">ADD Spec</h1>
    <div class="container-fluid">
      <div class="register-box mt-0">
        <div class="register-box-body">
          <div class="row">
            <div class="col-md-12 col-sm-6">
              <!-- ALERT -->
              <?php if($this->session->has_userdata('error')): ?>
                <div class="alert alert-mini alert-danger mb-30">
                  <strong>Oh snap!</strong> <?= $this->session->flashdata('error');?>
                </div>
              <?php endif; ?>
              <!-- /ALERT -->
              <form class="m-0 sky-form" action="<?= site_url('admin/addSpec');?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <p class="register-box-msg">Add a new spec</p>
                <label class="input mb-10">
                  <input class="form-control" type="text" name="name" placeholder="Spec name">
                </label>
                <!-- <label class="input mb-10">
                  <input type="file" name="specPict" />
                </label> -->
                <div class="row">
                  <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-oldblue btn-default"><i class="fa fa-plus"></i>ADD</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
