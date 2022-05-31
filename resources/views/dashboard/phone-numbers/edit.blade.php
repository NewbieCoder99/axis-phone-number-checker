<div class="row">

    <input type="hidden" name="url" id="url" value="{{ route('phone-numbers.update', $data->id) }}">
    <input type="hidden" name="method" id="method" value="put">

    <div class="col-md-12 mb-3">
        <div class="form-group">
            <label for="number" class="text-sm">Number <em class="text-danger text-sm">*</em></label>
            <input type="text" name="number" id="number" class="form-control form-control-sm" placeholder="Phone Number" value="{{ $data->number }}">
            <div class="invalid-feedback" data-error="number"></div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <div class="form-group">
            <label for="name" class="text-sm">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Name" value="{{ $data->name }}">
            <div class="invalid-feedback" data-error="name"></div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <div class="form-group">
            <label for="nik" class="text-sm">NIK</label>
            <input type="text" name="nik" id="nik" class="form-control form-control-sm" placeholder="NIK" value="{{ $data->nik }}">
            <div class="invalid-feedback" data-error="nik"></div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <div class="form-group">
            <label for="email" class="text-sm">Email</label>
            <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="Email" value="{{ $data->email }}">
            <div class="invalid-feedback" data-error="email"></div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <div class="form-group">
            <label class="form-control-label text-sm" for="status">Status <em class="text-danger text-sm">*</em></label>
            <select name="status" id="status" class="form-control form-control-sm" style="height:33px;">
                <option value="active" @if($data->status == 'active') selected @endif>Active</option>
                <option value="inactive" @if($data->status == 'inactive') selected @endif>Inactive</option>
                <option value="unknown" @if($data->status == 'unknown') selected @endif>Unknown</option>
            </select>
            <div class="invalid-feedback" data-error="status"></div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <div class="form-group">
            <label for="expired_date" class="text-sm">Expired Date</label>
            <input type="date" name="expired_date" id="expired_date" class="form-control form-control-sm" placeholder="Expired Date" value="{{ $data->expired_date }}">
            <div class="invalid-feedback" data-error="expired_date"></div>
        </div>
    </div>

</div>
