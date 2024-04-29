<?php

namespace App\Livewire;

use App\Models\Content;
use Livewire\Attributes\On;
use Livewire\Component;
use stdClass;

class ContentEditor extends Component
{
    protected $listenters = ['editor-type-changed'];
    
    public $name;
    public $value;
    public $default = '';
    public $fields;
    public $type = 'text';
    public $open = false;

    #[On('editor-type-changed')] 
    public function setMode($name, $type, $default = '', $fields = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->fields = $fields;
        $value = Content::where('name', $this->name)->first();
        if (in_array($this->type, ['image', 'images'])) {
            $value = $value ? $value->value : ($this->type == 'images' ? [] : '');
            try {
                $value = json_decode($value);
            } catch (\Throwable $th) {
            }
            if ($this->type == 'images') {
                $value =  is_array($value) ? $value : [$value];
            }
            $this->value = $value;
        } else {
            if ($this->fields) {
                if ($value) {
                    try {
                        $valueObj = json_decode($value->value);
                    } catch (\Throwable $th) {
                        $valueObj = $value->value;
                    }
                    $this->value = $valueObj;
                } else {
                    $val = new stdClass();
                    foreach ($this->fields as $one) {
                        $val->{$one['name']} = $one['default'];
                    }
                    $this->value = $val;
                }
            } else {
                $this->value = $value ? $value->value : $default;
            }
        }
        $this->open = true;
        $this->dispatch('editor-open');
    }

    #[On('editor-set-value')]
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function updateMultipleValue($value, $name)
    {
        if (!$this->value) {
            $this->value = new stdClass();
        }
        $this->value->{$name} = $value;
    }
    
    public function close()
    {
        $this->open = false;
        if ($this->type == 'images') {
            $this->dispatch('refresh-content', $this->name);
        }
    }

    public function save()
    {
        $content = Content::where('name', $this->name);
        $values = $this->only('value', 'type');
        if ($this->type == 'images') {
            if (is_array($values['value']) && count($values['value']) > 0) {
                $values['value'] = json_encode($values['value']);
            }
        }
        if ($this->fields) {
            $values['value'] = json_encode($values['value']);
        }
        if ($content->count() > 0) {
            $content->update($values);
        } else {
            $values['name'] = $this->name;
            Content::create($values);
        }
        $this->open = false;
        $this->dispatch('editor-close');
        $this->dispatch('refresh-content', $this->name);
    }
    
    public function render()
    {
        return view('livewire.content-editor');
    }
}
