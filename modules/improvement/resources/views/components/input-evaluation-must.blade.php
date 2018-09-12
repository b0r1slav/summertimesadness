<span style="display: none">{{ $evaluation->must }}</span>
<input style="border: none" class="evaluation" min="0" type="number" step="0.5" name="must" data-href="{{ route('evaluations.update', $evaluation) }}" value="{{ $evaluation->must }}">
