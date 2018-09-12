<span style="display: none">{{ $evaluation->current }}</span>
<input style="border: none" class="evaluation" type="number" step="0.5" name="current" data-href="{{ route('evaluations.update', $evaluation) }}" value="{{ $evaluation->current }}">
