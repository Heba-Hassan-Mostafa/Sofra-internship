{{--@inject('city','App\Models\City')--}}







{{--@php--}}
{{--    $cities = [0 => 'Choose City'] + $city->pluck('name','id')->toArray();--}}
{{--   $districts = [0 => 'Choose District'];--}}
{{--$selected = null;--}}
{{--$selectedDistrict = null;--}}
{{--if($model->district_id > 0)--}}
{{--{--}}
{{--$selected =  $model->district->city->id;--}}
{{--$selectedDistrict = $model->district->id;--}}
{{--$districts = $districts+$city->find($selected)->districts()->pluck('name','id')->toArray();--}}
{{--}--}}
{{--    $placeholder = 'Choose City ';--}}
{{--    $option=' <option value="0">Choose District </option>';--}}
{{--@endphp--}}
{{--<div class="row">--}}
{{--    <div class="col-md-6">--}}
{{--        {!! Form::text('name' , ' Restaurant name ') !!}--}}
{{--    </div>--}}
{{--</div>--}}
{{--<label for="city_id">Choose City</label>--}}
{{--<div class="">--}}
{{--    {!! Form::select('city_id',$cities,$selected,[--}}
{{--    "class" => "form-control ",--}}
{{--    "id" => 'city_id',--}}
{{--    ])  !!}--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-md-6">--}}
{{--    <div  class="form-group">--}}
{{--        <label for="district_id" class="control-label">اختر المنطقة</label>--}}
{{--        {!! Form::select('district_id',$districts,$selectedDistrict,[--}}
{{--            "class" => "form-control ",--}}
{{--            "id" => 'district_id',--}}
{{--            ])  !!}--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--    <label for="name">Name</label>--}}
{{--    {!! Form::text('name',null,[--}}
{{--    'class'=>'form-control'--}}
{{--    ]) !!}--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--    <button class="btn btn-primary" type="submit">Save</button>--}}
{{--</div>--}}
