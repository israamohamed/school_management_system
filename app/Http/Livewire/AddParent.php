<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Relision;
use App\Models\StudentParent;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class AddParent extends Component
{
    use WithFileUploads;

    public $attachments = [];

    public $student_parent_id, $email ,$password ,$father_name_en, $father_name_ar ,$father_national_id , $father_passport_number ,$father_phone_number ,$father_job , 
           $father_blood_type_id ,$father_nationality_id ,$father_relision_id ,$father_address,$mother_name_en, $mother_name_ar ,$mother_national_id , 
           $mother_passport_number ,$mother_phone_number ,$mother_job , $mother_blood_type_id ,$mother_nationality_id ,$mother_relision_id ,
           $mother_address; 

    public $current_step = 1;

    public $success_message , $error_message , $update_mode = false;

    public $father_rules , $mother_rules , $login_rules , $rules;
    

    public function mount($student_parent = null)
    {
        if($student_parent)
        {
            $this->update_mode = true;
            $this->student_parent_id = $student_parent->id;
            $this->email = $student_parent->email;
            //$this->password = $student_parent->password;
            $this->father_name_en = $student_parent->getTranslation('father_name', 'en');
            $this->father_name_ar = $student_parent->getTranslation('father_name', 'ar');
            $this->father_national_id = $student_parent->father_national_id;
            $this->father_passport_number = $student_parent->father_passport_number;
            $this->father_phone_number = $student_parent->father_phone_number;
            $this->father_job = $student_parent->father_job;
            $this->father_blood_type_id = $student_parent->father_blood_type_id;
            $this->father_nationality_id = $student_parent->father_nationality_id;
            $this->father_relision_id = $student_parent->father_relision_id;
            $this->father_address = $student_parent->father_address;
            
            $this->mother_name_en = $student_parent->getTranslation('mother_name', 'en');
            $this->mother_name_ar = $student_parent->getTranslation('mother_name', 'ar');
            $this->mother_national_id = $student_parent->mother_national_id;
            $this->mother_passport_number = $student_parent->mother_passport_number;
            $this->mother_phone_number = $student_parent->mother_phone_number;
            $this->mother_job = $student_parent->mother_job;
            $this->mother_blood_type_id = $student_parent->mother_blood_type_id;
            $this->mother_nationality_id = $student_parent->mother_nationality_id;
            $this->mother_relision_id = $student_parent->mother_relision_id;
            $this->mother_address = $student_parent->mother_address;
        }
      

        //Insilizae rules 
        $this->father_rules = [
            'father_name_en'         => 'required|max:100',
            'father_name_ar'         => 'required|max:100',
            'father_national_id'     => 'required|unique:student_parents,father_national_id,' . $this->student_parent_id,
            'father_passport_number' => 'nullable|unique:student_parents,father_passport_number,' . $this->student_parent_id,
            'father_phone_number'    => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'father_job'             => 'required|max:255',
            'father_blood_type_id'   => 'required|exists:blood_types,id',
            'father_nationality_id'  => 'required|exists:nationalities,id',
            'father_relision_id'     => 'required|exists:relisions,id',
            'father_address'         => 'required',  
        ];
    
        $this->mother_rules = [
            'mother_name_en'         => 'required|max:100',
            'mother_name_ar'         => 'required|max:100',
            'mother_national_id'     => 'required|unique:student_parents,mother_national_id,' . $this->student_parent_id,
            'mother_passport_number' => 'nullable|unique:student_parents,mother_passport_number,' . $this->student_parent_id,
            'mother_phone_number'    => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_job'             => 'required|max:255',
            'mother_blood_type_id'   => 'required|exists:blood_types,id',
            'mother_nationality_id'  => 'required|exists:nationalities,id',
            'mother_relision_id'     => 'required|exists:relisions,id',
            'mother_address'         => 'required',  
        ];
    
        $this->login_rules = [
            'email'    => 'required|email|unique:student_parents,email,' . $this->student_parent_id,
            //'password' => 'required_if|min:6',
            'password' => $this->update_mode ? 'nullable|min:6' : 'required|min:6',
        ];
    
        $this->rules = [
            'father_national_id'     => 'required|unique:student_parents,father_national_id,' . $this->student_parent_id . '|regex:/[0-9]{9}/',
            'father_passport_number' => 'nullable|unique:student_parents,father_passport_number,' . $this->student_parent_id,
            'father_phone_number'    => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_national_id'     => 'required|unique:student_parents,mother_national_id,' . $this->student_parent_id . '|regex:/[0-9]{9}/',
            'mother_passport_number' => 'nullable|unique:student_parents,mother_passport_number,' . $this->student_parent_id,
            'mother_phone_number'    => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ];
    }

    public function first_step_submit() //father form
    {
        $this->validate($this->father_rules);

        $this->current_step = 2;
    }

    public function second_step_submit() //mother form
    {
        $this->validate($this->mother_rules);

        $this->current_step = 3;
    }

    public function third_step_submit() //email , password , confirm form
    {
        $this->validate($this->login_rules);

        $this->submit_form();
    }

    public function submit_form()
    {
        try {
            // 1 - validation
            $rules = array_merge($this->father_rules , $this->mother_rules , $this->login_rules);
            
            $data = $this->validate($rules);
            
            $father_name_rule = ['father_name' => [
                    'en' => $this->father_name_en,
                    'ar' => $this->father_name_ar
            ]];

            $mother_name_rule = ['mother_name' => [
                'en' => $this->mother_name_en,
                'ar' => $this->mother_name_ar
            ]];

            $data = array_merge($data , $father_name_rule , $mother_name_rule);
            //if not password exist, remove it from validation
            if(!$this->password)
            {
                unset($data['password']);
            }

            //2 check if update mode is on
            if($this->update_mode) //update
            {
                //3 - update the data
                $parent = StudentParent::findOrFail($this->student_parent_id);
                $parent->update($data);
                //4 - update attachments
                $parent->updateAttachments($this->attachments , 'student_parents/' . $this->father_national_id);
                //5 - success message
                $this->success_message = __('student_parents.updated_successfully');
                //6 - success message wit toastr
                toastr()->success(__('student_parents.updated_successfully'));
                //6 - redirect to list of parents list
                return redirect()->route('dashboard.student_parent.index');
                
            }
            else //create
            {
                //3 - store data in db
                $parent = StudentParent::create($data);
                //4 - upload attachments
                $parent->uploadAttachments($this->attachments , 'student_parents/' . $this->father_national_id);
                //5 - success message
                $this->success_message = __('student_parents.added_successfully');
            }
          
            //6 - clear form
            $this->clear_form();  
            //7 - back to step 1
            $this->current_step = 1; 
        }

        catch( \Exception $e) {
            $this->error_message = $e->getMessage();
        }
           
    }

    public function next()
    {
        if($this->current_step == 1)
        {
            $this->first_step_submit();
        }
        else if($this->current_step == 2)
        {
            $this->second_step_submit();
        }
        else if($this->current_step == 3)
        {
            $this->third_step_submit();
        }
    }

    public function back()
    {
        if($this->current_step != 1)
        {
            $this->current_step--;
        }    
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName , $this->rules);
    }

    public function clear_form()
    {
        $this->email = '';
        $this->password = '';
        $this->father_name_en = '';
        $this->father_name_ar = '';
        $this->father_national_id = '';
        $this->father_passport_number = '';
        $this->father_phone_number = '';
        $this->father_job = '';
        $this->father_blood_type_id = '';
        $this->father_nationality_id = '';
        $this->father_relision_id = '';
        $this->father_address = '';
        
        $this->mother_name_en = '';
        $this->mother_name_ar = '';
        $this->mother_national_id = '';
        $this->mother_passport_number = '';
        $this->mother_phone_number = '';
        $this->mother_job = '';
        $this->mother_blood_type_id = '';
        $this->mother_nationality_id = '';
        $this->mother_relision_id = '';
        $this->mother_address = '';
        $this->attachments = [];
        $this->error_message = '';

    }

    
    
    public function render()
    {
        $blood_types = BloodType::get();
        $nationalities = Nationality::get();
        $relisions = Relision::get();
        return view('livewire.add-parent' , compact('blood_types' , 'nationalities' , 'relisions'));
    }
}
