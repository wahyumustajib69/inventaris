<?php 
include 'koneksi.php';
$id = $_GET['id'];
$sql = mysqli_query($konek,"SELECT*FROM ruangan WHERE id='$id'");
foreach($sql as $tp){
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary" style="border-top-right-radius: 4px; border-top-left-radius: 4px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="myModalLabel">Update Data Ruangan</h4>
        </div>
        <form method="post" action="ruangan_edit.php" role="form">
            <div class="modal-body">
                <input type="hidden" name="id" value="<?php echo $tp['id'] ?>">
                <label>Nama Ruangan</label>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Ruangan" value="<?php echo $tp['nama'] ?>">
                </div>
                <label>Status</label>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <select name="stts" class="form-control" required="required">
                        <option disabled="disabled" selected="">-PILIH-</option>
                        <option value="TERSEDIA"<?php if($tp['status']=='TERSEDIA'){echo 'selected';} ?>>TERSEDIA</option>
                        <option value="TIDAK TERSEDIA"<?php if($tp['status']=='TIDAK TERSEDIA'){echo 'selected';} ?>>TIDAK TERSEDIA</option>
                    </select>
                </div>
                <label>Keterangan</label>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <textarea name="ket" class="form-control" required="required"><?php echo $tp['ket'] ?></textarea>
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