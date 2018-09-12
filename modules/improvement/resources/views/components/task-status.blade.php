<p style="display: none">
    @if($task->is_active == 1) Active @else Inactive @endif
</p>
<input style="display: none" type="checkbox" id="task{{ $task->id }}" class="task-status" name="is_active" data-href="{{ route('tasks.update', $task) }}" value="{{ $task->id }}"
       @if($task->is_active == 1) checked="checked" @endif />
<label class="no-selection" for="task{{ $task->id }}">
    <span class="custom-checkbox"></span>
</label>