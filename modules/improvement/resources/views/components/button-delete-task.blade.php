<form action="{{ route('tasks.delete', $task) }}" method="post" class="delete-task">
    <input type="hidden" name="is_active" value="0">
    {{ method_field('DELETE') }}
    <button type="submit" class="btn btn-danger btn-xs">&Cross;</button>
</form>