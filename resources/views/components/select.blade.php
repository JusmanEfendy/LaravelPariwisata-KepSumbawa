<div class="form-group">
    <label for="{{ $name }}">{{ $text }}</label>
    <select name="{{ $name }}" id="{{ Str::slug($text) }}" class="form-control" (isset($multiple) &&
        $multiple="true" ) ? "multiple" :"">
        @foreach ($values as $key => $val)
            <option value="{{ $key }}">{{ $val }}</option>
        @endforeach
    </select>
</div>
