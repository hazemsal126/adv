@extends('admin.layout.index')


@section('content')

    <div class="page-content">
        @include('admin.layout.breadcrumb',['title' => 'لوحة الأقسام'])

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">لوحة الأقسام</span>
                        </div>
                        <div class="tools">
                            @include('admin.include.add-btn',['route'=> route('category.create')])
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{route('category.index')}}" method="get" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="col-lg-3">
                                        {!! Form::text('name',request('name'), array('placeholder' => 'الاسم','class' => 'form-control')) !!}
                                    </div>
                                    <div class="col-lg-3">
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
                                <th>  الاسم </th>
                                <th width="25%">  صورة القسم </th>
                                <th>  عدد الأقسام الفرعية </th>
                                <th>  الأقسام الفرعية </th>
                                <th> العمليات     </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=0)
                            @foreach($items as $item)

                                <tr>
                                    <td>{{++$i}}</td>
                                    <td><a href="{{route('sub_category.index',['id'=>$item->id])}}">{{$item->name}}</a></td>
                                    <td><img src="{{getimg($item->img)}}" style="width: 20%;"></td>
                                    <td>{{ $item->sub->count() }}</td>
                                    <td> @foreach($item->sub as $sub){{ $sub->name . '-' }}@endforeach </td>

                                    <td>

                                        @can('category-edit')
                                            <a href="{{ route('category.edit',$item->id) }}" class="btn btn-warning btn-flat btn-xs">تعديل</a>
                                        @endcan
                                        @can('category-destroy')
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
                                                {!! Form::open(['method' => 'DELETE','route' => ['category.destroy', $item->id],'style'=>'display:inline']) !!}
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
