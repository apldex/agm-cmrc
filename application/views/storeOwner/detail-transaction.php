<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Detail Transaksi</h1>
  </section>

    <section class="content">
        <div class="row">
            <div class="col-xs">
                <div class="box">
                    <div class="box-header pb-0">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Nomor Transaksi</th>
                                    <td><?=$detailOrder[0]->order_number;?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Transaksi</th>
                                    <td><?=$detailOrder[0]->order_date;?></td>
                                </tr>
                                <tr>
                                    <th>Customer</th>
                                    <td class="word-wrap"><?=$detailOrder[0]->first_name." ".$detailOrder[0]->last_name?></td>
                                </tr>
                                <tr>
                                    <th>Alamat Pengiriman</th>
                                    <td class="word-wrap">
                                        <?=$detailOrder[0]->address.", ".$detailOrder[0]->kecamatan.', '.$detailOrder[0]->kabupaten.','.$detailOrder[0]->postcode?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td><?= $detailOrder[0]->phone?></td>
                                </tr>
                                <tr>
                                    <th>Status Transaksi</th>
                                    <td>
                                        <?php
                                        switch($detailOrder[0]->status_order) {
                                            case 1:
                                                echo "<p class=\"label label-success\">Pesanan Selesai</p>";
                                                break;
                                            case 2:
                                                echo "<p class=\"label label-warning btn-sm\">Menunggu Pembayaran</p>";
                                                echo " | <button type=\"button\" class=\"btn btn-sm btn-primary\" data-toggle=\"modal\" data-target=\"#modal-default\">
                                            Ubah Status
                                        </button>";
                                                break;
                                            case 3:
                                                echo "<p class=\"label label-danger btn-sm\">Pesanan Dibatalkan</p>";

                                                break;
                                            case 4:
                                                echo "<p class=\"label label-primary btn-sm\">Pesanan diproses</p>";
                                                echo " | <button type=\"button\" class=\"btn btn-sm btn-primary\" data-toggle=\"modal\" data-target=\"#modal-default\">
                                            Ubah Status
                                        </button>";
                                                break;
                                            case 5:
                                                echo "<p class=\"label label-primary btn-sm\">Pesanan Dikirim</p>";
                                                break;
                                            default:
                                                break;
                                        } ?>

                                    </td>
                                    <div class="modal fade" id="modal-default">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Ubah Status Transaksi</h4>
                                                </div>
                                                <form action="<?= site_url('stores/updateTransactionStatus/' . $detailOrder[0]->id . '/' .$detailOrder[0]->id_userlogin); ?>"
                                                      method="post">
                                                    <div class="modal-body">
                                                        <select name="status" class="form-control">
                                                            <option selected disabled>Pilih status</option>
                                                            <?php
                                                            switch($detailOrder[0]->status_order) {
                                                                case 2:
                                                                    echo "<option value=\"3\">Pesanan Dibatalkan</option>";
                                                                    break;
                                                                case 4:
                                                                    echo "<option value=\"1\">Pesanan Selesai</option>";
                                                                    break;
                                                                default:
                                                                    break;
                                                            } ?>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default pull-left"
                                                                data-dismiss="modal">Batal
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Simpan perubahan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </tr>

                            </table>
                        </div>

                    </div>
                    <table class="table ml-10">
                        <tr>
                            <th>Detail Pesanan</th>
                        </tr>
                    </table>
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <th>No.</th>
                            <th>Product</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($detailOrder as $order): ?>
                                    <tr>
                                        <td><?= $no?></td>
                                        <td><?= $order->name?></td>
                                        <td><?= $order->size_name.' ('.$order->size.')'?></td>
                                        <td><?= $order->quantity?></td>
                                        <td><?= 'Rp '.number_format(floatval($order->subtotal), 0, ',', '.')?></td>
                                    </tr>
                                <?php $no++; endforeach; ?>
                                <tr>
                                    <td colspan="6">&nbsp</td>
                                </tr>
                                <tr>
                                    <td colspan="3">&nbsp</td>
                                    <th>Subtotal:</th>
                                    <td>Rp. <?php $originalPrice = $detailOrder[0]->total / (1 - $detailOrder[0]->discount);
                                        echo number_format(floatval($originalPrice), 0, ',', '.');?></td>
                                </tr>
                                <tr>
                                    <td colspan="3">&nbsp</td>
                                    <th>Diskon:</th>
                                    <td>
                                        <?php if($detailOrder[0]->kode_voucher == "") {
                                            echo "-";
                                        } else {
                                            $discount = $originalPrice * $detailOrder[0]->discount;
                                            echo "Rp. ".number_format(floatval($discount)). " (".$detailOrder[0]->kode_voucher . ")";
                                        }?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">&nbsp</td>
                                    <th>Total:</th>
                                    <td>Rp. <?=number_format(floatval($detailOrder[0]->total), 0, ',', '.');?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>