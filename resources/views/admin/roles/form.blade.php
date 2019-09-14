@inject('perm','App\Models\Permission')

<div class="form-group">
    <label for="name">Name</label>
    {!! Form::text('name',null,[
    'class'=>'form-control'
    ]) !!}
</div>

<div class="form-group">
    <label for="display name"> Display Name</label>
    {!! Form::text('display_name',null,[
    'class'=>'form-control'
    ]) !!}
</div>

<div class="form-group">
    <label for="description">Description</label>
    {!! Form::textarea('description',null,[
    'class'=>'form-control'
    ]) !!}
</div>

<div class="form-group">
    <label for="permission">Permissions</label><br>
    <input id="select-all" type="checkbox"><label for='select-all'>Select All</label>
    <div class="row">
        @foreach($perm->all() as $permission)
            <div class="col-sm-3">
                <div class="form-check">
           <input class="form-check-input" type="checkbox" name="permissions_list[]" value="{{$permission->id}}"

                  @if($model->hasPermission($permission->name))
                      checked

                      @endif

           >
                    <label class="form-check-label" for="defaultCheck1">
                        {{$permission->display_name}}
                    </label>
                </div>
            </div>

        @endforeach
    </div>
{{--    {!! Form::text('permission',null,[--}}
{{--    'class'=>'form-control'--}}
{{--    ]) !!}--}}
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">Save</button>
</div>



@push('scripts')
 <script>

     $("#select-all").click(function(){
         $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

     });


 </script>
    @endpush