<form action="{{ route('points-approvement.update', $pointsApprovement->id) }}" method="post" class="approve-points">
    {{ method_field('PUT') }}
    <input type="hidden" name="status" value="approved">
    <button type="submit" class="btn btn-primary btn-xs">Approve</button>
</form>
