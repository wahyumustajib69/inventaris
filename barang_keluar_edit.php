<?php 
include 'koneksi.php';
$id = $_GET['id'];
$sql = mysqli_query($konek,"SELECT*FROM brg_keluar WHERE id='$id'");
foreach($sql as $tp){
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary" style="border-top-right-radius: 4px; border-top-left-radius: 4px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="myModalLabel">Update Barang Keluar</h4>
        </div>
        <form method="post" action="barang_keluar_update.php" role="form">
            <div class="modal-body">
                <input type="hidden" name="id" value="<?php echo $tp['id'] ?>">
                <div class="row">
                    <div class="col-md-6">
                        <label>Tanggal Keluar</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                            <input type="date" name="tgl" class="form-control" required="required" value="<?php echo $tp['tgl'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Nama Barang</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" name="nm_brg" id="nm_brg" placeholder="Cari nama barang..." class="form-control" required="required" value="<?php echo $tp['nm_brg'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Jumlah Keluar</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-list"></i></span>
                            <input type="text" name="jml" class="form-control" placeholder="Jumlah barang keluar" required="required" value="<?php echo $tp['jml'] ?>">
                            <input type="hidden" name="jm" value="<?php echo $tp['jml'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-signal"></i></span>
                            <select name="stts" class="form-control" required="required">
                                <option disabled="disabled" selected="">-PILIH-</option>
                                <option value="DISERVIS"<?php if($tp['status']=='DISERVIS'){echo 'selected';} ?>>DISERVIS</option>
                                <option value="DIPINJAM"<?php if($tp['status']=='DIPINJAM'){echo 'selected';} ?>>DIPINJAM</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label>Keterangan</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <textarea name="ket" class="form-control" placeholder="Keterangan barang" required="required"><?php echo $tp['ket'] ?></textarea>
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
<?php } ?>