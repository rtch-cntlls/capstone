export const suspensionSpecs = `
<div class="row g-3 mb-3">

    <!-- SUSPENSION TYPE & MATERIAL -->
    <div class="col-md-6">
        <label>Suspension Component Type</label>
        <select name="suspension_component_type" class="form-select">
            <option value="">Select</option>
            <option value="Front Fork / Telescopic">Front Fork / Telescopic</option>
            <option value="Upside Down (USD) Fork">Upside Down (USD) Fork</option>
            <option value="Rear Monoshock">Rear Monoshock</option>
            <option value="Twin Shock / Dual Rear">Twin Shock / Dual Rear</option>
            <option value="Leading Link / Earles">Leading Link / Earles</option>
            <option value="Air / Hydraulic Suspension">Air / Hydraulic Suspension</option>
            <option value="Aftermarket Cartridge Kit">Aftermarket Cartridge Kit</option>
            <option value="Steering Damper">Steering Damper</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- ADJUSTABILITY -->
    <div class="col-md-6">
        <label>Adjustability / Features</label>
        <select name="suspension_adjustability" class="form-select">
            <option value="">Select</option>
            <option value="Non-Adjustable">Non-Adjustable</option>
            <option value="Preload Adjustable">Preload Adjustable</option>
            <option value="Rebound Damping Adjustable">Rebound Damping Adjustable</option>
            <option value="Compression Damping Adjustable">Compression Damping Adjustable</option>
            <option value="Fully Adjustable">Fully Adjustable</option>
            <option value="Electronic / Semi-Active">Electronic / Semi-Active</option>
            <option value="Hydraulic Adjuster">Hydraulic Adjuster</option>
            <option value="Custom Tuned / Revalved">Custom Tuned / Revalved</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Travel / Stroke Length</label>
        <input type="text" name="suspension_travel" class="form-control" placeholder="e.g. 120mm / 130mm">
    </div>

    <div class="col-md-6">
        <label>Fork / Shock Diameter</label>
        <input type="text" name="suspension_diameter" class="form-control" placeholder="e.g. 30mm / 41mm / 50mm">
    </div>

    <div class="col-md-6">
        <label>Damping Type / Features</label>
        <input type="text" name="damping_features" class="form-control" placeholder="e.g. Hydraulic, Gas-Charged, Progressive Rate, Adjustable">
    </div>

    <!-- STEERING -->
    <div class="col-md-6">
        <label>Steering Component Type</label>
        <select name="steering_component_type" class="form-select">
            <option value="">Select</option>
            <option value="Steering Stem / Bearings">Steering Stem / Bearings</option>
            <option value="Handlebar Mount / Riser">Handlebar Mount / Riser</option>
            <option value="Steering Damper">Steering Damper</option>
            <option value="Integrated Electronic Steering Assist">Integrated Electronic Steering Assist</option>
            <option value="Aftermarket Adjustable / CNC">Aftermarket Adjustable / CNC</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Steering Bearings Type</label>
        <select name="steering_bearings_type" class="form-select">
            <option value="">Select</option>
            <option value="Ball Bearings">Ball Bearings</option>
            <option value="Tapered Roller Bearings">Tapered Roller Bearings</option>
            <option value="Sealed / Caged Bearings">Sealed / Caged Bearings</option>
            <option value="Ceramic / Performance Bearings">Ceramic / Performance Bearings</option>
            <option value="Aftermarket Upgraded">Aftermarket Upgraded</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Steering Damper / Assist Type</label>
        <select name="steering_damper_type" class="form-select">
            <option value="">Select</option>
            <option value="None">None</option>
            <option value="Hydraulic / Manual">Hydraulic / Manual</option>
            <option value="Electronic / Smart Damper">Electronic / Smart Damper</option>
            <option value="Linear / Racing Type">Linear / Racing Type</option>
            <option value="Aftermarket Kit Installed">Aftermarket Kit Installed</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Steering Geometry / Specs</label>
        <input type="text" name="steering_geometry" class="form-control" placeholder="e.g. Rake / Trail, Angle, Offset">
    </div>

    <div class="col-md-6">
        <label>Electronic Suspension / Steering Assist Features</label>
        <select name="electronic_features" class="form-select">
            <option value="">Select</option>
            <option value="None">None</option>
            <option value="Semi-Active Suspension">Semi-Active Suspension</option>
            <option value="Electronically Controlled Preload">Electronically Controlled Preload</option>
            <option value="Smart Steering Assist">Smart Steering Assist</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- GENERAL PRODUCT INFO -->
    <div class="col-md-6">
        <label>Manufacturer / Brand</label>
        <input type="text" name="brand" class="form-control" placeholder="e.g. Ohlins, YSS, Showa, WP">
    </div>

    <div class="col-md-6">
        <label>Packaging / Size</label>
        <input type="text" name="packaging" class="form-control" placeholder="e.g. Front Fork Set, Single Shock, Kit">
    </div>

</div>
`;
