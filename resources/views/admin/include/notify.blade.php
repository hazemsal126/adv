<ul class="feeds">

    @foreach($items as $item)
    <li>
        <div class="col1">
            <div class="cont">
                <div class="cont-col1">
                    <div class="label label-sm label-warning">
                        <i class="fa fa-bell-o"></i>
                    </div>
                </div>
                <div class="cont-col2">
                    <div class="desc"> {{$item->msg}}.
                        <span class="label label-sm label-default "> ahmed ali </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col2">
            <div class="date"> {{$item->created_at->diffInDays() > 0 ? $item->created_at->diffInDays().' يوم':$item->created_at->diffInHours().' ساعة'}} </div>
        </div>
    </li>
    @endforeach
</ul>
