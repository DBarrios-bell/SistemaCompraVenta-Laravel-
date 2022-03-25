<script>
    documaddEventListener("change", function() {
        document.querySelector('select[name="selectType"]').style.display = this.value == 1 ? "inline-block" :
        "none";
    });ent.querySelector("#selectReportType").
</script>

<style>
    select[name="selectType"] {
        display: none;
    }

</style>