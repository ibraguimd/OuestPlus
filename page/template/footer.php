<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="./plugins/datatables/jquery.dataTables.js"></script>
<script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- DataTables Settings -->
<script src="./app.js" type="application/javascript"></script>
<script src="https://kit.fontawesome.com/6c3e5b7b6e.js" crossorigin="anonymous"></script>

<?php
if(isset($scripts)){
    foreach ($scripts as $script) {
        echo '<script src="'.$script.'" type="text/javascript"></script>';
    }
}
?>

</body>
</html>
