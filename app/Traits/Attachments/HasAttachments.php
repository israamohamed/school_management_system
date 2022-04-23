<?php 
namespace App\Traits\Attachments;
use Illuminate\Support\Facades\Storage;

trait HasAttachments 
{
    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment' , 'attachmentable');
    }

    public function uploadAttachments($attachments , $folder_name = '')
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
        }

        $this->attachments()->delete();
    }
}