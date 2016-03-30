</div><!-- main -->

<script>
    // Uses a sweetalert to ask for user confirmation that they want to delete something
    function alertDelete(ajaxURL, message) {
        var targetURL = "<?= ROOT; ?>" + ajaxURL;
        swal({
                title: "تحذير!",
                text: message,
                type: "warning",
                allowOutsideClick: true,
                showCancelButton: true,
                confirmButtonColor: "#C9302C",
                confirmButtonText: "نعم",
                cancelButtonText: "لا",
                closeOnConfirm: false
            },
            function () {
                window.location.href = targetURL;
            }
        );
    }

    // Uses bootstrap modal to view a page in it
    function viewInModal(ajaxURL) {
        var targetURL = "<?= ROOT; ?>" + ajaxURL;
        $(".modal-content").html("");
        $(".modal-content").load(targetURL);
    }
</script>
