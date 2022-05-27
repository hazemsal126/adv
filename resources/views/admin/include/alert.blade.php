@if(session('message'))
    @if(session('alert-type') == 'success')

        <div class="alert alert-success alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{session('message')}}!</strong>
        </div>
        @else
        <div class="alert alert-danger alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{session('message')}}!</strong>
        </div>

        @endif

@endif