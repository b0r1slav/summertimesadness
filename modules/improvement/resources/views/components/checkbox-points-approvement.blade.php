<input style="display: none" type="checkbox" id="{{ $pointsApprovement->id }}" class="points-approvement-checkbox"
        value="{{ $pointsApprovement->evaluation_id . '|' . $pointsApprovement->points }}" />
<label class="no-selection" for="{{ $pointsApprovement->id }}">
    <span class="custom-checkbox"></span>
</label>