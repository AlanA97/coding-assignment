<form style="margin-left: 5px" action="{{$route}}" method="POST">
    @csrf
    @method('delete')
    <button type="button" class="btn btn-sm btn-danger" style="background-color: red" onclick="popModal(this)">
        <i class="fa fa-trash"></i>
    </button>
</form>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function popModal(_this){
        Swal.fire({
            title: "Are you sure",
            text: 'You will not be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if(result.isConfirmed){
                _this.form.submit();
            }
        });
    }
</script>
