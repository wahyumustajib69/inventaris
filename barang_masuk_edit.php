<?php 
include 'koneksi.php';
$kode = $_GET['id'];
$sql = mysqli_query($konek,"SELECT*FROM brg_masuk WHERE no_faktur='$kode'");
foreach($sql as $tp){
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-primary" style="border-top-right-radius: 4px; border-top-left-radius: 4px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="myModalLabel">Update Barang Masuk</h4>
        </div>
        <form method="post" action="barang_masuk_update.php" role="form">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>No. Faktur / PO</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                            <input type="text" name="fak" class="form-control" readonly="readonly" required="required" value="<?php echo $tp['no_faktur'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Tanggal Masuk</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="date" name="tgl" class="form-control" required="required" value="<?php echo $tp['tgl'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Nama Barang</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-list"></i></span>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Barang Masuk" required="required" value="<?php echo $tp['nama'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Asal Barang</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-signal"></i></span>
                            <input type="text" name="asl" class="form-control" placeholder="Asal Barang" required="required" value="<?php echo $tp['asal'] ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Jumlah</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <input type="text" name="jml" class="form-control" required="required" placeholder="Jumlah Barang Masuk" value="<?php echo $tp['jml'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Harga</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                            <input type="text" name="hrg" class="form-control" placeholder="harga barang estimasi" value="<?php echo $tp['harga'] ?>">
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
                                <option value="<?php echo $tm['nama'] ?>"<?php if($tm['nama']==$tp['ktg']){echo 'selected';} ?>><?php echo $tm['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Keterangan</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-check-circle"></i></span>
                            <textarea name="ket" class="form-control" placeholder="Keterangan" required="required"><?php echo $tp['ket'] ?></textarea>
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