export const suspensionSpecs = `
<h5>Suspension & Steering</h5>
<div class="row g-3 mb-2">
    <div class="col-md-6">
        <label>Front Suspension</label>
        <select name="front_suspension" class="form-select">
            <option value="">Select</option>
            <option value="Telescopic Fork">Telescopic Fork</option>
            <option value="Upside Down (USD) Fork">Upside Down (USD) Fork</option>
            <option value="Hydraulic Fork">Hydraulic Fork</option>
            <option value="Spring Fork">Spring Fork</option>
            <option value="Air Fork">Air Fork</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Rear Suspension</label>
        <select name="rear_suspension" class="form-select">
            <option value="">Select</option>
            <option value="Twin Shock">Twin Shock</option>
            <option value="Monoshock">Monoshock</option>
            <option value="Pro-Link / Uni-Trak">Pro-Link / Uni-Trak</option>
            <option value="Air Suspension">Air Suspension</option>
            <option value="Adjustable Gas Shock">Adjustable Gas Shock</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Suspension Adjustability</label>
        <select name="suspension_adjustability" class="form-select">
            <option value="">Select</option>
            <option value="Non-Adjustable">Non-Adjustable</option>
            <option value="Preload Adjustable">Preload Adjustable</option>
            <option value="Rebound Adjustable">Rebound Adjustable</option>
            <option value="Compression Adjustable">Compression Adjustable</option>
            <option value="Fully Adjustable">Fully Adjustable</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Steering Type</label>
        <select name="steering_type" class="form-select">
            <option value="">Select</option>
            <option value="Standard Handlebar">Standard Handlebar</option>
            <option value="Clip-On">Clip-On</option>
            <option value="Adjustable">Adjustable</option>
            <option value="T-Bar">T-Bar</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Steering Bearings</label>
        <input type="text" name="steering_bearings" class="form-control" placeholder="e.g. Tapered, Ball, Sealed">
    </div>
    <div class="col-md-6">
        <label>Steering Damper</label>
        <select name="steering_damper" class="form-select">
            <option value="">Select</option>
            <option value="None">None</option>
            <option value="Hydraulic">Hydraulic</option>
            <option value="Electronic">Electronic</option>
            <option value="Other">Other</option>
        </select>
    </div>
</div>
`;
