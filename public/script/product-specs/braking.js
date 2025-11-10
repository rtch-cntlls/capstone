export const brakingSpecs = `
<div class="row g-3 mb-3">

    <div class="col-md-6">
        <label class="form-label fw-bold">Product Type</label>
        <select name="product_type" class="form-select">
            <option value="">Select</option>
            <option value="Brake Disc / Rotor">Brake Disc / Rotor</option>
            <option value="Brake Caliper">Brake Caliper</option>
            <option value="Brake Pads / Shoes">Brake Pads / Shoes</option>
            <option value="Brake Lever / Pedal">Brake Lever / Pedal</option>
            <option value="Brake Line / Hose">Brake Line / Hose</option>
            <option value="Brake Master Cylinder">Brake Master Cylinder</option>
            <option value="Brake Kit / Upgrade Set">Brake Kit / Upgrade Set</option>
            <option value="Parking Brake Mechanism">Parking Brake Mechanism</option>
            <option value="Brake Accessories">Brake Accessories</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Brand / Manufacturer</label>
        <input type="text" name="brand" class="form-control" placeholder="e.g. Brembo, Nissin, RCB, Tokico, OEM">
    </div>

    <div class="col-md-6">
        <label>Dimensions / Size</label>
        <input type="text" name="dimensions" class="form-control" placeholder="e.g. 260mm diameter, 300x5mm rotor">
    </div>

    <div class="col-md-6">
        <label>Mount / Fitment Type</label>
        <input type="text" name="mount_type" class="form-control" placeholder="e.g. Axial, Radial, Universal, Specific Model Fit">
    </div>

    <div class="col-md-6">
        <label>Brake Safety / Tech Feature</label>
        <select name="brake_feature" class="form-select">
            <option value="">Select</option>
            <option value="None">None</option>
            <option value="ABS Compatible">ABS Compatible</option>
            <option value="CBS Compatible">CBS Compatible</option>
            <option value="Traction Control Compatible">Traction Control Compatible</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fluid / Lubricant Compatibility</label>
        <select name="fluid_type" class="form-select">
            <option value="">Select</option>
            <option value="DOT 3">DOT 3</option>
            <option value="DOT 4">DOT 4</option>
            <option value="DOT 5 / 5.1">DOT 5 / 5.1</option>
            <option value="Racing / High Performance Fluid">Racing / High Performance Fluid</option>
            <option value="Not Applicable">Not Applicable</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Adjustability / Feature</label>
        <select name="adjustability" class="form-select">
            <option value="">Select</option>
            <option value="Adjustable Lever / Pedal">Adjustable Lever / Pedal</option>
            <option value="Folding Lever">Folding Lever</option>
            <option value="Fixed">Fixed</option>
        </select>
    </div>

</div>
`;
