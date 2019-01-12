<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('asset/dist/img/user.png');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <br>
          <?php if($this->session->userdata('uType') == 1): ?>
            <p>Super Admin</p>
          <?php endif; ?>
          <?php if($this->session->userdata('uType') == 2): ?>
            <p>Admin</p>
          <?php endif; ?>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
          </div>
      </form>
      <hr>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php if($this->session->userdata('uType') == 1): ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-id-badge"></i> <span>Admin</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
<<<<<<< HEAD
              <li>
                <a href="<?=site_url('auth/regis');?>"><i class="fa fa-user-plus"></i><span> Admin</span></a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-pencil-square-o"></i><span> Slider</span></a>
          </li>
          <li>
            <a href="#"><i class="fa fa-tag"></i><span> Promotion</span></a>
          </li>
          <li>
            <a href="<?= site_url('admin/sa_agmpedia');?>"><i class="fa fa-book"></i><span>AGM-Pedia</span></a>
=======
              <li><a href="<?=site_url('auth/regisAdmin');?>"><i class="fa fa-user-plus"></i> Add Admin</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-pencil-square-o"></i><span>Slider</span></a>
          </li>
          <li>
            <a href="#"><i class="fa fa-tag"></i><span>Promotion</span></a>
          </li>
          <li>
            <a href="<?=site_url('home/sa_agmpedia');?>"><i class="fa fa-book"></i><span>AGM-Pedia</span></a>
>>>>>>> 2d924f0472adb59308389fdc4217121d2bd95949
          </li>
          <li>
            <a href="#"><i class="fa fa-map"></i><span>Location Stores</span></a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-cube"></i> <span>Manage Products</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
<<<<<<< HEAD
              <li class="active"><a href="<?= site_url('admin/sa_brand');?>">Brands</a></li>
              <li class="active"><a href="<?= site_url('admin/sa_cat');?>">Categories</a></li>
              <li class="active"><a href="<?= site_url('admin/allProd');?>">Products</a></li>
              <li class="active"><a href="<?= site_url();?>">Rating</a></li>
              <li class="active"><a href="<?= site_url();?>">Best Order</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if($this->session->userdata('uType') == 2): ?>
          <li class="active treeview">
=======
              <li><a href="<?= site_url('home/sa_brand');?>"><i class="fa fa-circle-o"></i>Brands</a></li>
              <li><a href="<?= site_url('home/sa_cat');?>"><i class="fa fa-circle-o"></i>Categories</a></li>
              <li><a href="<?= site_url('home/allProd');?>"><i class="fa fa-circle-o"></i>Products</a></li>
              <li><a href="<?= site_url();?>"><i class="fa fa-circle-o"></i>Rating</a></li>
              <li><a href="<?= site_url();?>"><i class="fa fa-circle-o"></i>Best Order</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="treeview">
>>>>>>> 2d924f0472adb59308389fdc4217121d2bd95949
            <a href="#">
              <i class="fa fa-id-badge"></i> <span>Store Owners</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=site_url('auth/regisAdmin');?>"><i class="fa fa-user-plus"></i> Store Owner</a></li>
            </ul>
          </li>
          <li>
            <a href="#">Voucher</a>
          </li>
          <li>
            <a href="#">Distributor</a>
          </li>
          <li>
            <a href="#">Products</a>
          </li>
        <?php endif; ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>