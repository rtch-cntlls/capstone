export const brakingSpecs = `
<h5 class="mb-3">Brakes & Suspension</h5>
<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label>Front Brake Type</label>
        <select name="front_brake_type" class="form-select">
            <option value="">Select</option>
            <option value="Disc">Disc</option>
            <option value="Drum">Drum</option>
            <option value="Hydraulic Disc">Hydraulic Disc</option>
            <option value="Dual Disc">Dual Disc</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Rear Brake Type</label>
        <select name="rear_brake_type" class="form-select">
            <option value="">Select</option>
            <option value="Disc">Disc</option>
            <option value="Drum">Drum</option>
            <option value="Hydraulic Disc">Hydraulic Disc</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Brake ABS (Anti-lock Braking System)</label>
        <select name="brake_abs" class="form-select">
            <option value="">Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Brake Brand</label>
        <input type="text" name="brake_brand" class="form-control" placeholder="e.g. Brembo, Faito, EBC">
    </div>
    <div class="col-md-6">
        <label>Front Rotor Diameter (mm)</label>
        <input type="number" name="front_rotor_diameter" class="form-control" placeholder="e.g. 260">
    </div>
    <div class="col-md-6">
        <label>Rear Rotor Diameter (mm)</label>
        <input type="number" name="rear_rotor_diameter" class="form-control" placeholder="e.g. 220">
    </div>

    <h6 class="fw-bold">Brake Components</h6>
    <div class="col-md-6 m-0">
        <label>Front Caliper Type</label>
        <select name="front_caliper_type" class="form-select">
            <option value="">Select</option>
            <option value="Single Piston">Single Piston</option>
            <option value="Dual Piston">Dual Piston</option>
            <option value="Four Piston">Four Piston</option>
            <option value="Radial Mount">Radial Mount</option>
        </select>
    </div>
    <div class="col-md-6 m-0">
        <label>Rear Caliper Type</label>
        <select name="rear_caliper_type" class="form-select">
            <option value="">Select</option>
            <option value="Single Piston">Single Piston</option>
            <option value="Dual Piston">Dual Piston</option>
            <option value="Drum Shoe">Drum Shoe</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Brake Pad Material</label>
        <select name="brake_pad_material" class="form-select">
            <option value="">Select</option>
            <option value="Organic">Organic</option>
            <option value="Sintered">Sintered</option>
            <option value="Ceramic">Ceramic</option>
            <option value="Kevlar">Kevlar</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Brake Fluid Type</label>
        <select name="brake_fluid_type" class="form-select">
            <option value="">Select</option>
            <option value="DOT 3">DOT 3</option>
            <option value="DOT 4">DOT 4</option>
            <option value="DOT 5">DOT 5</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Master Cylinder Type</label>
        <select name="master_cylinder_type" class="form-select">
            <option value="">Select</option>
            <option value="Standard">Standard</option>
            <option value="Radial">Radial</option>
            <option value="Adjustable Lever">Adjustable Lever</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Brake Line Material</label>
        <select name="brake_line_material" class="form-select">
            <option value="">Select</option>
            <option value="Rubber">Rubber</option>
            <option value="Stainless Steel Braided">Stainless Steel Braided</option>
            <option value="Kevlar Reinforced">Kevlar Reinforced</option>
        </select>
    </div>

    <h6 class="fw-bold">Front Suspension</h6>
    <div class="col-md-6 m-0">
        <label>Front Suspension Type</label>
        <select name="front_suspension_type" class="form-select">
            <option value="">Select</option>
            <option value="Telescopic Fork">Telescopic Fork</option>
            <option value="Upside-Down Fork (USD)">Upside-Down Fork (USD)</option>
            <option value="Inverted Fork">Inverted Fork</option>
        </select>
    </div>
    <div class="col-md-6 m-0">
        <label>Front Travel (mm)</label>
        <input type="number" name="front_travel" class="form-control" placeholder="e.g. 120">
    </div>
    <div class="col-md-6">
        <label>Front Fork Diameter (mm)</label>
        <input type="number" name="front_fork_diameter" class="form-control" placeholder="e.g. 37">
    </div>
    <div class="col-md-6">
        <label>Front Suspension Adjustability</label>
        <select name="front_suspension_adjustability" class="form-select">
            <option value="">Select</option>
            <option value="Non-Adjustable">Non-Adjustable</option>
            <option value="Preload Adjustable">Preload Adjustable</option>
            <option value="Preload + Rebound">Preload + Rebound</option>
            <option value="Fully Adjustable">Fully Adjustable</option>
        </select>
    </div>
    <h6>Rear Suspension</h6>
    <div class="col-md-6">
        <label>Rear Suspension Type</label>
        <select name="rear_suspension_type" class="form-select">
            <option value="">Select</option>
            <option value="Mono Shock">Mono Shock</option>
            <option value="Twin Shock">Twin Shock</option>
            <option value="Air Shock">Air Shock</option>
            <option value="Gas Shock">Gas Shock</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Rear Travel (mm)</label>
        <input type="number" name="rear_travel" class="form-control" placeholder="e.g. 100">
    </div>
    <div class="col-md-6">
        <label>Rear Suspension Brand</label>
        <input type="text" name="rear_suspension_brand" class="form-control" placeholder="e.g. YSS, Ohlins, KYB">
    </div>
    <div class="col-md-6">
        <label>Rear Suspension Adjustability</label>
        <select name="rear_suspension_adjustability" class="form-select">
            <option value="">Select</option>
            <option value="Non-Adjustable">Non-Adjustable</option>
            <option value="Preload Adjustable">Preload Adjustable</option>
            <option value="Preload + Rebound">Preload + Rebound</option>
            <option value="Fully Adjustable">Fully Adjustable</option>
        </select>
    </div>
</div>
`;