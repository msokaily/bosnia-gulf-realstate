<?php

namespace App\Livewire;

use App\Models\Content as Contents;
use Livewire\Attributes\On;
use Livewire\Component;

class Content extends Component
{
    protected $listeners = ['refresh-sliders'];

    public $editMode = true;
    public $name;
    public $type = 'text'; // text, image, images
    public $default;
    public $fields;
    public $html;
    public $htmlContent = '';
    public $html_container = '';
    public $value;
    public $class = '';

    #[On('refresh-content')]
    public function refresh($name)
    {
        if ($name == $this->name) {
            $this->mount();
        }
    }

    public function mount()
    {
        if (!auth()->check() || auth()->user()->role != 'Admin') {
            $this->editMode = false;
        }
        $item = Contents::where('name', $this->name)->first();
        $this->setValue($item);
    }

    public function edit()
    {
        $this->dispatch('editor-type-changed', $this->name, $this->type, $this->default, $this->fields);
    }

    private function setValue($item)
    {
        if ($this->html && !empty($this->html)) {
            if ($item && $item->value) {
                if ($this->type == 'images') {
                    $value = $item->value_url;
                    $htmlContent = '';
                    if (is_array($value)) {
                        foreach ($value as $key => $one) {
                            $htmlContent .= str_replace('[value]', $one, $this->html);
                        }
                    } else {
                        $htmlContent = str_replace('[value]', $value, $this->html);
                    }
                    if ($this->html_container) {
                        $this->htmlContent = str_replace('[html]', $htmlContent, $this->html_container);
                    } else {
                        $this->htmlContent = $htmlContent;
                    }
                    $this->dispatch('refresh-sliders');
                } else if ($this->type == 'image') {
                    $this->htmlContent = str_replace('[value]', $item->value_url, $this->html);
                } else {
                    if ($this->fields) {
                        $htmlContent = '';
                        $searchParam = [];
                        $replaceParam = [];
                        try {
                            $value = json_decode($item->value);
                        } catch (\Throwable $th) {
                            $value = $item->value;
                        }
                        foreach ($this->fields as $one) {
                            $searchParam[] = '[' . $one['name'] . ']';
                            $replaceParam[] = isset($value->{$one['name']}) && !empty($value->{$one['name']}) ? $value->{$one['name']} : (isset($one['default']) ? $one['default'] : '');
                        }
                        $htmlContent = str_replace($searchParam, $replaceParam, $this->html);
                        if ($this->html_container) {
                            $this->htmlContent = str_replace('[html]', $htmlContent, $this->html_container);
                        } else {
                            $this->htmlContent = $htmlContent;
                        }
                    } else {
                        $this->htmlContent = str_replace('[value]', $this->value, $this->html);
                    }
                }
            } else {
                if ($this->type == 'images') {
                    $htmlContent = '';
                    if (is_array($this->default)) {
                        foreach ($this->default as $key => $one) {
                            $htmlContent .= str_replace('[value]', $one, $this->html);
                        }
                    } else {
                        $htmlContent = str_replace('[value]', $this->default, $this->html);
                    }
                    if ($this->html_container) {
                        $this->htmlContent = str_replace('[html]', $htmlContent, $this->html_container);
                    } else {
                        $this->htmlContent = $htmlContent;
                    }
                    $this->dispatch('refresh-sliders');
                } else if ($this->type == 'image') {
                    $this->htmlContent = str_replace('[value]', $this->default, $this->html);
                } else {
                    if ($this->fields) {
                        $htmlContent = '';
                        $searchParam = [];
                        $replaceParam = [];
                        foreach ($this->fields as $one) {
                            $searchParam[] = '[' . $one['name'] . ']';
                            $replaceParam[] = $one['default'];
                        }
                        $htmlContent = str_replace($searchParam, $replaceParam, $this->html);
                        if ($this->html_container) {
                            $this->htmlContent = str_replace('[html]', $htmlContent, $this->html_container);
                        } else {
                            $this->htmlContent = $htmlContent;
                        }
                    } else {
                        $this->htmlContent = str_replace('[value]', $this->default, $this->html);
                    }
                }
            }
            $this->dispatch('refresh-sliders');
        } else if ($this->type == 'text') {
            if ($item) {
                $this->value = $item->value;
            }
        }
    }

    public function render()
    {
        return view('livewire.content');
    }
}
