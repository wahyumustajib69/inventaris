    <?php include"header.php"; include "koneksi.php";?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </h1>
                    </div>
                </div>
				
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary text-center no-boder">
                            <div class="alert alert-info">
                                <i class="fa fa-user"></i> SELAMAT DATANG <b><?php echo strtoupper($_SESSION['username']); ?></b>
                            </div>
                        </div>
                    </div>
                </div>
				
                <!-- /. ROW  -->

                <div class="row">
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <a href="ruangan">
                        <div class="panel panel-primary text-center no-boder bg-color-green green">
                            <div class="panel-left pull-left green">
                                <i class="fa fa-home fa-5x"></i>
                                
                            </div>
                            <div class="panel-right">
                                <?php 
                                $sql = mysqli_query($konek,"SELECT*FROM ruangan");
                                $a = mysqli_num_rows($sql);
                                ?>
								<h3><?php echo $a; ?></h3>
                               <strong> Total Ruangan</strong>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <a href="inventaris_barang">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                              <div class="panel-left pull-left blue">
                                <i class="fa fa-desktop fa-5x"></i>
								</div>
                                
                            <div class="panel-right">
                                <?php 
                                $sql = mysqli_query($konek,"SELECT*FROM inv_brg");
                                $b = mysqli_num_rows($sql);
                                ?>
							<h3><?php echo $b; ?></h3>
                               <strong> Inventaris</strong>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <a href="barang_masuk?bln=ALL">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-left pull-left red">
                                <i class="fa fa fa-truck fa-5x"></i>
                               
                            </div>
                            <div class="panel-right">
                                <?php 
                                $sql = mysqli_query($konek,"SELECT*FROM brg_masuk");
                                $c = mysqli_num_rows($sql);
                                ?>
							 <h3><?php echo $c; ?></h3>
                               <strong> Barang Masuk </strong>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <a href="barang_keluar?bln=ALL">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-left pull-left brown">
                                <i class="fa fa-share fa-5x"></i>
                            </div>
                            <div class="panel-right">
                                <?php 
                                $sql = mysqli_query($konek,"SELECT*FROM brg_keluar");
                                $d = mysqli_num_rows($sql);
                                ?>
							<h3><?php echo $d;?></h3>
                             <strong>Barang Keluar</strong>

                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <a href="barang_rusak?bln=ALL">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-left pull-left blue">
                                <i class="fa fa-flash    fa-5x"></i>
                            </div>
                            <div class="panel-right">
                                <?php 
                                $sql = mysqli_query($konek,"SELECT*FROM brg_rusak");
                                $e = mysqli_num_rows($sql);
                                ?>
                            <h3><?php echo $e;?></h3>
                             <strong>Barang Rusak</strong>

                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <a href="kategori">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-left green">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="panel-right">
                                <?php 
                                $sql = mysqli_query($konek,"SELECT*FROM kategori");
                                $f = mysqli_num_rows($sql);
                                ?>
                            <h3><?php echo $f;?></h3>
                             <strong>Kategori & Satuan</strong>

                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
<?php include "footer.php"; ?>