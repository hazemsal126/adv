
<option selected="selected" value="0">اختر القسم</option>
@foreach ($subcats as $sub)
    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
@endforeach
