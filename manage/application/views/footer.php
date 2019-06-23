


</div>
<!-- /. PAGE INNER  -->

</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->

<!-- BOOTSTRAP SCRIPTS -->

<!-- METISMENU SCRIPTS -->
<!--<script src="js/jquery.metisMenu.js"></script>-->


<!-- DATA TABLE SCRIPTS -->
<script src="themes/js/dataTables/jquery.dataTables.js"></script>
<script src="themes/js/select2.full.js"></script>
<script src="themes/js/select2.full.min.js"></script>
<script src="themes/js/dataTables/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function() {
    $('.pcategory_code').select2();
    });
</script>

<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>


<script type="text/javascript">
    $('#image_input').hide();
    $('#btn_remove').click(function () {

        $('.remove_option').hide();
        $('#image_input').show();

    });

    $('#image_input1').hide();
    $('#btn_remove1').click(function () {

        $('.remove_option1').hide();
        $('#image_input1').show();

    });

    $('#pdf_input').hide();
    $('#btn_remove2').click(function () {

        $('.remove_option2').hide();
        $('#pdf_input').show();

    });

</script>




</body>
</html>
