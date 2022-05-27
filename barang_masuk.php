    <?php include"header.php"; include_once"koneksi.php"; ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <i class="fa fa-truck"></i> Data Barang Masuk
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
                                     <a href="laporan_barang_masuk?bln=<?php echo $_GET['bln'] ?>" target="_blank" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>
                                 </div>
                                 <div class="col-md-6">
                                    <form method="get">
                                        <select name="bln" class="form-control" onchange="this.form.submit()">
                                            <option>-PILIH-</option>
                                            <option value="ALL">SEMUA</option>
                                            <option value="HIS">RIWAYAT</option>
                                            <?php
                                            error_reporting(0);
                                            $sql = mysqli_query($konek,"SELECT tgl FROM brg_masuk WHERE inventaris='BELUM' GROUP BY month(tgl)");
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
                                            <th>FAKTUR</th>
                                            <th>TANGGAL</th>
                                            <th>NAMA</th>
                                            <th>ASAL</th>
                                            <th>JUMLAH</th>
                                            <th>HARGA</th>
                                            <th>TOTAL</th>
                                            <th>KATEGORI</th>
                                            <th>INVENTARIS</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        $bl = $_GET['bln'];

                                        if($_GET['bln']=='ALL'){
                                            $sql = mysqli_query($konek,"SELECT*FROM brg_masuk ORDER BY tgl DESC");
                                        }else if($_GET['bln']=='HIS'){
                                            $sql = mysqli_query($konek,"SELECT*FROM brg_masuk WHERE inventaris='SUDAH' ORDER BY tgl DESC");
                                        }else{
                                            if(isset($_GET['bln'])){
                                                
                                                $tg = explode('-', $_GET['bln']);
                                                $th = $tg[0];
                                                $bl = $tg[1];
                                                
                                                $sql = mysqli_query($konek,"SELECT*FROM brg_masuk WHERE month(tgl)='$bl' AND year(tgl)='$th'");
                                            }else{
                                                $sql = mysqli_query($konek,"SELECT*FROM brg_masuk WHERE inventaris='BELUM' ORDER BY tgl DESC");
                                            }
                                        }

                                        foreach($sql AS $ru){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $ru['no_faktur']?></td>
                                            <td><?php echo tgl_ind($ru['tgl'])?></td>
                                            <td><?php echo $ru['nama']?></td>
                                            <td><?php echo $ru['asal']?></td>
                                            <td><?php echo $ru['jml']?></td>
                                            <td><?php echo duit($ru['harga']);?></td>
                                            <td><?php echo duit($ru['ttl']); ?></td>
                                            <td><?php echo $ru['ktg'] ?></td>
                                            <td><?php echo $ru['inventaris'] ?></td>
                                            <td>
<a href="#" class="btn btn-success btn-xs brgmsk_edit" id="<?php echo $ru['no_faktur']?>"><i class="fa fa-edit"></i></a>
<a class="btn btn-danger btn-xs" onclick="confirm_delete('barang_masuk_hapus.php?id=<?php echo $ru['no_faktur'];?>')"><i class="fa fa-times"></i></a>
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
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary" style="border-top-right-radius: 4px; border-top-left-radius: 4px;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                            <h4 class="modal-title" id="myModalLabel">Tambah Data Barang Masuk</h4>
                            </div>
                            <form method="post" action="barang_masuk_tambah.php" role="form">
                                <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>No. Faktur / PO</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                            <input type="text" name="fak" class="form-control" placeholder="No. Faktur" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tanggal Masuk</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="date" name="tgl" class="form-control" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nama Barang</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                            <input type="text" name="nama" class="form-control" placeholder="Nama Barang Masuk" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Asal Barang</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-signal"></i></span>
                                            <input type="text" name="asl" class="form-control" placeholder="Asal Barang" required="required">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Jumlah</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            <input type="number" min="1" name="jml" class="form-control" required="required" placeholder="Jumlah Barang Masuk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Harga</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                            <input type="text" name="hrg" class="form-control" placeholder="harga barang estimasi" onkeypress="return Angka(event);">
                                            <script>
                                                function Angka(evt) {
                                                  var charCode = (evt.which) ? evt.which : event.keyCode
                                                   if (charCode > 31 && (charCode < 48 || charCode > 57))
                                         
                                                    return false;
                                                  return true;
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Kategori</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            <select name="ktg" class="form-control" required="required">
                                                <option disabled="disabled" selected="">-PILIH-</option>
                                                <?php 
                                                $sql = mysqli_query($konek,"SELECT nama FROM kategori");
                                                foreach($sql as $tm){
                                                ?>
                                                <option value="<?php echo $tm['nama'] ?>"><?php echo $tm['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Keterangan</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-check-circle"></i></span>
                                            <textarea name="ket" class="form-control" placeholder="Keterangan" required="required"></textarea>
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
                <div class="modal fade" id="brgmsk-edit"></div>

                <!-- Modal Popup untuk delete--> 
        <div class="modal modal-xs fade" id="modal-delete">
            <div class="modal-dialog">
                <div class="modal-content" style="margin-top:150px;">
                    <div class="modal-header bg-primary" style="border-top-right-radius: 5px; border-top-left-radius: 5px;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                        <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> KONFIRMASI</h4>
                    </div> 
                    <div class="modal-body" align="center">Apakah Anda Yakin??<br>Hapus data <i class="fa fa-times"></i></div>   
                    <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                        <a href="#" class="btn btn-danger" id="delete-link"><i class="fa fa-check"></i> Hapus</a>
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