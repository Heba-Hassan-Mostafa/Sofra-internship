@inject('restaurant','App\Models\Restaurant')





<div class="form-group">
    <label for="restaurants"> Restaurant </label>
    <select class="form-control form-control-lg" id="restaurants" name="restaurant_id" placeholder=" select ">
        <option disabled selected value> </option>


        @foreach ($restaurants as $restaurant)
            <option value="{{$restaurant->id}}">{{$restaurant->name }}</option>
        @endforeach
    </select>
    <span class=" text-danger"> {{ $errors->first('restaurant_id') }}</span>

</div>


<div class="form-group">
    <label for=" paid"> paid</label>
    {!! Form::text('paid',null,[
    'class'=>'form-control'
    ]) !!}
</div>



<div class="form-group">
    <label for="notes">Notes</label>
    {!! Form::textarea('notes',null,[
    'class'=>'form-control'
    ]) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">Save</button>
</div>


