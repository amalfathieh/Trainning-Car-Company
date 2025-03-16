


<div class="form-group">
    <label for="">Category name</label>
    <input type="text" name="name" class="form-control" value="{{ $category->name }}">
</div>
<div class="form-group">
    <label for="">Description</label>
    <textarea name="description"  class="form-control">{{ $category->description }}</textarea>
</div>

<div class="form-group">
    <label for="">Image</label>
    <input type="file" name="image" class="form-control">
    @if($category->image)
        <img src="{{ asset('storage/' .$category->image) }}" alt="" height="50">
    @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>
