<script type="text/javascript" src="mdb/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="mdb/js/popper.min.js"></script>
<script type="text/javascript" src="mdb/js/bootstrap.min.js"></script>
<script type="text/javascript" src="mdb/js/mdb.min.js"></script>
<script>
    $('#form-popover').popover({
    //    trigger: 'hover',
        content: $('#form').parent().html(),
        sanitize: false,
        html: true,
    });
</script>