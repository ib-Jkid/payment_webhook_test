@if($errors->has($name))
    <div class="error">{{ $errors->first($name) }}</div>
@endif