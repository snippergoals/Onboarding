@if(is_null($user->video_view))
  <div class="card card-default pb-4">
    <div class="card-header">
      <div class="row">
        <h4 class="float-left col-md-6 pl-3">&nbsp;</h4>
        <div class="float-right col-md-6 text-align-right">
          <a href="{{route('close_video', $user)}}" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </a>
        </div>
      </div>
      <div class="row justify-content-center pl-4 pr-4">
        <div class="col-md-6 pl-4 pr-4">
          <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe src="https://player.vimeo.com/video/318313707?title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-md-6 pl-4 pr-4">
          <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe src="https://player.vimeo.com/video/318529144?title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          </div>
        </div>
      </div>
      
      <script src="https://player.vimeo.com/api/player.js"></script>
    </div>
  </div>
@endif