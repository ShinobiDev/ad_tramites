{{--$roles--}}
@foreach ($roles as $id => $name)
    <div class="checkbox">
        <label>
        <input type="checkbox" name="roles[]" value="{{$name->name}}" {{$user->hasRole($name)
               ?  'checked' : ''}}>		          
            {{$name->name}}

        </label>
    </div>
@endforeach