@foreach ($permissions as $id => $name)
    <div class="checkbox">
        <label>
          <input type="checkbox" name="permissions[]" value="{{$name}}"
            {{$model->hasPermissionTo($name) ?  'checked' : ''}}>
            {{$name}}
        </label>
    </div>
@endforeach
