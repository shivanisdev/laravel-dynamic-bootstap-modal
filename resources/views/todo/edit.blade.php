<div id="response"></div>
<form id="modelForm" action="{{ route('todo.update',$todo->id) }}">
    @csrf
    @method('patch')
    <!-- Form Inputs Start , This Section will be changed -->
    <div class="form-group row">
        <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
        <div class="col-md-6">
            <input id="title" type="text" class="form-control" name="title" required value="{{ $todo->title }}" >
            <span class="invalid-feedback" role="alert">
                <strong id="title_error"></strong>
            </span>
        </div>
    </div>
    <!-- Form Inputs End -->
    <div class="form-group">
        <input type="submit" class="btn btn-success">
    </div>
</form>
<script src="{{ asset('js/modal-form.js') }}"></script>