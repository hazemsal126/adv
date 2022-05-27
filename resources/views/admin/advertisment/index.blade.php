@extends('admin.layout.index')


@section('content')

    <div class="page-content">
        @include('admin.layout.breadcrumb',['title' => 'لوحة الاعلانات'])

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">لوحة الاعلانات</span>
                        </div>
                        <div class="tools">
                            @include('admin.include.add-btn',['route'=> route('category.create')])
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{route('advertisment.index')}}" method="get" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="col-lg-2">
                                        {!! Form::text('title',request('title'), array('placeholder' => 'العنوان','class' => 'form-control')) !!}
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('country_id', $countries,request('country_id'), array('placeholder' => 'اختر الدولة','class' => 'form-control input-circle','id' => 'country_id')) !!}
                                    </div>
                                    <div class="col-lg-2">
                                        <select name="city_id" class='form-control input-circle' id ='city_id'>
                                            @if(isset($cities))
                                            <option selected="selected" value="0">اختر المدينة</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" @if(request('city_id') == $city->id) selected @endif>{{ $city->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        {!! Form::select('cat_id', $cats,request('cat_id'), array('placeholder' => 'اختر القسم','class' => 'form-control input-circle','id' => 'cat_id')) !!}
                                    </div>
                                    <div class="col-lg-2">
                                        <select name="subcat_id" class='form-control input-circle' id ='subcat_id'>
                                            @if(isset($subcats))
                                                <option selected="selected" value="0">اختر القسم</option>
                                        @foreach($subcats as $sub)
                                            <option value="{{ $sub->id }}" @if(request('subcat_id') == $sub->id) selected @endif>{{ $sub->name }}</option>
                                        @endforeach

                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="submit" class="btn btn-default">بحث</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <br>
                        <table class="table table-striped table-bordered table-hover" id="sample_5">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th>  العنوان </th>
                                <th width="25%">  صورة الاعلان </th>
                                <th>  المدينة </th>
                                <th>  القسم الفرعي </th>
                                <th> العمليات     </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=0)
                            @foreach($items as $item)

                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$item->title}}</td>
                                    <td><img src="{{getimg($item->img)}}" style="width: 20%;"></td>
                                    <td>{{ $item->city ? $item->city->name:'-' }}</td>
                                    <td>{{ $item->subcat ? $item->subcat->name:'-' }}</td>


                                    <td>

                                        @can('advertisment-edit')
                                            <a href="{{ route('advertisment.edit',$item->id) }}" class="btn btn-warning btn-flat btn-xs">تعديل</a>
                                        @endcan
                                        @can('advertisment-destroy')
                                            <a class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#confirm-delete{{$item->id}}" >حذف</a>
                                        @endcan


                                    </td>
                                </tr>
                                <div id="confirm-delete{{$item->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">حذف</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>هل تريد بالتأكيد الحذف</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
                                                {!! Form::open(['method' => 'DELETE','route' => ['advertisment.destroy', $item->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('نعم', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            </tbody>

                        </table>
                        @include('admin.include.paginator', ['paginator' => $items])
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
