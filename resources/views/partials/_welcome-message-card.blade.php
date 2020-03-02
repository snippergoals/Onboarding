<div class="card card-default">
  <div class="card-header">
    <h4 class="pt-3">Hey {{$user->name}},</h4>
    @if (empty($user->message))
      <p>We are excited to start working with you! There are a few things that your Campaign Strategist needs to get going. If you have any questions feel free to chat with an Onboarding Specialist through the support channel. </p>
    @else
      <p class="font-italic">{{ $user->message }}</p>
    @endif
  </div>
  @if(is_null($user->video_view))
    <div class="card-body">
      <div class="row">
        <h4 class="float-left col-md-6">&nbsp;</h4>
        <div class="float-right col-md-6 text-align-right">
          <a href="{{route('close_video', $user)}}" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </a>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe src="https://player.vimeo.com/video/318313707?title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-md-6">
          <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe src="https://player.vimeo.com/video/318529144?title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>