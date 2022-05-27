<div class="page-bar" style="margin-bottom: 15px">
    <ul class="page-breadcrumb">
      <li>
          <span>لوحة التحكم</span>
          <i class="fa fa-circle"></i>
      </li>
        <li>
            <a href="{{url('admin/home')}}">الصفحة الرئيسية</a>
        </li>
        @if(isset($title))
        <li>
             <i class="fa fa-circle"></i>
            <a href="#">{{$title}}</a>
        </li>
        @endif
    </ul>

</div>
