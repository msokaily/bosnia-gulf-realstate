<!-- Modal -->
<div>
    <div class="modal fade {{ $open ? 'force-display show' : '' }}" id="contentEditModal" tabindex="-1" role="dialog"
        aria-labelledby="contentEditModalTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contentEditModalTitle">Edit Content</h5>
                    <button type="button" class="close-content-edit-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit='save'>
                    <input type="hidden" wire:model='name'>
                    <input type="hidden" wire:model='type'>
                    <div class="modal-body">
                        @if ($open)
                            @if ($type == 'text')
                                @if ($fields)
                                    <div class="edit-mode-type-text">
                                        @foreach ($fields as $key => $field)
                                            <div class="row mb-2">
                                                <div class="col-md-2">
                                                    <label for="{{ $field['name'] }}-field" style="margin-top: 14px;">
                                                        <b>{{ ucfirst($field['name']) }}</b>
                                                    </label>
                                                </div>
                                                <div class="col-md-10">
                                                    @if ($field['type'] == 'textarea')
                                                        <textarea id="{{ $field['name'] }}-field" class="form-control" placeHolder="{{ $field['placeholder'] ?? '' }}"
                                                            wire:change='updateMultipleValue($event.target.value, "{{ $field['name'] }}")' rows="10">{{ $value->{$field['name']} ?? ($field['default'] ?? '') }}</textarea>
                                                        @if (isset($field['note']))
                                                            <p>{{ $field['note'] }}</p>
                                                        @endif
                                                    @else
                                                        <input id="{{ $field['name'] }}-field" class="form-control"
                                                            placeHolder="{{ $field['placeholder'] ?? '' }}"
                                                            wire:change='updateMultipleValue($event.target.value, "{{ $field['name'] }}")'
                                                            value="{{ $value->{$field['name']} ?? ($field['default'] ?? '') }}"
                                                            type="{{ $field['type'] }}" />
                                                        @if (isset($field['note']))
                                                            <p class="mb-2" style="color: #616161;">
                                                                {{ $field['note'] }}</p>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="row edit-mode-type-text">
                                        <div class="col-md-2">
                                            <label for="value-field">Value</label>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea id="value-field" class="form-control" wire:model='value' rows="10"></textarea>
                                        </div>
                                    </div>
                                @endif
                            @elseif (in_array($type, ['image', 'images']))
                                <div class="row edit-mode-type-image">
                                    <div class="col-md-12">
                                        <label>Image</label>
                                        @livewire('upload-file', ['fileId' => $value ?? '', 'multiple' => $type == 'images' ? true : false, 'result_to_event' => 'editor-set-value'])
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-modal-btn"
                            data-dismiss="modal">Close</button>
                        <button type="submit" wire:loading.attr='disabled'
                            @if ($type == 'text') wire:target='save' @endif class="btn btn-primary">
                            Save changes
                            <span wire:loading wire:target='save' class="fa-solid fa-spinner-third fa-spin"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        document.addEventListener('livewire:initialized', () => {
            $('#contentEditModal').modal({
                backdrop: true,
                keyboard: true,
                focus: true
            });
            @this.on('editor-open', () => {
                $('#contentEditModal').modal('show');
                // fixModal();
            });
            @this.on('editor-close', () => {
                $('#contentEditModal').modal('hide');
            });
        });
        $(function() {
            $('body').on('click', '#contentEditModal .close-modal-btn, .close-content-edit-modal', function() {
                $('#contentEditModal').modal('hide'); // dispose
            });
            $('#contentEditModal').on('hide.bs.modal', function(e) {
                @this.close();
            });
        });
    </script>
@endpush
