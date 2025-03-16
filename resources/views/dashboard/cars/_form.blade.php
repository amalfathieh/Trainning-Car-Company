
<select name="category_id"  class="form-control form-select">
    <option value=""> Category</option>
    @foreach($categories as $category)
        <option value="{{ $category->id}}" @selected( $car->category_id == $category->id)>{{$category->name}}</option>
    @endforeach
</select>

<div class="form-group">
    <label for="">brand</label>
    <input type="text" name="brand" class="form-control" value="{{ $car->brand }}">
</div>

<div class="form-group">
    <label for="">model</label>
    <input type="text" name="model" class="form-control" value="{{ $car->model }}">
</div>

<div class="form-group">
    <label for="">year</label>
    <input type="text" name="year" class="form-control" value="{{ $car->year }}">
</div>

<div class="form-group">
    <label for="">color</label>
    <input type="text" name="color" class="form-control" value="{{ $car->color }}">
</div>

<div class="form-group">
    <label for="">price</label>
    <input type="text" name="price" class="form-control" value="{{ $car->price }}">
</div>

<div class="form-group">
    <label for="">Image</label>
    <input type="file" name="image" class="form-control">
    @if($car->image)
        <img src="{{ asset('storage/' .$car->image) }}" alt="" height="50">
    @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>
