{{-- файл, в который мы поместим формы из create.blade и edit.blade, чтоб выполнялось DRY - don't repeat yourself   --}}
<h4>Заголовок</h4>
<div class="form-group">
    <input name="title" type="text" class="form-control" required value="{{ old('title') ?? $posts->title ?? '' }}"> {{-- если выполняется ??, то edit, если нет, то create; required - обязательные поля --}}
</div>
<h4>Описание</h4>
<div class="form-group">
    <textarea name="description" rows="10" class="form-control" required>{{ old('description') ?? $posts->description ?? '' }}</textarea> {{-- old('') нужен для того, чтобы когда высвечивается ошибка поля оставались так же заполнеными --}}
</div>
<div class="form-group">
    <input type="file" name="img">
</div>
