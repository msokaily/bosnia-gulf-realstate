<?php

namespace App\Livewire;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

use Livewire\WithFileUploads;

class UploadFile extends Component
{
    use WithFileUploads;

    public $fileId;
    public $file;
    public $multiple = 0;
    public $type = 'image';
    public $preview;
    public $fileSize;
    public $input;
    public $result_to_event;
    public $thumbnailWidth = 0;
    public $thumbnailHeight = 0;

    public function updatedFile()
    {
        $videoExtensions = ['mp4','ogx','oga','ogv','ogg','webm','avi','3gp'];
        if ($this->multiple) {
            $fileTypeValidate = $this->type;
            if ($this->type == 'video') {
                $fileTypeValidate = 'mimes:'.implode(',', $videoExtensions);
            } else if ($this->type == 'media') {
                $fileTypeValidate = '';
            }
            $this->validate([
                'file.*' => $fileTypeValidate . '|max:' . ($this->fileSize ?? 10000), // 1MB Max
            ]);
            foreach ($this->file as $file) {
                $ftype = in_array(pathinfo($file->getFilename(), PATHINFO_EXTENSION), $videoExtensions) ? 'video' : 'image';
                $this->fileId[] = Media::create([
                    'url' => $file,
                    'type' => $ftype
                ])->id;
            }
        } else {
            $this->validate([
                'file' => $this->type . '|max:' . ($this->fileSize ?? 10000), // 1MB Max
            ]);
            $newItem = Media::create([
                'url' => $this->file,
                'type' => $this->type
            ]);
            $this->fileId = $newItem->id;
        }
        $this->mount();
    }

    public function mount()
    {
        if ($this->multiple) {
            if (is_string($this->fileId)) {
                try {
                    $this->fileId = json_decode($this->fileId);
                } catch (\Exception $e) {
                }
            }
            $ids = is_array($this->fileId) ? $this->fileId : [$this->fileId];
            $media = Media::whereIn('id', $ids)->orderByRaw("FIELD(id, " . implode(',', $ids) . ")");
            $this->preview = $media->count() > 0 ? $media->get() : null;
            Storage::disk()->deleteDirectory('livewire-tmp');
        } else {
            if ($this->fileId) {
                $this->preview = Media::find($this->fileId);
            } else {
                $this->preview = null;
            }
        }
        if ($this->result_to_event) {
            $this->dispatch($this->result_to_event, $this->fileId);
        }
    }

    public function resort($newSort)
    {
        if ($this->multiple) {
            $this->fileId = $newSort;
            $this->mount();
        }
    }

    public function removeFile($file_id)
    {
        if ($this->multiple) {

            if (is_string($this->fileId)) {
                try {
                    $this->fileId = json_decode($this->fileId);
                } catch (\Exception $e) {
                }
            }
            $fileIndex = array_search($file_id, $this->fileId);
            unset($this->fileId[$fileIndex]);
        } else {
            $this->fileId = '';
        }
        $this->mount();
        Media::find($file_id)->delete();
    }

    public function render()
    {
        return view('livewire.upload-file');
    }
}
