<form>
    <div class="row">
        {{--mother_name_en--}}
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label" for="mother_name_en">{{__('student_parents.mother_name_en')}}</label>
                <input type="text" class="form-control" id="mother_name_en" wire:model = "mother_name_en" placeholder="{{__('student_parents.mother_name_en')}}">
                @error('mother_name_en') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
        {{--mother_name_ar--}}
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label" for="mother_name_ar">{{__('student_parents.mother_name_ar')}}</label>
                <input type="text" class="form-control" id="mother_name_ar" wire:model = "mother_name_ar" placeholder="{{__('student_parents.mother_name_ar')}}">
                @error('mother_name_ar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="row">
        {{--mother_job--}}
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label" for="mother_job">{{__('student_parents.mother_job')}}</label>
                <input type="text" class="form-control" id="mother_job" wire:model = "mother_job" placeholder="{{__('student_parents.mother_job')}}">
                @error('mother_job') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
        {{--mother_address--}}
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label" for="mother_address">{{__('student_parents.mother_address')}}</label>
                <input type="text" class="form-control" id="mother_address" wire:model = "mother_address" placeholder="{{__('student_parents.mother_address')}}">
                @error('mother_address') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="row">
        {{--mother_national_id--}}
        <div class="col-lg-3">
            <div class="mb-3">
                <label class="form-label" for="mother_national_id">{{__('student_parents.mother_national_id')}}</label>
                <input type="text" class="form-control" id="mother_national_id" wire:model = "mother_national_id" placeholder="{{__('student_parents.mother_national_id')}}">
                @error('mother_national_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
        {{--mother_passport_number--}}
        <div class="col-lg-3">
            <div class="mb-3">
                <label class="form-label" for="mother_passport_number">{{__('student_parents.mother_passport_number')}}</label>
                <input type="text" class="form-control" id="mother_passport_number" wire:model = "mother_passport_number" placeholder="{{__('student_parents.mother_passport_number')}}">
                @error('mother_passport_number') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>
         {{--mother_phone_number--}}
         <div class="col-lg-3">
            <div class="mb-3">
                <label class="form-label" for="mother_phone_number">{{__('student_parents.mother_phone_number')}}</label>
                <input type="text" class="form-control" id="mother_phone_number" wire:model = "mother_phone_number" placeholder="{{__('student_parents.mother_phone_number')}}">
                @error('mother_phone_number') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
        </div>

       {{--mother_nationality_id--}}
       <div class="col-lg-3">
        <div class="mb-3">
            <label class="form-label" for="mother_nationality_id">{{__('student_parents.mother_nationality_id')}}</label>
            <select id="mother_nationality_id" class="form-control select2" wire:model = "mother_nationality_id">
                <option value="">{{__('student_parents.select_nationality')}}</option>
                @foreach($nationalities as $nationality)
                    <option value="{{$nationality->id}}">{{$nationality->name}}</option>
                @endforeach
            </select>
            @error('mother_nationality_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
    </div>
  
</div>

<div class="row">
      {{--mother_blood_type_id--}}
      <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label" for="mother_blood_type_id">{{__('student_parents.mother_blood_type_id')}}</label>
            <select id="mother_blood_type_id" class="form-control select2" wire:model = "mother_blood_type_id" >
                <option value="">{{__('student_parents.select_blood_type')}}</option>
                @foreach($blood_types as $blood_type)
                    <option value="{{$blood_type->id}}">{{$blood_type->name}}</option>
                @endforeach
            </select>
            @error('mother_blood_type_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
    </div>

      {{--mother_relision_id--}}
      <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-label" for="mother_relision_id">{{__('student_parents.mother_relision_id')}}</label>
            <select id="mother_relision_id" class="form-control select2" wire:model = "mother_relision_id" >
                <option value="">{{__('student_parents.select_relision')}}</option>
                @foreach($relisions as $relision)
                    <option value="{{$relision->id}}">{{$relision->name}}</option>
                @endforeach
            </select>
            @error('mother_relision_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
    </div>

</div>
  
</form>