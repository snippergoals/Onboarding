@extends('spark::layouts.app')

@section('content')
  
  
  <div class="container">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('status'))
      @if(is_array(session('status')))
        <div class="alert alert-{{session('status')['type']}} alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          {{ session('status')['text'] }}
        </div>
      @else
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          {{ session('status') }}
        </div>
      @endif
    @endif
  </div>

<!-- Application Dashboard -->
<home :user="user" inline-template>
  <div class="container">
    {{-- @include('partials._video-card') --}}
    <div class="row justify-content-center">
      <div class="col-md-8">
        @include('partials._welcome-message-card')
        @include('partials._prototype-card')
        @include('partials._logo-card')
        @include('partials._asset-card')
        <div style="display: none;">
          @include('partials._payment-card')
        </div>
        @foreach($surveys as $key => $survey)
          @include('partials._survey-card', ['key' => $key, 'survey' => $survey, 'surveyProgress' => $surveyProgress])
        @endforeach
        
        @foreach(config('onboard.services') as $service)
          @include('partials._service-card', ['service' => $service, 'user' => $user])
        @endforeach
      </div>
      <div class="col-md-4">
        @include('partials._progress-sidebar')
      </div>
    </div>
  </div>
</home>

@endsection

