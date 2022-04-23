<?php 
namespace App\Traits\Attachments;

trait HasAttachments 
{
    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment' , 'attachmentable');
    }

    public function uploadAttachments($attachments , $folder_name = '')
    {
        $folder_name = $folder_name ?? 'other' ;
        \Log::debug($folder_name);
        if($attachments && count($attachments) > 0 )
        {
            foreach( $attachments as $attachment )
            {
                $file = $attachment->storeAs($folder_name, $attachment->getClientOriginalName());

                $this->attachments()->create(['path' => $file ]);
            }
        }
    }
}