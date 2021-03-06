<?php 
namespace App\Traits\Attachments;
use Illuminate\Support\Facades\Storage;

trait HasAttachments 
{
    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment' , 'attachmentable');
    }

    public function uploadAttachments($attachments , $folder_name = '' , $description = '')
    {
        $folder_name = $folder_name ?? 'other' ;
        $description = $description ?? null ;
        $teacher_id  = auth()->guard('teacher')->check() ?  auth()->guard('teacher')->user()->id : null ;

        if($attachments && count($attachments) > 0 )
        {
            foreach( $attachments as $attachment )
            {
                $file = $attachment->storeAs($folder_name, $attachment->getClientOriginalName());

                $this->attachments()->create([
                    'path' => $file , 
                    'description' => $description , 
                    'teacher_id' => $teacher_id 
                ]);
            }
        }
    }

    public function updateAttachments($attachments , $folder_name = '')
    {
        $folder_name = $folder_name ?? 'other' ;
        
        if($attachments && count($attachments) > 0 )
        {
            foreach( $attachments as $attachment )
            {
                $file = $attachment->storeAs($folder_name, $attachment->getClientOriginalName());

                $this->attachments()->create(['path' => $file ]);
            }
        }
    }

    public function deleteAttachments()
    {
        if($this->attachments && count($this->attachments) > 0 )
        {
            foreach($this->attachments as $attachment)
            {
                Storage::delete($attachment->path);
            }

            $this->attachments()->delete();
        }

        
    }

    public function uploadImage( $file , $folder_name , $type )
    {
        $folder_name = $folder_name ?? 'other' ;

        if($file)
        {
            $image = $file->store($folder_name);

            $this->attachments()->create(['path' => $image , 'type' => $type ]);            
        }
    }

    public function updateImage( $file , $folder_name , $type)
    {
        $folder_name = $folder_name ?? 'other' ;

        if($file)
        {
            //Delete Old Image
            $old_image = $this->attachments()->where('type' , $type)->first();

            if($old_image)
            {
                Storage::delete($old_image->path);
                $this->attachments()->where('type' , $type)->delete();
            }


            $image = $file->store($folder_name);

            $this->attachments()->create([
                'path' => $image ,
                'type' => $type
            ]);
            
        }
    }

    public function getProfilePictureAttribute()
    {
        $image = $this->attachments()->where('type' , 'profile_picture')->first();

        return $image ? asset('uploads/' . $image->path) : asset('images/default_user.png');
    }

    public function getLogoAttribute()
    {
        $image = $this->attachments()->where('type' , 'logo')->first();

        return $image ? asset('uploads/' . $image->path) : asset('images/logo.png');
    }

    public function getMainAttachmentsAttribute()
    {
        return $this->attachments()->whereNull('type')->get();
    }

}