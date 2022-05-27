<?php 
include 'koneksi.php';
$id = $_GET['id'];
$sql = mysqli_query($konek,"SELECT*FROM brg_rusak WHERE id='$id'");
foreach($sql as $tp){
?>
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header bg-primary" style="border-top-right-radius: 4px; border-top-left-radius: 4px;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data Barang Rusak</h4>
        </div>
        <form method="post" action="barang_rusak_update.php" role="form">
            <div class="modal-body">
                <input type="hidden" name="id" value="<?php echo $tp['id'] ?>">
            <div class="row">
                <div class="col-md-6">
                    <label>Tanggal Rusak</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="date" name="tgl" class="form-control" required="required" value="<?php echo $tp['tgl'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Kode Inventaris</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" name="inv" id="inv" readonly="readonly" class="form-control" required="required" value="<?php echo $tp['kd_inv'] ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Nama Barang</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Cari Nama Barang..." required="required" value="<?php echo $tp['nm_brg'] ?>" readonly="readonly">
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Kategori</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <input type="text" id="ktg" name="ktg" class="form-control" required="required" readonly="readonly" value="<?php echo $tp['kategori'] ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>Satuan</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <input type="text" name="stn" id="stn" class="form-control" readonly="readonly" required="required" value="<?php echo $tp['satuan'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Jumlah</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                        <input type="number" id="jml" name="jml" class="form-control" required="required" placeholder="Jumlah Rusak" value="<?php echo $tp['jml'] ?>">
                        <input type="hidden" name="jm" value="<?php echo $tp['jml'] ?>">
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