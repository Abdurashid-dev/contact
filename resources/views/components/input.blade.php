<div>
    <div class="form-group mt-3">
        <label for="{{$name}}">{{$label}}</label>
        <input type="{{isset($type) ? ($type):'text'}}" name="{{$name}}" class="form-control {{isset($class)? ($class):''}}"  placeholder="{{isset($msg)? ($msg):''}}" value="{{isset($value)? ($value):''}}">
        @error($name)
            <span class="text-danger">* {{$message}}</span>
        @enderror
    </div>
</div>
