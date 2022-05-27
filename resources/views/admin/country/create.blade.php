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
                                <i class="fa fa-gift"></i>إضافة دولة</div>
                        </div>


                        <div class="portlet-body form">
                            <form action="{{route('country.store')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">اسم الدولة</label>
                                        <div class="col-md-6">
                                            {!! Form::text('name', null, array('placeholder' => 'اسم الدولة','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group last">
                                        <label class="control-label col-md-3">صورة الدولة</label>
                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="{{ asset('upload/no-image.png') }}" alt="" /> </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> اضافة صورة </span>
                                                                    <span class="fileinput-exists"> تعديل </span>
                                                                    <input type="file" name="img"> </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-circle green"> حفظ التغييرات </button>
                                            <a href="{{route('country.index')}}" class="btn btn-circle grey-salsa btn-outline">الغاء</a>
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
