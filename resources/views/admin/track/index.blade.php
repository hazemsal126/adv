@extends('admin.layout.index')


@section('content')

    <div class="page-content">
        @include('admin.layout.breadcrumb',['title' => 'لوحة المقاطع'])

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">لوحة المقاطع</span>
                        </div>
                        <div class="tools">
                            @include('admin.include.add-btn',['route'=> route('track.create',['album_id'=>request('album_id')])])
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{route('track.index')}}" method="get" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="col-lg-3">
                                        {!! Form::text('title',request('title'), array('placeholder' => 'العنوان','class' => 'form-control')) !!}
                                    </div>
                                    <div class="col-lg-3">
                                        {!! Form::select('album_id',$albums,request('album_id'), array('placeholder' => 'اختر الألبوم','class' => 'form-control')) !!}
                                    </div>
                                    <div class="col-lg-3">
                                        {!! Form::select('file_type',['video'=>'فيديو','audio'=>'صوت'],request('file_type'), array('placeholder' => 'اختر نوع المقطع','class' => 'form-control')) !!}
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-default">بحث</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <br>
                        <table class="table table-striped table-bordered table-hover" id="sample_5">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th>  العنوان </th>
                                <th width="25%">  الصورة </th>
                                <th> صناع المحتوى </th>
                                <th>   نشط/غير نشط </th>
                                <th>   متميز </th>
                                <th> النوع </th>
                                <th> العمليات </th>

                            </tr>
                            </thead>
                            <tbody>
                            @php($i=0)
                            @foreach($items as $item)

                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $item->title }}</td>
                                    <td><img src="{{getimg($item->img)}}" style="width: 20%;"></td>

                                    <td> @foreach($item->artists as $artist) {{ $artist->artist ?  $artist->artist->username . '-':'-' }} @endforeach </td>

                                    <td> <a data-toggle="modal" data-target="#confirm-active{{$item->id}}"><span class="{{$item->active == 1 ? 'status-ok' :'status-not-ok'  }}"></span> </a></td>
                                    <td> <a data-toggle="modal" data-target="#confirm-featured{{$item->id}}"><span class="{{$item->featured == 1 ? 'status-ok' :'status-not-ok'  }}"></span></a> </td>
                                    <td>{{ substr($item->file_type,0,5) }} </td>
                                    <td>
                                        <a class="btn dark btn-flat btn-xs video-btn" data-toggle="modal" data-target="#confirm-video"
                                        data-src='{{ getfile($item->file,'video') }}' data-type='{{ $item->file_type }}'>تشغيل</a>

                                        @can('track-edit')
                                            <a href="{{ route('track.edit',$item->id) }}" class="btn btn-warning btn-flat btn-xs">تعديل</a>
                                        @endcan
                                        @can('track-destroy')
                                            <a class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#confirm-delete{{$item->id}}" >حذف</a>
                                        @endcan


                                    </td>
                                </tr>
                                <div id="confirm-delete{{$item->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">حذف</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>هل تريد بالتأكيد الحذف</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
                                                {!! Form::open(['method' => 'DELETE','route' => ['track.destroy', $item->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('نعم', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="confirm-active{{$item->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">الغاء التفعيل</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p> هل تريد بالتأكيد تغير الحالة </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                                {!! Form::open(['method' => 'post','route' => ['track.active', $item->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('نعم', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="confirm-featured{{$item->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">الغاء التفعيل</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p> هل تريد بالتأكيد تغير الحالة </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                                {!! Form::open(['method' => 'post','route' => ['track.featured', $item->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('نعم', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            </tbody>

                        </table>

                        <div id="confirm-video" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">تشغيل المقطع</h4>
                                    </div>
                                    <div id="video-src" class="modal-body">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @include('admin.include.paginator', ['paginator' => $items])

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
<script>
    $(document).ready(function(){
    var videosrc;
    var videotype;
    $('.video-btn').on('click',function(){
        videosrc=$(this).data('src');
        videotype=$(this).data('type');
    });

    $('#confirm-video').on('shown.bs.modal',function(e){
        setTimeout(() => {
            if(videotype.substr(0,5) === 'audio'){
                            $('#video-src').html(`<audio width="360" height="250" style="margin-right: 19%;" controls>
                            <source src="${videosrc}" type="${videotype}">
                            </audio>`)
            }
            else{
        $('#video-src').html(`<video width="360" height="250" style="margin-right: 19%;" controls>
                <source src="${videosrc}" type="${videotype}">
            </video>`)
        }
        }, 500);



    })

    $('#confirm-video').on('hide.bs.modal',function(e){
        $('#video-src').html(' ');
    })
    })

</script>

@endpush
