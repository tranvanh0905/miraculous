@if(count($allComment) == 0 || count($allComment) == null )
    <div class="d-flex bg-light border-bottom p-2">
        <p class="font-weight-bold mb-0 font-italic">Bài hát chưa có bình luận nào! Hãy là người đầu tiên bình luận.</p>
    </div>
@else
    @foreach($allComment as $comment)
        <div class="d-flex w-100 bg-light border-bottom p-2">
            <div>
                <img class="rounded-circle" src="{{url($comment->user->avatar)}}" alt="{{$comment->user->username}}">
            </div>
            <div class="pl-e-25 w-100">
                <p class="font-weight-bold font-italic">{{$comment->content}}</p>
                <div class="d-block w-100 text-right">
                    <span class="badge badge-primary font-12">Đăng bởi: {{$comment->user->username}}</span>
                </div>
            </div>
        </div>
    @endforeach
@endif


