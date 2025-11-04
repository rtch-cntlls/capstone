<form action="{{ route('admin.settings.admin', $admin->user_id) }}" method="POST">
    <div class="d-flex align-items-center justify-content-between">
        <h6 class="fw-bold">System Administrator</h6>
        <div class="mb-3 d-flex align-items-center">
            <button type="submit" class="btn btn-outline-success">Update Admin Account</button>
        </div>
    </div>
    @csrf
    <div class="mb-3 d-flex align-items-center">
        <label for="admin_first_name" class="form-label me-3" style="width: 140px;">First Name</label>
        <input type="text" name="admin_first_name" id="admin_first_name"
               class="form-control border-0 border-bottom fw-bold no-outline"
               value="{{ old('admin_first_name', ucwords($admin->firstname)) }}"
               placeholder="Enter first name">
    </div>
    <div class="mb-3 d-flex align-items-center">
        <label for="admin_last_name" class="form-label me-3" style="width: 140px;">Last Name</label>
        <input type="text" name="admin_last_name" id="admin_last_name"
               class="form-control border-0 border-bottom fw-bold no-outline"
               value="{{ old('admin_last_name', ucwords($admin->lastname)) }}"
               placeholder="Enter last name">
    </div>
    <div class="mb-3 d-flex align-items-center">
        <label for="admin_email" class="form-label me-3" style="width: 140px;">Email</label>
        <input type="email" name="admin_email" id="admin_email"
               class="form-control border-0 border-bottom fw-bold no-outline"
               value="{{ old('admin_email', $admin->email) }}"
               placeholder="e.g. admin@email.com">
    </div>
</form>

<div class="mb-3 d-flex align-items-center">
    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
        <i class="fas fa-key me-2"></i>Change Password
    </button>
</div>
@include('admin.pages.setting.changepassword')
