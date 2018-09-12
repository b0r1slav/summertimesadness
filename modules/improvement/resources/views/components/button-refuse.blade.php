<form action="{{ route('points-approvement.update', $pointsApprovement->id) }}" method="post" class="refuse-points">
    {{ method_field('PUT') }}
    <input type="hidden" name="status" value="refused">
    <button type="submit" class="btn btn-danger btn-xs">Refuse</button>
</form>
