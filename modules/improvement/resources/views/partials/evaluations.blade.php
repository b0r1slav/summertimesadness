<div class="x_panel">

    <div class="x_title">
        <h2>Evaluations</h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">

        <form id="add-evaluation" method="post" action="{{ route('users.evaluations.store', $user) }}">
            <div class="form-row">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label class="required" for="title">Subject title</label>
                    <input type="text" name="title" class="form-control" id="title" maxlength="191" minlength="3" placeholder="Title..." required>
                    <small class="form-text text-muted">The Title must be at least 3 characters.</small>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label class="required" for="must">Must points</label>
                    <input type="number" step="0.5" min="0" name="must" class="form-control" id="must" required>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label for="current">Current points</label>
                    <input type="number" step="0.5" name="current" class="form-control" id="current" placeholder="0">
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-12">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>

        <hr>

        <table id="user-evaluations" class="table table-striped" cellspacing="0" width="100%">
        </table>

    </div>
</div>