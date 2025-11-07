export const suspensionSpecs = `
<div>
    <h5 class="fw-bold">Suspension & Steering</h5>
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label>Front Suspension Type</label>
            <select name="front_suspension" class="form-select">
                <option value="">Select</option>
                <option value="Telescopic Fork">Telescopic Fork</option>
                <option value="Upside Down (USD) Fork">Upside Down (USD) Fork</option>
                <option value="Telescopic (Adjustable)">Telescopic Adjustable</option>
                <option value="USD (Fully Adjustable)">USD Fully Adjustable</option>
                <option value="Leading Link">Leading Link</option>
                <option value="Earles Fork">Earles Fork</option>
                <option value="Single-Sided Front Suspension">Single-Sided Front Suspension</option>
                <option value="Air/Hydraulic Fork">Air/Hydraulic Fork</option>
                <option value="Aftermarket Cartridge Kit">Aftermarket Cartridge Kit</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Front Fork Material / Coating</label>
            <select name="front_fork_material" class="form-select">
                <option value="">Select</option>
                <option value="Steel">Steel</option>
                <option value="Aluminum Alloy">Aluminum Alloy</option>
                <option value="Inverted Aluminum">Inverted Aluminum</option>
                <option value="Titanium Nitride Coated">Titanium Nitride Coated</option>
                <option value="Diamond-Like Carbon (DLC) Coating">Diamond-Like Carbon (DLC) Coating</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Rear Suspension Type</label>
            <select name="rear_suspension" class="form-select">
                <option value="">Select</option>
                <option value="Twin Shock">Twin Shock</option>
                <option value="Monoshock (Non-Link)">Monoshock (Non-Link)</option>
                <option value="Monoshock (Pro-Link/Uni-Trak)">Monoshock (Pro-Link/Uni-Trak)</option>
                <option value="Twin Shock (Piggyback)">Twin Shock (Piggyback)</option>
                <option value="Monoshock (Piggyback)">Monoshock (Piggyback)</option>
                <option value="Softail / Hidden Shock">Softail / Hidden Shock</option>
                <option value="Air Suspension">Air Suspension</option>
                <option value="Shaft Drive Rear Suspension">Shaft Drive Rear Suspension</option>
                <option value="Aftermarket YSS/Ohlin/Kobe/ETC">Aftermarket YSS/Ohlin/Kobe/ETC</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Rear Suspension Mount Orientation</label>
            <select name="rear_suspension_orientation" class="form-select">
                <option value="">Select</option>
                <option value="Vertical Mount">Vertical Mount</option>
                <option value="Horizontal Mount">Horizontal Mount</option>
                <option value="Side-Mounted Monoshock">Side-Mounted Monoshock</option>
                <option value="Offset Monoshock">Offset Monoshock</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Suspension Adjustability</label>
            <select name="suspension_adjustability" class="form-select">
                <option value="">Select</option>
                <option value="Non-Adjustable">Non-Adjustable</option>
                <option value="Rear Preload Adjustable">Rear Preload Adjustable</option>
                <option value="Preload Adjustable">Preload Adjustable</option>
                <option value="Rebound Damping Adjustable">Rebound Damping Adjustable</option>
                <option value="Compression Damping Adjustable">Compression Damping Adjustable</option>
                <option value="Fully Adjustable">Fully Adjustable</option>
                <option value="Electronic Damping Control">Electronic Damping Control</option>
                <option value="Hydraulic Preload Adjuster">Hydraulic Preload Adjuster</option>
                <option value="Custom Tuned / Revalved">Custom Tuned / Revalved</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Suspension Travel (Front / Rear in mm)</label>
            <input type="text" name="suspension_travel" class="form-control" placeholder="e.g. 120mm / 130mm">
        </div>

        <div class="col-md-6">
            <label>Front Fork Diameter (mm)</label>
            <input type="text" name="front_fork_diameter" class="form-control" placeholder="e.g. 30mm / 41mm / 50mm">
        </div>
    </div>

    <di class="row g-3 mb-2">
        <div class="col-md-6">
            <label>Steering Control Type</label>
            <select name="steering_type" class="form-select">
                <option value="">Select</option>
                <option value="Standard Tubular Handlebar">Standard Tubular Handlebar</option>
                <option value="Clip-On Handlebar (Above Triple Tree)">Clip-On Handlebar Above Triple Tree</option>
                <option value="Clip-On Handlebar (Below Triple Tree)">Clip-On Handlebar Below Triple Tree</option>
                <option value="High-Rise Handlebar">High-Rise Handlebar</option>
                <option value="Flat / Dirt Handlebar">Flat / Dirt Handlebar</option>
                <option value="T-Bar / Drag Bar">T-Bar / Drag Bar</option>
                <option value="CNC / Aftermarket Adjustable">CNC / Aftermarket Adjustable</option>
                <option value="Integrated Bar (Scooter)">Integrated Bar</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Steering Bearings</label>
            <select name="steering_bearings" class="form-select">
                <option value="">Select</option>
                <option value="Ball Bearings">Ball Bearings</option>
                <option value="Tapered Roller Bearings">Tapered Roller Bearings</option>
                <option value="Sealed Caged Bearings">Sealed Caged Bearings</option>
                <option value="Racing / Ceramic Bearings">Racing / Ceramic Bearings</option>
                <option value="Aftermarket Upgraded">Aftermarket Upgraded</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Steering Damper</label>
            <select name="steering_damper" class="form-select">
                <option value="">Select</option>
                <option value="None">None</option>
                <option value="Hydraulic (Side Mount)">Hydraulic Side Mount</option>
                <option value="Rotary Damper (Top Mount)">Rotary Damper Top Mount</option>
                <option value="Electronic Steering Damper (HESD/Smart Damper)">Electronic Steering Damper</option>
                <option value="Adjustable (Manual)">Adjustable Manual</option>
                <option value="Racing / Performance Linear">Racing / Performance Linear</option>
                <option value="Aftermarket Kit Installed">Aftermarket Kit Installed</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="col-md-6">
            <label>Steering Geometry (Rake / Trail)</label>
            <input type="text" name="steering_geometry" class="form-control" placeholder="e.g. 25.5° / 100mm">
        </div>

        <div class="col-md-6">
            <label>Electronic Suspension / Steering Assist</label>
            <select name="electronic_suspension" class="form-select">
                <option value="">Select</option>
                <option value="None">None</option>
                <option value="Semi-Active Suspension">Semi-Active Suspension</option>
                <option value="Electronically Controlled Preload">Electronically Controlled Preload</option>
                <option value="Smart Steering Assist">Smart Steering Assist</option>
                <option value="Other">Other</option>
            </select>
        </div>
    </div>
</div>
`;
