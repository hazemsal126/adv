@extends('admin.layout.index')


@section('content')

<div class="page-content">

    @include('admin.layout.breadcrumb',['title' => 'مستخدمي لوحة التحكم'])

        <div class="row">
        <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">الصلاحيات</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_5">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=0)
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        @can('role-edit')
                                            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">تعديل</a>
                                        @endcan
                                        @can('role-destroy')
                                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('حذف', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @include('admin.include.paginator', ['paginator' => $roles])
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

@endsection
