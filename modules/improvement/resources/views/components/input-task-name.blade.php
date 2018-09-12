<span style="display: none">{{ $task->name }}</span>
<input class="task" style="border: none" maxlength="191" minlength="3" type="text" name="name" data-href="{{ route('tasks.update', $task) }}" value="{{ $task->name }}">
