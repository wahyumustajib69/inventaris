    <?php include"header.php"; include_once"koneksi.php"; ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <i class="fa fa-home"></i> Data Ruangan
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
                             <!-- <a href="laporan_data_ruangan" target="_blank" class="btn btn-danger"><i class="fa fa-download"></i> Cetak Pdf</a> -->
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
                                            <th>NAMA RUANGAN</th>
                                            <th>STATUS</th>
                                            <th>KETERANGAN</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        $sql = mysqli_query($konek,"SELECT*FROM ruangan");
                                        foreach($sql AS $ru){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $ru['nama']?></td>
                                            <td>
                                                <?php
                                                $st = $ru['status'];
                                                if($st=='TERSEDIA'){
                                                    echo '<label class="label label-success">'.$st.'</label>';
                                                }else{
                                                    echo '<label class="label label-danger">'.$st.'</label>';
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $ru['ket']?></td>
                                            <td>
<a href="#" class="btn btn-success btn-xs ruangan_edit" id="<?php echo $ru['id']?>"><i class="fa fa-edit"></i></a>
<a class="btn btn-danger btn-xs" onclick="confirm_delete('ruangan_hapus.php?id=<?php echo $ru['id'];?>')"><i class="fa fa-times"></i></a>
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
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary" style="border-top-right-radius: 4px; border-top-left-radius: 4px;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                            <h4 class="modal-title" id="myModalLabel">Tambah Data Ruangan</h4>
                            </div>
                            <form method="post" action="ruangan_tambah.php" role="form">
                                <div class="modal-body">
                                    <label>Nama Ruangan</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama Ruangan">
                                    </div>
                                    <label>Status</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <select name="stts" class="form-control" required="required">
                                            <option disabled="disabled" selected="">-PILIH-</option>
                                            <option value="TERSEDIA">TERSEDIA</option>
                                            <option value="TIDAK TERSEDIA">TIDAK TERSEDIA</option>
                                        </select>
                                    </div>
                                    <label>Keterangan</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" name="ket" class="form-control" placeholder="Keterangan Ruangan">
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
                <div class="modal fade" id="modal-edit"></div>
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