<div class="row justify-content-center">
    <div class="col-12">
        <div class="tile">
            <h5 class="line-head">Profil</h5>
            <form class="m-4 px-4">
                <div class="form-group row line-head py-0">
                    <label for="full_name" class="col-form-label col-md-3">Nama Lengkap</label>
                    <div class="col-md-6">
                        <p class="form-control-plaintext">{{ $user->identity->full_name }}</p>
                    </div>
                </div>
                <div class="form-group row line-head py-0">
                    <label for="mobile_number" class="col-form-label col-md-3">No. HP</label>
                    <div class="col-md-6">
                        <p class="form-control-plaintext">{{ $user->identity->mobile_number }}</p>
                    </div>
                </div>
                <div class="form-group row line-head py-0">
                    <label for="address" class="col-form-label col-md-3">Alamat</label>
                    <div class="col-md-6">
                        <p class="form-control-plaintext">{{ $user->identity->address }}</p>
                    </div>
                </div>
                <div class="form-group row py-0 my-0">
                    <label for="address" class="col-form-label col-md-3"></label>
                    <div class="col-md-9 line-head">
                        <p class="form-control-plaintext">{{ $user->identity->city }}</p>
                    </div>
                </div>
                <div class="form-group row py-0 my-0">
                    <label for="address" class="col-form-label col-md-3"></label>
                    <div class="col-md-9 line-head">
                        <p class="form-control-plaintext">{{ $user->identity->state . ', ' . $user->identity->zip_code }}</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>