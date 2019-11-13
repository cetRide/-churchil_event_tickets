<script type="text/javascript" src="mdb/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="mdb/js/popper.min.js"></script>
<script type="text/javascript" src="mdb/js/bootstrap.min.js"></script>
<script type="text/javascript" src="mdb/js/mdb.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="mdb/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $('#form-popover').popover({
        //    trigger: 'hover',
        content: $('#form').parent().html(),
        sanitize: false,
        html: true,
    });
</script>
<script>
    var minDate = new Date();
    minDate.setMinutes(minDate.getMinutes() + 0);
    $(function() {
        $('#picker').datetimepicker({
            minDate: minDate,
            format: 'YYYY-MM-DD HH:MM'
        });
    });
</script>
