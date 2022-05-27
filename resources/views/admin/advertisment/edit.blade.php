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
                                <i class="fa fa-gift"></i>تعجيل اعلان</div>
                        </div>


                        <div class="portlet-body form">
                            <form action="{{route('advertisment.update',$item->id)}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="form-body">
                                    <h3>بيانات الاعلان</h3>

                                    <hr>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">عنوان المنتج</label>
                                        <div class="col-md-6">
                                            {!! Form::text('title', $item->title, array('placeholder' => 'عنوان المنتج','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">سعر المنتج</label>
                                        <div class="col-md-6">
                                            {!! Form::number('price', $item->price, array('placeholder' => 'سعر المنتج','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group last">
                                        <label class="control-label col-md-3">صورة المنتج</label>
                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="{{getimg($item->img)}}" alt="" /> </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> تغير الصورة </span>
                                                                    <span class="fileinput-exists"> تعديل </span>
                                                                    <input type="file" name="img" accept="image/*"> </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group last">
                                        <label class="control-label col-md-3">  صور للمنتج</label>
                                        <div class="col-md-9">
                                            <input type="file" name="images[]" accept="image/*" multiple> </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> القسم</label>
                                        <div class="col-md-6">
                                            {!! Form::select('cat_id', $cats,$item->cat_id, array('placeholder' => 'اختر القسم','class' => 'form-control input-circle','id' => 'cat_id')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> القسم الفرعية</label>
                                        <div class="col-md-6">
                                            <select name="subcat_id" class='form-control input-circle' id ='subcat_id'></select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> الدولة</label>
                                        <div class="col-md-6">
                                    {!! Form::select('country_id', $countries,{{ $item->i }}, array('placeholder' => 'اختر الدولة','class' => 'form-control input-circle','id' => 'country_id')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">المدينة</label>
                                        <div class="col-md-6">
                                            <select name="city_id" class='form-control input-circle' id ='city_id'></select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">حالة المنتج</label>
                                        <div class="col-md-9">
                                            <div class="mt-radio-inline">
                                                <label class="mt-radio">
                                                    <input type="radio" name="Condition" value="new" checked> جديد
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input type="radio" name="Condition" value="used"> مستخدم
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">نوع الاعلان</label>
                                        <div class="col-md-9">
                                            <div class="mt-radio-inline">
                                                <label class="mt-radio">
                                                    <input type="radio" name="type" value="sale" checked> بيع
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input type="radio" name="type" value="buy"> شراء
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">تميز الاعلان</label>
                                        <div class="col-md-9">
                                            <div class="mt-radio-inline">
                                                <label class="mt-radio">
                                                    <input type="radio" name="featured" value="1"> نعم
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input type="radio" name="featured" value="0" checked> لا
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label">وصف المنتج  </label>
                                        <div class="col-md-6">
                                            {!! Form::textarea('desc',  null , array('id'=>'desc','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <hr>
                                    <h3>معلومات صاحب المنتج</h3>

                                    <hr>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label">اسم صاحب المنتج</label>
                                        <div class="col-md-6">
                                            {!! Form::text('auth_name', null, array('placeholder' => 'اسم صاحب المنتج','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">ايميل صاحب المنتج</label>
                                        <div class="col-md-6">
                                            {!! Form::email('auth_email', null, array('placeholder' => 'ايميل صاحب المنتج','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">هاتف صاحب المنتج</label>
                                        <div class="col-md-6">
                                            {!! Form::text('auth_phone', null, array('placeholder' => 'هاتف صاحب المنتج','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">عنوان صاحب المنتج</label>
                                        <div class="col-md-6">
                                            {!! Form::text('auth_address', null, array('placeholder' => 'عنوان صاحب المنتج','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>
                                </div>



                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-circle green"> حفظ التغييرات </button>
                                            <a href="{{route('advertisment.index')}}" class="btn btn-circle grey-salsa btn-outline">الغاء</a>
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
@push('js')
    <script>
        $(function () {
            CKEDITOR.replace('desc');
        })
    </script>
@endpush
