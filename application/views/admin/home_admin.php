<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Home
    </h1>
  </section>
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header pb-0">
<<<<<<< HEAD
              <h3 class="box-title">Data admin</h3>
=======
            <h3 class="box-title">Data Table With Full Features</h3>
>>>>>>> 2d924f0472adb59308389fdc4217121d2bd95949
            </div>
            <table id="dataTable" class="table">
            <thead>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Phone</th>
              <th>Detail</th>
            </thead>
            <tbody>
              <?php foreach($posts as $post): ?>
                <tr>
                  <td><?= $post['first_name'];?></td>
                  <td><?= $post['last_name'];?></td>
                  <td><?= $post['phone'];?></td>
                  <td><a href="#" class="btn btn-oldblue">Detail</a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
