    <?php include"header.php"; include_once"koneksi.php"; ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <i class="fa fa-laptop"></i> Data Inventaris
                        </h1>
                    </div>
                </div>
				
                <!-- /. ROW  -->
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i> Tambah</button>
                             <a href="laporan_data_inventaris?ref=ALL" target="_blank" class="btn btn-danger"><i class="fa fa-print"></i> Print All</a>
                             <a href="laporan_data_inventaris?ref=INUSED" target="_blank" class="btn btn-danger"><i class="fa fa-print"></i> Print Barang Terpakai</a>
                             <a href="laporan_data_inventaris?ref=UNUSED" target="_blank" class="btn btn-danger"><i class="fa fa-print"></i> Print Tidak Terpakai</a>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <?php
                                    $sql = mysqli_query($konek,"SELECT*FROM brg_masuk WHERE inventaris='BELUM'");
                                    $a = mysqli_num_rows($sql);
                                    ?>
                                    <i class="fa fa-exclamation-circle"></i> <a href="barang_masuk">Barang masuk</a> belum diinventaris: <b class="text-danger"><?php echo $a; ?></b>
                                </div>
                            </div>
                        </div>
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
                                            <th>KODE INV.</th>
                                            <th>NAMA BARANG</th>
                                            <th>KATEGORI</th>
                                            <th>JUMLAH</th>
                                            <th>SATUAN</th>
                                            <th>LOKASI</th>
                                            <th>KONDISI</th>
                                            <th>STATUS</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        $sql = mysqli_query($konek,"SELECT*FROM inv_brg");
                                        foreach($sql AS $ru){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $ru['kode']?></td>
                                            <td><?php echo $ru['nama']?></td>
                                            <td><?php echo $ru['kategori']?></td>
                                            <td><?php echo $ru['jumlah']?></td>
                                            <td><?php echo $ru['satuan']?></td>
                                            <td><?php echo $ru['lokasi']?></td>
                                            <td><?php
                                                $st = $ru['kondisi'];
                                                if($st=='TERPAKAI'){
                                                    echo '<label class="label label-primary">'.$st.'</label>';
                                                }else{
                                                    echo '<label class="label label-info">'.$st.'</label>';
                                                }
                                                ?></td>
                                            <td>
                                                <?php
                                                $st = $ru['status'];
                                                if($st=='TERPAKAI'){
                                                    echo '<label class="label label-success">'.$st.'</label>';
                                                }else{
                                                    echo '<label class="label label-danger">'.$st.'</label>';
                                                }
                                                ?>
                                            </td>
                                            <td>
<a href="#" class="btn btn-success btn-xs inventaris_edit" id="<?php echo $ru['kode']?>"><i class="fa fa-edit"></i></a>
<a class="btn btn-danger btn-xs" onclick="confirm_delete('inventaris_hapus.php?id=<?php echo $ru['kode'];?>')"><i class="fa fa-times"></i></a>
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
                            <h4 class="modal-title" id="myModalLabel">Tambah Data Inventaris</h4>
                            </div>
                            <form method="post" action="inventaris_barang_tambah.php" role="form">
                                <div class="modal-body">
                                    <?php
                                      $query = "SELECT max(kode) as maxKode FROM inv_brg";
                                      $hasil = mysqli_query($konek,$query);
                                      $data = mysqli_fetch_array($hasil);
                                      $kodeInv = $data['maxKode'];
                                      $noUrut = (int) substr($kodeInv, 10, 3);
                                      $noUrut++;
                                      $acak = rand(1000 ,9999);
                                      $char = "INV-BKKBN-";
                                      $cde = $char . sprintf("%03s", $noUrut).$acak;
                                    ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Kode Inventaris</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                            <input type="text" name="kode" class="form-control" placeholder="Nama Ruangan" value="<?php echo $cde; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nama Barang</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-laptop"></i></span>
                                            <input type="text" name="nama" id="nma" class="form-control" placeholder="Cari Nama Barang...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Kategori</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                            <select name="ktg" id="ktg" class="form-control" required="required">
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
                                        <label>Jumlah</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-signal"></i></span>
                                            <input type="number" min="1" name="jml" id="jml" class="form-control" placeholder="Jumlah" maxlength="4">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Satuan</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            <select name="stn" class="form-control" required="required">
                                                <option disabled="disabled" selected="">-PILIH-</option>
                                                <?php 
                                                $sql = mysqli_query($konek,"SELECT nama FROM satuan");
                                                foreach($sql as $st){
                                                ?>
                                                <option value="<?php echo $st['nama'] ?>"><?php echo $st['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Lokasi</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                            <select name="lok" class="form-control" required="required">
                                                <option disabled="disabled" selected="">-PILIH-</option>
                                                <?php 
                                                $sql = mysqli_query($konek,"SELECT nama FROM ruangan");
                                                foreach($sql as $r){
                                                ?>
                                                <option value="<?php echo $r['nama'] ?>"><?php echo $r['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Kondisi</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-check-circle"></i></span>
                                            <select name="knd" class="form-control" required="required">
                                                <option disabled="disabled" selected="">-PILIH-</option>
                                                <option value="BAIK">BAIK</option>
                                                <option value="RUSAK">RUSAK</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            <select name="sts" class="form-control" required="required">
                                                <option disabled="disabled" selected="">-PILIH-</option>
                                                <option value="TERPAKAI">TERPAKAI</option>
                                                <option value="TIDAK TERPAKAI">TIDAK TERPAKAI</option>
                                            </select>
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
                <div class="modal fade" id="inv-edit"></div>

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