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
  </div>


<home :user="user" inline-template>
    <div class="container">
        <!-- Application Dashboard -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                  <div class="card-header">
                    <h4 class="pt-3">{{$user->project_name}} Dashboard</h4>
                  </div>
                  <div class="card-body stats-wrap">
                    {{$user->stats}}
                    <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSMe5cCM6gC5xxcYmbDJRpnRdjFE2jTXjhFWa4BhoubGSyU_4nJ7SJ7tFcT5BAQOugA2oMfOCt2ga1v/pubhtml?gid=0&amp;single=true&amp;widget=true&amp;headers=false"></iframe>
                  </div>
                </div>
            </div>

         </div>
     </div>
</home>
@endsection

