    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.autocomplete.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
                // Selector input yang akan menampilkan autocomplete.
            $("#nm_brg").autocomplete({
                serviceUrl: "barang_keluar_cari.php",   // Kode php untuk prosesing data.
                dataType: "JSON",           // Tipe data JSON.
                onSelect: function (suggestion) {
                $("#nm_brg").val("" + suggestion.nama);
                $("#jml").val("" + suggestion.jml);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
                // Selector input yang akan menampilkan autocomplete.
            $("#nma").autocomplete({
                serviceUrl: "barang_masuk_cari.php",   // Kode php untuk prosesing data.
                dataType: "JSON",           // Tipe data JSON.
                onSelect: function (suggestion) {
                $("#nma").val("" + suggestion.nama);
                $("#ktg").val("" + suggestion.ktg);
                $("#jml").val("" + suggestion.jml);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
                // Selector input yang akan menampilkan autocomplete.
            $("#nama").autocomplete({
                serviceUrl: "barang_rusak_cari.php",   // Kode php untuk prosesing data.
                dataType: "JSON",           // Tipe data JSON.
                onSelect: function (suggestion) {
                $("#nama").val("" + suggestion.nama);
                $("#inv").val("" + suggestion.kode);
                $("#ktg").val("" + suggestion.ktg);
                $("#jml").val("" + suggestion.jml);
                $("#stn").val("" + suggestion.stn);
                }
            });
        });
    </script>
	<!--javascript edit data-->
    <script>
        $(document).ready(function () {
        $(".brgrsk_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "barang_rusak_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#brgrsk-edit").html(ajaxData);
                        $("#brgrsk-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
        $(".brgklr_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "barang_keluar_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#brgklr-edit").html(ajaxData);
                        $("#brgklr-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
        $(".brgmsk_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "barang_masuk_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#brgmsk-edit").html(ajaxData);
                        $("#brgmsk-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
        $(".inventaris_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "inventaris_modal_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#inv-edit").html(ajaxData);
                        $("#inv-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
        $(".ruangan_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "ruangan_modal_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#modal-edit").html(ajaxData);
                        $("#modal-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
        $(".kategori_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "kategori_modal_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#kategori-edit").html(ajaxData);
                        $("#kategori-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
    </script> 
    <script>
        $(document).ready(function () {
        $(".satuan_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "satuan_modal_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#satuan-edit").html(ajaxData);
                        $("#satuan-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
    </script> 
    <!-- Javascript hapus data-->
    <script>
        function confirm_delete(delete_url){
            $("#modal-delete").modal('show', {backdrop: 'static'});
            document.getElementById('delete-link').setAttribute('href', delete_url);
        }
    </script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
	<script src="assets/js/easypiechart.js"></script>
	<script src="assets/js/easypiechart-data.js"></script>
	<script src="assets/js/Lightweight-Chart/jquery.chart.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
           $('#dataTables-example').dataTable();
        });
        $(document).ready(function () {
           $('#dataTables').dataTable();
        });
    </script>
    <script>
      $(document).ready(function(){
        setTimeout(function(){
          $("#pesan").fadeIn('slow');
          }, 500);
        });
        setTimeout(function(){
          $("#pesan").fadeOut('slow');
        }, 3000);
    </script>
    <script>
      $(document).ready(function(){
        setTimeout(function(){
          $("#pesan-ktg").fadeIn('slow');
          }, 500);
        });
        setTimeout(function(){
          $("#pesan-ktg").fadeOut('slow');
        }, 3000);
    </script>
    <script>
      $(document).ready(function(){
        setTimeout(function(){
          $("#pesan-st").fadeIn('slow');
          }, 500);
        });
        setTimeout(function(){
          $("#pesan-st").fadeOut('slow');
        }, 3000);
    </script>
	
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
 

</body>

</html>