  <!-- Modal -->
<div class="modal fade" id="productDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body productDetailsModalBody">
        </div>
      </div>
    </div>
  </div>

<script>
    function showProductDetails(id){
        // getLoadingStatus();
        customAjaxCall(function(res){
            // closeSweetAlert();
            console.log("res", res);
            $('.productDetailsModalBody').html(res.info);
            $('#productDetailsModal').modal('show');
        }, "get","{{ route('common.get_product_details') }}", {id:id});
    }
</script>
