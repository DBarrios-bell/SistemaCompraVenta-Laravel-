<script>
    document.querySelector("#selectReportType").addEventListener("change", function() {
        document.querySelector('select[name="selectType"]').style.display = this.value == 1 ? "inline-block" :
        "none";
    });
</script>

<style>
    select[name="selectType"] {
        display: none;
    }

</style>