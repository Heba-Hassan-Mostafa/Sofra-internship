
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
    <label for="name">Name</label>
    {!! Form::text('name',null,[
    'class'=>'form-control'
    ]) !!}
</div>


<div class="form-group">
    <label for="image">image</label>
    {!! Form::file('image',[
    'class'=>'form-control'
    ]) !!}
</div>

<div class="form-group">
    <label for="discount_price">Discount</label>
    {!! Form::number('discount_price',null,[
    'class'=>'form-control'
    ]) !!}
</div>

<div class="form-group">
    <label for="price">price</label>
    {!! Form::number('price',null,[
    'class'=>'form-control'
    ]) !!}
</div>
<div class="form-group">
    <label for="preparation_time">Preparation Time</label>
    {!! Form::text('preparation_time',null,[
    'class'=>'form-control'
    ]) !!}
</div>

<div class="form-group">
    <label for="short_description">Description</label>
    {!! Form::textarea('short_description',null,[
    'class'=>'form-control'
    ]) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">Save</button>
</div>
