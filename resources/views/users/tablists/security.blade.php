<div class="row justify-content-center">
    <div class="col-12">
        <div class="tile">
            <h5 class="line-head">Account</h5>
            <form method="POST" id="change-password" class="m-4 px-4">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group row line-head py-0">
                    <label for="emailfield" class="col-form-label col-md-3">Email Address</label>
                    <div class="col-md-6">
                        <input type="text" name="email" id="emailfield" class="form-control-plaintext" value="{{ $user->email }}" autocomplete="username">
                    </div>
                </div>
                <div class="form-group row line-head py-0">
                    <label for="old_password" class="col-form-label col-md-3">Password Lama</label>
                    <div class="col-md-6">
                        <input type="password" name="old_password" id="old_password" class="form-control {{ $errors->has('old_password') ? 'is-invalid' : '' }}" required autocomplete="current-password">
                        @if ($errors->has('old_password'))
                            <div class="invalid-feedback">{{ $errors->first('old_password') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row line-head py-0">
                    <label for="password" class="col-form-label col-md-3">Password Baru</label>
                    <div class="col-md-6">
                        <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" required autocomplete="new-password">
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row line-head py-0">
                    <label for="password_confirmation" class="col-form-label col-md-3">Konfirmasi Password</label>
                    <div class="col-md-6">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" required autocomplete="new-password">
                        @if ($errors->has('password_confirmation'))
                            <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" id="btn-save" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
