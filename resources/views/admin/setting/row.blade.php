<div class="row">
    <div class="col-md-12">
        <div class="tab-pane active" id="tab_0">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>{{ $title }}</div>
                </div>


                <div class="portlet-body form">
                    <form action="{{route('section.update',$item->id)}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        @include('admin.include.tap_lang')
                        <div class="tab-content">
                            <div class="tab-pane active" id="ar">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> العنوان</label>
                                        <div class="col-md-6">
                                            <input name="title" type="text" value="{{$item->title}}" placeholder="العنوان" class="form-control input-circle">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> العنوان الفرعي</label>
                                        <div class="col-md-6">
                                            <input name="subtitle" type="text" value="{{$item->subtitle}}" placeholder="العنوان الفرعي " class="form-control input-circle">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">نص</label>
                                        <div class="col-md-6">
                                            {!! Form::textarea('content',  $item->content , array('id'=>'contentt','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>


                                    <div class="form-group last">
                                        <label class="control-label col-md-3">صورة المحتوى</label>
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
                            </div>
                            <div class="tab-pane" id="en">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> Title</label>
                                        <div class="col-md-6">
                                            {!! Form::text('title_en', $item->title_en, array('placeholder' => ' Title','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">sub title</label>
                                        <div class="col-md-6">
                                            {!! Form::text('subtitle_en', $item->subtitle_en, array('placeholder' => 'Short Content','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">content  </label>
                                        <div class="col-md-6">
                                            {!! Form::textarea('content_en',  $item->content_en , array('id'=>'content_en','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-circle green"> حفظ التغييرات </button>
                                    <a href="{{route('section.index')}}" class="btn btn-circle grey-salsa btn-outline">الغاء</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
