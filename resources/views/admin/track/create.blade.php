@extends('admin.layout.index')

@push('css')
    <style>
        .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; height: 33px; }
        .bar { background-color: #B4F5B4; width:0%; height:28px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
    </style>
    @endpush
@section('content')

    <div class="page-content">
        @include('admin.include.alert')

        <div class="row">
            <div class="col-md-12">
                <div class="tab-pane active" id="tab_0">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>إضافة مقطع</div>
                        </div>


                        <div class="portlet-body form">
                            <form action="{{route('track.store')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                @include('admin.include.tap_lang')

                                <div class="tab-content">
                                    <div class="tab-pane active" id="ar">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">العنوان</label>
                                                <div class="col-md-6">
                                                    {!! Form::text('title', null, array('placeholder' => 'العنوان','class' => 'form-control input-circle')) !!}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">وصف المقطع  </label>
                                                <div class="col-md-6">
                                                    {!! Form::textarea('desc',  null , array('id'=>'desc','class' => 'form-control input-circle')) !!}
                                                </div>
                                            </div>

                                            <div class="form-group last">
                                                <label class="control-label col-md-3">صورة المقطع</label>
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

                                            <div class="form-group">
                                                <label class="col-md-3 control-label"> الألبوم</label>
                                                <div class="col-md-6">
                                                    {!! Form::select('album_id',$albums,null, array('placeholder' => 'اختر الألبوم','class' => 'form-control')) !!}

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label"> الفئات</label>
                                                <div class="col-md-6">
                                                    <select id="multiple" name="cat[]" class="form-control select2-multiple cat_mutiple" multiple>
                                                        @foreach ($cats as $cat)
                                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label"> الفئات الفرعية</label>
                                                <div class="col-md-6">
                                                    <select id="multiple" name="subcat[]" class="form-control select2-multiple subcat_muliple" multiple>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label"> صناع المحتوى</label>
                                                <div class="col-md-6">
                                                    <select id="multiple" name="artist[]" class="form-control select2-multiple" multiple>
                                                       @foreach ($artists as $artist)
                                                            <option value="{{ $artist->id }}">{{ $artist->username }}</option>
                                                       @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">المقطع</label>

                                                    <div class="col-md-6">
                                                    <input type="file" name="video" accept="video/*,audio/*" />
                                                    </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="en">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Title</label>
                                                <div class="col-md-6">
                                                    {!! Form::text('title_en', null, array('placeholder' => 'Title en','class' => 'form-control input-circle')) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Description  </label>
                                            <div class="col-md-6">
                                                {!! Form::textarea('desc_en',  null, array('id'=>'desc_en','class' => 'form-control input-circle')) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="progress">
                                        <div class="bar"></div >
                                        <div class="percent">0%</div >
                                    </div>

                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-circle green nextBtns"> حفظ التغييرات </button>
                                            <a href="{{route('track.index')}}" class="btn btn-circle grey-salsa btn-outline">الغاء</a>
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
            CKEDITOR.replace('desc_en');
        })
    </script>

<script src="{{ asset('assets/apps/scripts/formajax.js') }}" type="text/javascript"></script>


    <script type="text/javascript">

        (function() {

            var bar = $('.bar');
            var percent = $('.percent');

            $('form').ajaxForm({
                beforeSend: function() {
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                    $(".nextBtns").attr('disabled','disabled');
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                    if (percentComplete == 100){
                        percentVal = 'لحظة من فضلك, يتم الآن حفظ البيانات';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    }
                },
                success: function(data) {
                    var percentVal = 'Wait, Saving';
                    bar.width(percentVal)
                    percent.html(percentVal);

                    //console.log(data);
                    //toastr.info(data);
                    location.reload();
                },
                complete: function(xhr) {
                    toastr.info(xhr.responseJSON.message);
                    $(".nextBtns").removeAttr('disabled');
                    //alert('اكتمل التحميل');
                    //location.reload();
                }
            });

        })();

        (function() {
            $('.cat_mutiple').on('change',function(){
                var cats=$(this).val();
                $.post(
                    '{{ route('album.subcat') }}',
                    {
                        'cats': cats,
                        '_token' : '{{ csrf_token() }}'
                    },
                    function(data){
                        $('.subcat_muliple').html(data.data);
                    })
            });

        })();

    </script>
@endpush

