<div class="modal fade" data-bs-backdrop="static" id = "meal-select-confirmation">
    <div class="modal-dialog modal-fullscreen-md-down">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Meal Selection</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-meal-remove = "#select-meal"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want this meal? You can only proceed to order once a day during the service period.</p>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-meal-remove = "#select-meal">Cancel</button>
          <form method="POST" action="{{ route('new-order') }}">
                @csrf
                <input type = "hidden" value="" id = "select-meal" name = "select-meal"/>
                <button class="btn btn-primary">Finalize Order</button>
          </form>
        </div>
      </div>
    </div>
</div>
