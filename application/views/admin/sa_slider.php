<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Slide list</h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
              <a href="<?= site_url('admin/addSlider');?>" class="btn btn-oldblue"><i class="fa fa-plus"></i> Add slider</a>
          </div>
        </div>
        <div class="box-body">
          <?php $slide_count = count($slides); ?>
            <?php if($slide_count == 0): ?>
              <div class="row">
                <div class="col-sm-12">
                  <div class="alert" style="background: #f4f4f5">
                    <p class="text-center">No data availabe</p>
                  </div>
                </div>
              </div>
            <?php else: ?>
              <div class="row">
                <?php foreach($slides as $slide): ?>
                  <div class="col-sm-6 col-md-4 col-sm-lg-2">
                    <div class="thumbnail">
                      <img src="<?= base_url('asset/upload/'.$slide['slide']);?>"><br>
                      <a href="<?= site_url('admin/deleteSlider/'.$slide['id']);?>" class="btn btn-default" class="btn btn-default"><i class="pull-right fa fa-trash text-danger"></i></a>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
      </div>
    </div>
  </section>
</div>
