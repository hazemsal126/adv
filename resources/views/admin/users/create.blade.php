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
                                <i class="fa fa-gift"></i>إضافة مستخدم</div>

                        </div>


                        <div class="portlet-body form">
                            <form action="{{route('users.store')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">اسم المستخدم</label>
                                        <div class="col-md-4">
                                        {!! Form::text('name', null, array('placeholder' => 'اسم المستخدم','class' => 'form-control input-circle')) !!}                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">الايميل</label>
                                        <div class="col-md-4">
                                            {!! Form::email('email', null, array('placeholder' => 'الايميل','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">رقم الهاتف</label>
                                        <div class="col-md-4">
                                        {!! Form::number('phone', null, array('placeholder' => 'رقم الهاتف','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">كلمة المرور</label>
                                        <div class="col-md-4">
                                        {!! Form::password('password', array('placeholder' => 'كلمة المرور','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">تأكيد كلمة المرور</label>
                                        <div class="col-md-4">
                                        {!! Form::password('password_confirmation', array('placeholder' => 'تأكيد كلمة المرور ','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">الصلاحيات</label>
                                        <div class="col-md-4">
                                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control input-circle','multiple')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group last">
                                        <label class="control-label col-md-3">صورة شخصية</label>
                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
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
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">امكانية الدخول الي لوحة التحكم</label>
                                        <div class="col-md-4">
                                        <select name="isadmin" class="form-control input-circle">
                                        <option value=0>لا</option>
                                        <option value=1>نعم</option>
                                </select>
                                        </div>

                                    </div>



                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-circle green"> حفظ التغييرات </button>
                                            <a href="{{route('users')}}" class="btn btn-circle grey-salsa btn-outline">الغاء</a>
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

