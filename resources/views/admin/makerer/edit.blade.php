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
                                <i class="fa fa-gift"></i>تعديل بيانات المستخدم</div>

                        </div>


                        <div class="portlet-body form">
                            <form action="{{route('makerer.update',$customer->id)}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="put">
                                <div class="form-body">

                                    <h3 class="form-section">معلومات عامة</h3>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">الاسم </label>
                                        <div class="col-md-4">
                                        {!! Form::text('name', $customer->name, array('placeholder' => 'الاسم','class' => 'form-control input-circle')) !!}                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">اسم المستخدم </label>
                                        <div class="col-md-4">
                                        {!! Form::text('username', $customer->username, array('placeholder' => 'اسم المستخدم','class' => 'form-control input-circle')) !!}                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">الايميل</label>
                                        <div class="col-md-4">
                                            {!! Form::email('email', $customer->email, array('placeholder' => 'Email','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">رقم الهاتف</label>
                                        <div class="col-md-4">
                                        {!! Form::number('phone', $customer->phone, array('placeholder' => 'phone','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">كلمة المرور</label>
                                        <div class="col-md-4">
                                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">تأكيد كلمة المرور</label>
                                        <div class="col-md-4">
                                        {!! Form::password('password_confirmation', array('placeholder' => 'Confirm Password','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">تعريف شخصي (pio)</label>
                                        <div class="col-md-4">
                                        {!! Form::textarea('pio', $customer->pio, array('class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> الفئات</label>
                                        <div class="col-md-6">
                                            <select id="multiple" name="cat[]" class="form-control select2-multiple" multiple>
                                                @foreach ($cats as $cat)
                                                        <option value="{{ $cat->id }}" @if($customer->cats->where('cat_id',$cat->id)->first()) selected @endif>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">صانع محتوى ام تابع</label>
                                        <div class="col-md-9">
                                            <div class="mt-radio-inline">
                                                <label class="mt-radio">
                                                    <input type="radio" name="artist" class="artist" value="1" @if($customer->artist == 1) checked @endif> صانع
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input type="radio" name="artist" class="artist" value="0" @if($customer->artist == 0) checked @endif> تابع
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="artist_parent"  @if($customer->artist == 1) style="display: none;" @endif>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">تابع لصانع محتوى:</label>
                                            <div class="col-md-4">
                                            {!! Form::select('artist_parent_id', $artist,$customer->artist_parent_id, array('placeholder' => 'اختار تابع لاي صانع','class' => 'form-control input-circle')) !!}
                                            </div>
                                        </div>
                                    </div>


                                <div class="form-group last">
                                    <label class="control-label col-md-3">صورة شخصية</label>
                                    <div class="col-md-9">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="{{getimg($customer->img)}}" alt="" /> </div>
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

                                    <h3 class="form-section">حسابات التواصل الاجتماعي</h3>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label">حساب الفيس بوك</label>
                                        <div class="col-md-4">
                                        {!! Form::text('facebook', $customer->facebook, array('placeholder' => 'حساب الفيس بوك','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">واتس اب</label>
                                        <div class="col-md-4">
                                        {!! Form::text('whatsapp', $customer->whatsapp, array('placeholder' => 'واتس اب','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">حساب تويتر</label>
                                        <div class="col-md-4">
                                        {!! Form::text('twitter', $customer->twitter, array('placeholder' => 'حساب تويتر','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">حساب انستجرام</label>
                                        <div class="col-md-4">
                                        {!! Form::text('instagram', $customer->instagram, array('placeholder' => 'حساب انستجرام','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">حساب سناب شات</label>
                                        <div class="col-md-4">
                                        {!! Form::text('snapshat', $customer->snapshat, array('placeholder' => 'حساب سناب شات','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">حساب تلجرام</label>
                                        <div class="col-md-4">
                                        {!! Form::text('telegram', $customer->telegram, array('placeholder' => 'حساب تلجرام','class' => 'form-control input-circle')) !!}
                                        </div>
                                    </div>


                            </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-circle green"> حفظ التغييرات </button>
                                            <a href="{{route('makerer.index')}}" class="btn btn-circle grey-salsa btn-outline">الغاء</a>
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
$('.artist').on('change',function(){
    var val=$(this).val();
    if(val == '0'){
        $('.artist_parent').fadeIn();
    }
    else{
        $('.artist_parent').fadeOut();

    }
})

</script>

@endpush
