</div>
<!-- ===== Content Area End ===== -->

</div>
<!-- ===== Page Wrapper End ===== -->

<script src="<?= $main_url ?>asset/tailadmin/build/bundle.js"></script>
<script>
    // validate numeric input
    function validateNumericInput(input) {
        input.value = input.value.replace(/[^0-9]/g, '')
    }

    // data table
    $(function() {
        $('#tblData').DataTable();
    });

    // Preview image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#prev')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    };
</script>
</body>

</html>