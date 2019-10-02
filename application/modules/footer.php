<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2017 <a href="https://www.dnationsoft.com">DNationSoft</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php print base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php print base_url(); ?>assets/bower_components/jquery/dist/bootstrap3-typeahead.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php print base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php print base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php print base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php print base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php print base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php print base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php print base_url(); ?>assets/dist/js/demo.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php print base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
  
  //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    })
</script>

<script type="text/javascript">
  $(document).ready(function(){
      var addButton = $('.add_button'); //Add button selector
      var wrapper = $('.field_wrapper'); //Input field wrapper
      
      //Once add button is clicked
      $(addButton).click(function(){
          $(wrapper).append('<div class="order"><div class="col-xs-8 mm" ><input type="text" class="form-control " name="order_id[]" placeholder="Input Order Id" /></div><div class="col-xs-2 " style="margin-top: 5px;"> <a type="button" href="javascript:void(0);" class=" remove_field btn-warning btn-sm"><i class="fa fa-minus"></i></a></div><br><br></div>');

      });

      $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault();

        $(this).parent().parent().remove(); //remove inout field
         //inout field decrement
        })
      
  });
</script> 

</body>
</html>
