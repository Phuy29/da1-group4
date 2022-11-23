</div>
<script src="../public/admin/dist/assets/js/bootstrap.js"></script>
<script src="../public/admin/dist/assets/js/app.js"></script>

<!-- Need: Apexcharts -->
<!--<script src="../public/admin/dist/assets/extensions/apexcharts/apexcharts.min.js"></script>-->
<!--<script src="../public/admin/dist/assets/js/pages/dashboard.js"></script>-->

<script src="../public/admin/dist/assets/extensions/filepond/filepond.js"></script>
<script src="../public/admin/dist/assets/extensions/toastify-js/src/toastify.js"></script>
<script src="../public/admin/dist/assets/js/pages/filepond.js"></script>

<script>
    function confirmDel(ctr, id) {
        if (confirm('Xác nhận xóa?')) {
            window.location.href = `?ctr=${ctr}&act=delete&id=${id}`;
        }
    }
</script>

</body>

</html>