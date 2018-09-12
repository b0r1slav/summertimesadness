<div class="modal fade" id="modal-add-points" tabindex="-1" role="dialog" aria-labelledby="modal-add-points-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="modal-add-points-label">Add points</h5>
            </div>
            <div class="modal-body">
                <form id="form-add-points" method="post" action="{{ route('points-approvement.store') }}">
                    <input type="hidden" name="evaluation_id">
                    <div class="form-group">
                        <label for="evaluation-points" class="col-form-label">points</label>
                        <input type="number" name="points" step="0.5" class="form-control" id="evaluation-points">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btn-add-points" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>