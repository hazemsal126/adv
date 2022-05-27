@extends('admin.layout.index')


@section('content')
    <div class="page-content">
        @include('admin.include.alert')

        <div class="row">
            <div class="col-md-12">
                <div class="tab-pane active" id="tab_0">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>تعديل البيانات</div>

                        </div>


                        <div class="portlet-body form">
                            <form action="{{route('roles.update', $role->id)}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('put')}}
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">الاسم</label>
                                        <div class="col-md-4">
                                            {!! Form::text('name', $role->name, array('placeholder' => 'Name','class' => 'form-control input-circle')) !!}                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-9">
                                            @foreach($permission as $k=>$v)
                                                <div class="row">
                                                    <div class="col-sm-12" style="margin-bottom:25px;margin-top:25px"><h4 class="edit-title text-success"><b>{{$k}}</b></h4></div>
                                                    @foreach($v as $value)
                                                        <div class="col-sm-3">
                                                            <div class="form-check form-check-inline">
                                                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                                <label class="form-check-label">{{ trans('role.'.$value->name) }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-circle green"> حفظ التغييرات </button>
                                            <a href="{{route('roles.index')}}" class="btn btn-circle grey-salsa btn-outline">الغاء</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
