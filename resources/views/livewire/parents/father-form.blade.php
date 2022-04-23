<form>
    <div class="row">
        {{--father_name_en--}}
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label" for="father_name_en">{{__('student_parents.father_name_en')}} <span class = "text-danger">*</span></label>
                <input type="text" class="form-control" id="father_name_en" wire:model = "father_name_en" placeholder="{{__('student_parents.father_name_en')}}">
                @error('father_name_en') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
        {{--father_name_ar--}}
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label" for="father_name_ar">{{__('student_parents.father_name_ar')}}</label>
                <input type="text" class="form-control" id="father_name_ar" wire:model = "father_name_ar" placeholder="{{__('student_parents.father_name_ar')}}">
                @error('father_name_ar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="row">
        {{--father_job--}}
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label" for="father_job">{{__('student_parents.father_job')}}</label>
                <input type="text" class="form-control" id="father_job" wire:model = "father_job" placeholder="{{__('student_parents.father_job')}}">
                @error('father_job') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
        {{--father_address--}}
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label" for="father_address">{{__('student_parents.father_address')}}</label>
                <input type="text" class="form-control" id="father_address" wire:model = "father_address" placeholder="{{__('student_parents.father_address')}}">
                @error('father_address') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="row">
        {{--father_national_id--}}
        <div class="col-lg-3">
            <div class="mb-3">
                <label class="form-label" for="father_national_id">{{__('student_parents.father_national_id')}}</label>
                <input type="text" class="form-control" id="father_national_id" wire:model = "father_national_id" placeholder="{{__('student_parents.father_national_id')}}">
                @error('father_national_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
        {{--father_passport_number--}}
        <div class="col-lg-3">
            <div class="mb-3">
                <label class="form-label" for="father_passport_number">{{__('student_parents.father_passport_number')}}</label>
                <input type="text" class="form-control" id="father_passport_number" wire:model = "father_passport_number" placeholder="{{__('student_parents.father_passport_number')}}">
                @error('father_passport_number') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
         {{--father_phone_number--}}
         <div class="col-lg-3">
            <div class="mb-3">
                <label class="form-label" for="father_phone_number">{{__('student_parents.father_phone_number')}}</label>
                <input type="text" class="form-control" id="father_phone_number" wire:model = "father_phone_number" placeholder="{{__('student_parents.father_phone_number')}}">
                @error('father_phone_number') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>

       {{--father_nationality_id--}}
       <div class="col-lg-3">
        <div class="mb-3">
            <label class="form-label" for="father_nationality_id">{{__('student_parents.father_nationality_id')}}</label>
            <select id="father_nationality_id" class="form-control select2" wire:model = "father_nationality_id">
                <option value="">{{__('student_parents.select_nationality')}}</option>
                @foreach($nationalities as $nationality)
                    <option value="{{$nationality->id}}">{{$nationality->name}}</option>
                @endforeach
            </select>
            @error('father_nationality_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
    </div>
  
</div>

<div class="row">
      {{--father_blood_type_id--}}
      <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label" for="father_blood_type_id">{{__('student_parents.father_blood_type_id')}}</label>
            <select id="father_blood_type_id" class="form-control select2" wire:model = "father_blood_type_id" >
                <option value="">{{__('student_parents.select_blood_type')}}</option>
                @foreach($blood_types as $blood_type)
                    <option value="{{$blood_type->id}}">{{$blood_type->name}}</option>
                @endforeach
            </select>
            @error('father_blood_type_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
    </div>

      {{--father_relision_id--}}
      <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label" for="father_relision_id">{{__('student_parents.father_relision_id')}}</label>
            <select id="father_relision_id" class="form-control select2" wire:model = "father_relision_id" >
                <option value="">{{__('student_parents.select_relision')}}</option>
                @foreach($relisions as $relision)
                    <option value="{{$relision->id}}">{{$relision->name}}</option>
                @endforeach
            </select>
            @error('father_relision_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
    </div>

</div>
  
</form>