<div class="x_panel">

    <div class="x_title">
        <h2>Daily tasks</h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">

        <form id="add-task" method="post" action="{{ route('users.tasks.store', $user) }}">
            <input type="hidden" id="userId" value="{{ $user->id }}">
            <div class="form-row">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label class="required" for="name">Task name</label>
                    <input type="text" name="name" class="form-control" id="name" maxlength="191" minlength="3" placeholder="Name..." required>
                    <small class="form-text text-muted">The Name must be at least 3 characters.</small>
                </div>
                <div class="form-group col-md-3 col-sm-3 col-xs-12">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>

        <hr>

        <table id="user-tasks" class="table table-striped" cellspacing="0" width="100%">
        </table>
    </div>

</div>