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
                                <i class="fa fa-gift"></i>تعديل بيانات القسم</div>
                        </div>


                        <div class="portlet-body form">
                            <form action="{{route('sub_category.update',$item->id)}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="put">

                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">اسم القسم</label>
                                        <div class="col-md-6">
                                            {!! Form::text('name', $item->name, array('placeholder' => 'اسم القسم','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group last">
                                        <label class="control-label col-md-3">صورة القسم</label>
                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="{{getimg($item->img)}}" alt="" /> </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> تغير الصورة </span>
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
                                            <a href="{{route('sub_category.index',['id'=>$item->cat_id])}}" class="btn btn-circle grey-salsa btn-outline">الغاء</a>
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
