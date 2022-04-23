<form>
    <div class="row">
        {{--email--}}
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label" for="email">{{__('student_parents.email')}}</label>
                <input type="text" class="form-control" id="email" wire:model = "email" placeholder="{{__('student_parents.email')}}">
                @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
        {{--password--}}
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label" for="password">{{__('student_parents.password')}}</label>
                <input type="password" class="form-control" id="password" wire:model = "password" placeholder="{{__('student_parents.password')}}">
                @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 dropzone">

            <label class="form-label" for="attachments">{{__('general.add_attachments')}}</label>

            <div class="fallback">
                <input wire:model="attachments" id = "attachments" type="file" multiple="multiple">
            </div>
            <div class="dz-message needsclick">
                <div class="mb-3">
                    <i class="display-4 text-muted ri-upload-cloud-2-line"></i>
                </div>
                
            </div>
        </div>

    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="text-center">
                <div class="mb-4">
                    <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                </div>
                <div>
                    <h5>{{__('student_parents.confirm_details')}}</h5>
                    <p class="text-muted">{{__('student_parents.confirm_details_text')}}</p>
                </div>
            </div>
        </div>
    </div>

</form>