@extends('admin.layout.index')


@section('content')

    <div class="page-content">
        @include('admin.layout.breadcrumb',['title' => ' لوحة طلبات كن صانع المحتوى'])

        @include('admin.include.alert')


        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> لوحة طلبات كن  صانع المحتوى</span>
                        </div>
                        <div class="tools"> </div>
                    </div>

                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{route('makerer.order')}}" method="get" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="col-lg-3">
                                        {!! Form::text('name',request('name'), array('placeholder' => 'الاسم','class' => 'form-control')) !!}
                                    </div>
                                    <div class="col-lg-3">
                                        {!! Form::text('email',request('email'), array('placeholder' => 'الايميل','class' => 'form-control')) !!}
                                    </div>
                                    <div class="col-lg-3">
                                        {!! Form::text('phone',request('phone'), array('placeholder' => 'الهاتف','class' => 'form-control')) !!}
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-default">بحث</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <br>
                        <table class="table table-striped table-bordered table-hover table-responsive" id="sample_5">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th>  الاسم </th>
                                <th> اسم المستخدم </th>
                                <th>  البايو </th>
                                <th>  حسابات التواصل الاجتماعي </th>
                                <th width="25%">  الصورة الشخصية </th>
                                <th> العمليات     </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=0)
                            @foreach($items as $item)

                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->username}}</td>
                                    <td>{{$item->pio}}</td>
                                    <td>
                                        <a class="btn btn-info btn-flat btn-xs" data-toggle="modal" data-target="#confirm-show{{$item->id}}" >عرض</a>

                                    </td>
                                    <td><img src="{{getimg($item->img)}}" style="width: 20%;"></td>
                                    <td>

                                            @can('makerer-edit')

                                        <a class="btn btn-success btn-flat btn-xs" data-toggle="modal" data-target="#confirm-order{{$item->id}}" >تفعيل</a>
                                            @endcan


                                    </td>
                                </tr>
                                <div id="confirm-order{{$item->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">التفعيل</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p> هل تريد بالتأكيد التفعيل كصانع محتوى </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                                {!! Form::open(['method' => 'post','route' => ['makerer.order.update', $item->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('نعم', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="confirm-show{{$item->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">حسابات التواصل الاجتماعي</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">فيس بوك:</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static"> {{ $item->facebook }} </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">واتس اب:</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static"> {{ $item->whatsapp }} </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">تويتر:</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static"> {{ $item->twitter }} </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">انستجرام:</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static"> {{ $item->instagram }} </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">سناب شات:</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static"> {{ $item->snapshat }} </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">تلجرام:</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static"> {{ $item->telegram }} </p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
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
