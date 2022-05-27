<?php 
include 'koneksi.php';
$kode = $_GET['id'];
$sql = mysqli_query($konek,"SELECT*FROM inv_brg WHERE kode='$kode'");
foreach($sql as $tp){
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-primary" style="border-top-right-radius: 4px; border-top-left-radius: 4px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="myModalLabel">Update Data Inventaris</h4>
        </div>
        <form method="post" action="inventaris_barang_update.php" role="form">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>Kode Inventaris</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                            <input type="text" name="kode" class="form-control" placeholder="Nama Ruangan" value="<?php echo $tp['kode'] ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Nama Barang</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-laptop"></i></span>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Barang" value="<?php echo $tp['nama'] ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Kategori</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-list"></i></span>
                            <select name="ktg" class="form-control" required="required">
                                <option disabled="disabled" selected="">-PILIH-</option>
                                <?php 
                                $sql = mysqli_query($konek,"SELECT nama FROM kategori");
                                foreach($sql as $tm){
                                ?>
                                <option value="<?php echo $tm['nama'] ?>"<?php if($tm['nama']==$tp['kategori']){echo 'selected';} ?>><?php echo $tm['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Jumlah</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-signal"></i></span>
                            <input type="text" name="jml" class="form-control" placeholder="Jumlah" maxlength="4" value="<?php echo $tp['jumlah'] ?>">
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
                                <option value="<?php echo $st['nama'] ?>"<?php if($st['nama']==$tp['satuan']){echo 'selected';} ?>><?php echo $st['nama'] ?></option>
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
                                <option value="<?php echo $r['nama'] ?>"<?php if($r['nama']==$tp['lokasi']){echo 'selected';} ?>><?php echo $r['nama'] ?></option>
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
                                <option value="BAIK"<?php if($tp['kondisi']=='BAIK'){echo 'selected';} ?>>BAIK</option>
                                <option value="KURANG BAIK"<?php if($tp['kondisi']=='KURANG BAIK'){echo 'selected';} ?>>KURANG BAIK</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <select name="sts" class="form-control" required="required">
                                <option disabled="disabled" selected="">-PILIH-</option>
                                <option value="TERPAKAI"<?php if($tp['status']=='TERPAKAI'){echo 'selected';} ?>>TERPAKAI</option>
                                <option value="TIDAK TERPAKAI"<?php if($tp['status']=='TIDAK TERPAKAI'){echo 'selected';} ?>>TIDAK TERPAKAI</option>
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
<?php } ?>