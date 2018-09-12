<form action="{{ route('evaluations.update', $evaluation->id) }}" method="post" class="delete-evaluation">
    <input type="hidden" name="is_active" value="0">
    {{ method_field('PUT') }}
    <button type="submit" class="btn btn-danger btn-xs">&Cross;</button>
</form>