
<option selected="selected" value="0">اختر المدينة</option>
@foreach ($cities as $city)
    <option value="{{ $city->id }}" >{{ $city->name }}</option>
@endforeach
