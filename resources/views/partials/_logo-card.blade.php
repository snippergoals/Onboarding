<div class="card">
    <div class="card-header">
          <span class="card-title">
           <h4 class="pt-3"><i class="fa fa-check-circle  @if(!is_null($logos) and $logos->is_finished) text-success @else text-black-25 @endif"></i> Logos</h4>
              @if(!is_null($logos))
                  @if(!$logos->is_reviewed)
                      <p>Your logo have been uploaded! Feel free to upload more, any previously uploaded will not be overwritten.</p>
                  @else
                      @if($logos->is_complete)
                          <p>Your logos are approved!</p>
                      @else
                          <p>Your logos are pending review. Feel free to upload more, any previously uploaded will not be overwritten.</p>
                      @endif
                  @endif     
                  @else   
                  <p>Please upload your logo. Include all size and color variations.</p>           
              @endif
          </span>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-12">
                @if(!is_null($logos))
                    @if(!$logos->is_reviewed)
                        <p><span class="fa fa-check text-success"></span>Logos Uploaded</p>
                    @else
                        @if($logos->is_complete)
                            <h5>
                              <span class="btn btn-sm btn-outline-success">
                                <i class="fa fa-check"></i> Logos Accepted
                              </span>
                            </h5>
                        @else
                            <h5>
                              <span class="btn btn-sm btn-outline-warning">
                                <i class="fa fa-times"></i> Logos Need Review
                              </span>
                            </h5>
                        @endif
                        <p><b>Feedback</b>: <span class="font-italic">{{$logos->feedback}}</span></p>
                    @endif
                @endif

                <form method="POST" enctype="multipart/form-data" action="{{route('logos.upload')}}" class="">
                    @if(is_null($logos))
                        <div>
                            <b>You can upload your logo or provide a link to Dropbox, Drive, etc.</b>
                            <br>
                            <input type="radio" id="logotype1" v-model="user.logotype" value="file">
                            <label for="assettype1">Upload Files</label>
                            <input type="radio" id="logotype2" v-model="user.logotype" value="link">
                            <label for="assettype2">Link</label>
                        </div>
                    @endif
                    <br>
                    {{csrf_field()}}
                    <div class="" v-if="user.logotype == 'file'">
                        <div class="custom-file col-md-4">
                            <input type="file" class="custom-file-input"  name="files[]" type="file" multiple id="customFile">
                            <label class="custom-file-label" for="customFile">Choose files</label>
                        </div>
                    </div>
                    <div class="" v-if="user.logotype == 'link'">
                        <label for="link">Alternative link <small>(you can add a link to logos instead of uploading)</small></label>
                        <input class="form-control" type="text" name="link" value="{{$logos->value or ''}}">
                    </div>
                    <input v-if="user.logotype" type="submit" class="btn btn-primary btn-sm mt-2 mb-4" value="Upload Logos">
                </form>
            </div>
        </div>
    </div>
</div>