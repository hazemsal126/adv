@extends('admin.layout.index')


@section('content')

    <div class="page-content">
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="{{ route('setting.index') }}" > بيانات الموقع </a>
                </li>
                <li class="">
                    <a href="{{ route('section.edit',2) }}"> من نحن </a>
                </li>
                <li class="">
                    <a href="{{ route('section.edit',1) }}"> سياسة الخصوصية </a>
                </li>
                <li class="">
                    <a href="{{ route('section.edit',3) }}"> الشروط والأحكام </a>
                </li>

            </ul>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tab-pane active" id="tab_0">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>بيانات الموقع</div>

                        </div>


                        <div class="portlet-body form">
                            <form action="{{route('setting.update')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="put">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">الايميل</label>
                                        <div class="col-md-4">
                                            <input type="email" class="form-control input-circle" value="{{$item->email}}" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">رقم الهاتف</label>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control input-circle" value="{{$item->phone}}" name="phone">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">فيس بوك</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control input-circle" value="{{$item->facebook}}" name="facebook">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">انستجرام</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control input-circle" value="{{$item->instagram}}" name="instagram">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">واتس اب</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control input-circle" value="{{$item->whatsapp}}" name="whatsapp">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">سناب شوت</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control input-circle" value="{{$item->snapchat}}" name="snapchat">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">تويتر</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control input-circle" value="{{$item->twitter}}" name="twitter">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">نص تعريفي في الفوتر</label>
                                        <div class="col-md-4">
                                            <textarea class="form-control input-circle" name="footter">{{$item->footter}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group last">
                                        <label class="control-label col-md-3">صورة اللوجو</label>
                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="{{getimg($item->logo)}}" alt="" /> </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> تغير الصورة </span>
                                                                    <span class="fileinput-exists"> تعديل </span>
                                                                    <input type="file" name="logo"> </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group last">
                                        <label class="control-label col-md-3">شعار تاب الموقع</label>
                                        <div class="col-md-4">
                                            <input type="file" class="form-control input-circle" name="favicon">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-circle green"> حفظ التغييرات </button>
                                            <button type="button" class="btn btn-circle grey-salsa btn-outline">الغاء</button>
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

