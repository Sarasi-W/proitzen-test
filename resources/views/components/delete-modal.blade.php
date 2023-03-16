<div id="DeleteModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custom-modal-content">
            <div class="modal-header text-center">
                <h4 class="text-light-black">Delete Employee Record</h4>
            </div>
            <form method="POST" action="{{ route('employees.destroy', $id)}}" class="inline-div" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-body m-2">
                    <div class="text-center">
                        <p class="text-muted text-small my-3">
                            Are you sure you want to delete this employee from the list?
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary float-end" aria-label="Close" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger float-end mx-2">Delete</button>       
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(window).on('load', function() {
        $('.modal-opened').modal('show');
        console.log(id);
    });
</script>