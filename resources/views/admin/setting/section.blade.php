@extends('admin.layout.index')


@section('content')

    <div class="page-content">
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="">
                    <a href="{{ route('setting.index') }}" > بيانات الموقع </a>
                </li>
                <li class="{{ $item->id == 2 ? 'active' : '' }}">
                    <a href="{{ route('section.edit',2) }}"> من نحن </a>
                </li>
                <li class="{{ $item->id == 1 ? 'active' : '' }}">
                    <a href="{{ route('section.edit',1) }}"> سياسة الخصوصية </a>
                </li>
                <li class="{{ $item->id == 3 ? 'active' : '' }}">
                    <a href="{{ route('section.edit',3) }}"> الشروط والأحكام </a>
                </li>

            </ul>

        </div>
        @include('admin.setting.row',['title'=>$title,'item'=>$item])
    </div>
@endsection
@push('js')
    <script>
        $(function () {
            CKEDITOR.replace('contentt');
            CKEDITOR.replace('content_en');
        })
    </script>
@endpush

