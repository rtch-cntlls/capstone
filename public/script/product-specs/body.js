export const bodySpecs = `
<div class="row g-3 mb-3">

    <div class="col-md-6">
        <label class="form-label fw-bold">Product Type / Part</label>
        <select name="product_type" class="form-select">
            <option value="">Select</option>
            <option value="Full Fairing Set">Full Fairing Set</option>
            <option value="Side Panels / Mid-Fairing">Side Panels / Mid-Fairing</option>
            <option value="Tail Section / Seat Cowl">Tail Section / Seat Cowl</option>
            <option value="Fender / Mudguard">Fender / Mudguard</option>
            <option value="Fuel Tank Cover / Tank Shroud">Fuel Tank Cover / Tank Shroud</option>
            <option value="Body Kit / Aero Kit">Body Kit / Aero Kit</option>
            <option value="Custom Panel">Custom Panel</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Installation / Mounting Type</label>
        <input type="text" name="installation_type" class="form-control" placeholder="e.g. Bolt-on, Clip-on, Quick Release">
    </div>

    <div class="col-md-6">
        <label>Dimensions (mm)</label>
        <input type="text" name="dimensions" class="form-control" placeholder="L x W x H, e.g. 800x300x200">
    </div>

</div>
`;
