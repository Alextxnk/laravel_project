{{-- файл, в который мы поместим формы из create.blade и edit.blade, чтоб выполнялось DRY - don't repeat yourself   --}}
<div class="form-group">
    <input name="title" type="text" class="form-control" required value="{{ $posts->title ?? '' }}"> {{-- если выполняется ??, то edit, если нет, то create; required - обязательные поля --}}
</div>
<div class="form-group">
    <textarea name="description" rows="10" class="form-control" required>{{ $posts->description ?? '' }}</textarea>
</div>
<div class="form-group">
    <input type="file" name="img">
</div>
