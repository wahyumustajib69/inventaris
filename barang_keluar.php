    <?php include"header.php"; include_once"koneksi.php"; ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <i class="fa fa-share"></i> Data Barang Keluar
                        </h1>
                    </div>
                </div>
				
                <!-- /. ROW  -->
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i> Tambah</button>
                                     <a href="laporan_barang_keluar?bln=<?php echo $_GET['bln'] ?>" target="_blank" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>
                                </div>
                                 <div class="col-md-6">
                                    <form method="get">
                                        <select name="bln" class="form-control" onchange="this.form.submit()">
                                            <option>-PILIH-</option>
                                            <option value="ALL">SEMUA</option>
                                            <?php
                                            error_reporting(0);
                                            $sql = mysqli_query($konek,"SELECT tgl FROM brg_keluar GROUP BY month(tgl)");
                                            foreach($sql as $cm){
                                                $tgl = explode('-', $cm['tgl']);
                                                $t = $tgl[0].'-'.$tgl[1];
                                            ?>
                                            <option value="<?php echo $t?>"><?php echo tgl_ind($t)?></option>
                                            <?php } ?>
                                        </select>
                                    </form>
                                 </div>
                             </div>
                        </div>
                        <hr>
                        <?php
                          if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                        ?>
                          <div id="pesan" class="alert alert-dismissible alert-success" style="display:none;">
                            <h6><i class="fa fa-check"></i> INFORMASI</h6>
                            <?php echo $_SESSION['pesan']?>
                          </div>
                        <?php }
                          $_SESSION['pesan'] = '';
                        ?>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <th>NAMA BARANG</th>
                                            <th>JUMLAH</th>
                                            <th>STATUS</th>
                                            <th>KETERANGAN</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        $bl = $_GET['bln'];

                                        if($_GET['bln']=='ALL'){
                                            $sql = mysqli_query($konek,"SELECT*FROM brg_keluar");
                                        }else{
                                            if(isset($_GET['bln'])){
                                                
                                                $tg = explode('-', $_GET['bln']);
                                                $th = $tg[0];
                                                $bl = $tg[1];
                                                
                                                $sql = mysqli_query($konek,"SELECT*FROM brg_keluar WHERE month(tgl)='$bl' AND year(tgl)='$th'");
                                            }else{
                                                $sql = mysqli_query($konek,"SELECT*FROM brg_keluar");
                                            }
                                        }
                                        foreach($sql AS $ru){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo tgl_ind($ru['tgl'])?></td>
                                            <td><?php echo $ru['nm_brg']?></td>
                                            <td><?php echo $ru['jml']?></td>
                                            <td><?php
                                             $stt = $ru['status'];
                                             if($stt=='KEMBALI'){
                                                echo '<label class="label label-success">'.$stt.'</label>';
                                             }else if($stt=='DIPINJAM'){
                                                echo '<label class="label label-primary">'.$stt.'</label>';
                                             }else{
                                                echo '<label class="label label-danger">'.$stt.'</label>';
                                             }
                                             ?>    
                                            </td>
                                            <td><?php echo $ru['ket'] ?></td>
                                            <td>
                                                <?php 
                                                $st = $ru['status'];
                                                if($st=='KEMBALI'){
                                                    ?>
<a class="btn btn-danger btn-xs" href="barang_keluar_rem?id=<?php echo $ru['id']?>"><i class="fa fa-times"></i></a>
                                                    <?php
                                                }else{
                                                ?>
<a href="#" class="btn btn-success btn-xs brgklr_edit" id="<?php echo $ru['id']?>"><i class="fa fa-edit"></i></a>
<a class="btn btn-primary btn-xs" onclick="confirm_delete('barang_keluar_hapus.php?id=<?php echo $ru['id'];?>')"><i class="fa fa-chevron-left"></i></a>
<?php }?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
                <!--Tambah Data-->
                <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header bg-primary" style="border-top-right-radius: 4px; border-top-left-radius: 4px;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                            <h4 class="modal-title" id="myModalLabel">Tambah Data Barang Keluar</h4>
                            </div>
                            <form method="post" action="barang_keluar_tambah.php" role="form">
                                <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Tanggal Keluar</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                            <input type="date" name="tgl" class="form-control" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nama Barang</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                            <input type="text" name="nm_brg" id="nm_brg" placeholder="Cari nama barang..." class="form-control" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Jumlah Keluar</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                            <input type="number" min="1" id="jml" name="jml" class="form-control" placeholder="Jumlah barang keluar" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-signal"></i></span>
                                            <select name="stts" class="form-control" required="required">
                                                <option disabled="disabled" selected="">-PILIH-</option>
                                                <option value="DISERVIS">DISERVIS</option>
                                                <option value="DIPINJAM">DIPINJAM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Keterangan</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            <textarea name="ket" class="form-control" placeholder="Keterangan barang" required="required"></textarea>
                                        </div>
                                    </div>
                                </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Update Data-->
                <div class="modal fade" id="brgklr-edit"></div>

                <!-- Modal Popup untuk delete--> 
        <div class="modal modal-xs fade" id="modal-delete">
            <div class="modal-dialog">
                <div class="modal-content" style="margin-top:150px;">
                    <div class="modal-header bg-primary" style="border-top-right-radius: 5px; border-top-left-radius: 5px;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                        <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> KONFIRMASI</h4>
                    </div> 
                    <div class="modal-body" align="center">PERHATIAN<br> Pastikan barang telah kembali sebelum dihapus secara permanen !!<i class="fa fa-times"></i></div>   
                    <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                        <a href="#" class="btn btn-danger" id="delete-link"><i class="fa fa-check"></i> Kembali</a>
                        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                    </div>
                </div>
            </div>
        </div>
            </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
<?php include "footer.php"; ?>