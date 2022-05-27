    <?php include"header.php"; include_once"koneksi.php"; ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <i class="fa fa-list"></i> Data kategori & Satuan
                        </h1>
                    </div>
                </div>
				
                <!-- /. ROW  -->
                <div class="row">

                <div class="col-md-6">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             <button class="btn btn-primary" data-toggle="modal" data-target="#modal-ktg"><i class="fa fa-plus"></i> Tambah</button>
                             <!-- <a href="laporan_data_kategori" target="_blank" class="btn btn-danger"><i class="fa fa-download"></i> Cetak Pdf</a> -->
                        </div>
                        <hr>
                        <?php
                          if (isset($_SESSION['pesan-ktg']) && $_SESSION['pesan-ktg'] <> '') {
                        ?>
                          <div id="pesan-ktg" class="alert alert-dismissible alert-success" style="display:none;">
                            <h6><i class="fa fa-check"></i> INFORMASI</h6>
                            <?php echo $_SESSION['pesan-ktg']?>
                          </div>
                        <?php }
                          $_SESSION['pesan-ktg'] = '';
                        ?>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA KATEGORI</th>
                                            <th>KETERANGAN</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        $sql = mysqli_query($konek,"SELECT*FROM kategori");
                                        foreach($sql AS $kt){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $kt['nama']?></td>
                                            <td><?php echo $kt['ket']?></td>
                                            <td>
<a href="#" class="btn btn-success btn-xs kategori_edit" id="<?php echo $kt['id']?>"><i class="fa fa-edit"></i></a>
<a class="btn btn-danger btn-xs" onclick="confirm_delete('kategori_hapus.php?id=<?php echo $kt['id'];?>')"><i class="fa fa-times"></i></a>
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

                <div class="col-md-6">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             <button class="btn btn-primary" data-toggle="modal" data-target="#modal-stn"><i class="fa fa-plus"></i> Tambah</button>
                            <!--  <a href="laporan_data_satuan" target="_blank" class="btn btn-danger"><i class="fa fa-download"></i> Cetak Pdf</a> -->
                        </div>
                        <hr>
                        <?php
                          if (isset($_SESSION['pesan-st']) && $_SESSION['pesan-st'] <> '') {
                        ?>
                          <div id="pesan-st" class="alert alert-dismissible alert-success" style="display:none;">
                            <h6><i class="fa fa-check"></i> INFORMASI</h6>
                            <?php echo $_SESSION['pesan-st']?>
                          </div>
                        <?php }
                          $_SESSION['pesan-st'] = '';
                        ?>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA SATUAN</th>
                                            <th>KETERANGAN</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        $sql = mysqli_query($konek,"SELECT*FROM satuan");
                                        foreach($sql AS $st){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $st['nama']?></td>
                                            <td><?php echo $st['ket']?></td>
                                            <td>
<a href="#" class="btn btn-success btn-xs satuan_edit" id="<?php echo $st['id']?>"><i class="fa fa-edit"></i></a>
<a class="btn btn-danger btn-xs" onclick="confirm_delete('satuan_hapus.php?id=<?php echo $st['id'];?>')"><i class="fa fa-times"></i></a>
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
                <!--Tambah Data Kategori-->
                <div class="modal fade" id="modal-ktg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary" style="border-top-right-radius: 4px; border-top-left-radius: 4px;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                            <h4 class="modal-title" id="myModalLabel">Tambah Data Kategori</h4>
                            </div>
                            <form method="post" action="kategori_tambah.php" role="form">
                                <div class="modal-body">
                                    <label>Nama Kategori</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama Kategori" autocomplete="off">
                                    </div>
                                    <label>Keterangan</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" name="ket" class="form-control" placeholder="Keterangan" autocomplete="off">
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
                <!--Tambah Data satuan-->
                <div class="modal fade" id="modal-stn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary" style="border-top-right-radius: 4px; border-top-left-radius: 4px;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                            <h4 class="modal-title" id="myModalLabel">Tambah Data Satuan</h4>
                            </div>
                            <form method="post" action="satuan_tambah.php" role="form">
                                <div class="modal-body">
                                    <label>Nama Satuan</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama Satuan" autocomplete="off">
                                    </div>
                                    <label>Keterangan</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" name="ket" class="form-control" placeholder="Keterangan" autocomplete="off">
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
                <div class="modal fade" id="kategori-edit"></div>
                <!--Update Data-->
                <div class="modal fade" id="satuan-edit"></div>
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