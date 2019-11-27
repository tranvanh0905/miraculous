<div class="form-group">
    <label class="col-form-label">Bài hát : </label>
    <select class="js-example-basic-multiple form-control"
            name="person_song[]" multiple="multiple">
        @if ($song !== null)

            @foreach ($song as $list)
                <option
                    value="{{$list->id}}">{{$list->name}}</option>
            @endforeach
        @endif

    </select>
    @if($errors->first('person_song'))
        <span
            class="text-danger">{{$errors->first('person_song')}}</span>
    @endif
</div>
<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
</script>
