<div class="row justify-content-center">
    <div class="col-12">
        <div class="tile">
            <h5 class="line-head">
                Member
                @if ($user->member->is_verified)
                    <span class="text-success ml-4">
                        <i class="fas fa-check"></i> Sudah Verifikasi
                    </span>
                    <span class="ml-4">Verifikasi tanggal {{ $user->member->verified_at }}</span>
                @else
                    <span class="text-warning ml-4">
                        <i class="fas fa-exclamation-triangle"></i> Belum Verifikasi
                    </span>
                @endif
            </h5>
            <form class="m-4 px-4">
                <div class="form-group row line-head py-0">
                    <label for="member_type" class="col-form-label col-md-3">Status Member</label>
                    <div class="col-md-6">
                        <p class="form-control-plaintext">
                            {{ !is_null($user->member->member_type) ? $user->member->member_type->member_type_name : '' }}
                        </p>
                    </div>
                </div>
                <div class="form-group row line-head py-0">
                    <label for="full_name" class="col-form-label col-md-3">Tanggal Registrasi</label>
                    <div class="col-md-6">
                        <p class="form-control-plaintext">{{ $user->member->registration_date }}</p>
                    </div>
                </div>
                <div class="form-group row line-head py-0">
                    <label for="current_point" class="col-form-label col-md-3">Sisa Poin</label>
                    <div class="col-md-6">
                        <p class="form-control-plaintext">{{ $user->member->current_point }}</p>
                    </div>
                </div>
                <div class="form-group row line-head py-0">
                    <label for="member_code" class="col-form-label col-md-3">Kode Referral anda</label>
                    <div class="col-md-6">
                        <p class="form-control-plaintext">{{ $user->member->referral_code }}</p>
                        <small class="text-danger"><em>Gunakan kode referral anda untuk mendapatkan point tambahan</em></small>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>