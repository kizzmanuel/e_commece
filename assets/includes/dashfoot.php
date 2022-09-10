<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Earlymarket 2022</div>
        </div>
    </div>
</footer>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/scripts.js"></script>

<script>
    const alertMsg = document.querySelector('#alertMsg');

    if(alertMsg){
        setTimeout(()=>{
            alertMsg.classList.add("animate__fadeOut")
        },2500)
    }
</script>