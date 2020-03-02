<div class="card">
    <div class="card-header">
      <span class="card-title">
       <h4 class="pt-3"><i class="fa fa-check-circle  @if(!is_null($user->keybase)) text-success @else text-black-25 @endif"></i> Payment Info</h4>
      </span>
      @if(is_null($user->keybase))
        <p class="card-text">Please enter your credit card information that you want us to use for your Facebook ads.</p>  
        <p class="card-text">Information Security is our highest concern.</p>
        <p class="card-text">To store and view this information we use asymmetric cryptography. Asymmetric cryptography uses a keypair, a public key and a private key. Only LaunchBoom has the private key to this information, keeping it safe. Once your credit card is added to our Facebook Ad Account, the encrypted text is destroyed to make sure it can not be compromised at a later date.</p>
      @endif
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              @if(is_null($user->keybase))
                <form method="POST" enctype="multipart/form-data" action="{{route('keybase')}}" >
                  <textarea name="keybase" id="keybase" cols="30" rows="10" class="form-control">{{old('keybase',isset($user->keybase)?$user->keybase:'')}}</textarea>
                    {{csrf_field()}}
                    <input type="submit" class="btn btn-primary btn-sm mt-2 mb-4" value="Encrypt Data">
                </form>
              @else
                <p>Thank you. You information has been encrypted.</p>
              @endif
            </div>
        </div>
    </div>
</div>