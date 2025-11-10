export const handlebarsSpecs = `
<div class="row g-3 mb-3">

    <!-- HANDLEBAR TYPE & MATERIAL -->
    <div class="col-md-6">
        <label>Handlebar Type / Style</label>
        <select name="handlebar_type" class="form-select">
            <option value="">Select</option>
            <option value="Standard / OEM">Standard / OEM</option>
            <option value="T-Bar">T-Bar</option>
            <option value="Clip-On">Clip-On</option>
            <option value="Ape Hanger">Ape Hanger</option>
            <option value="Drag Bar / Flat Bar">Drag Bar / Flat Bar</option>
            <option value="Motocross / Dirt Bar">Motocross / Dirt Bar</option>
            <option value="Riser / High Rise">Riser / High Rise</option>
            <option value="Mini-Z / Z-Bar">Mini-Z / Z-Bar</option>
            <option value="Custom / Chopper">Custom / Chopper</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Handlebar Diameter (Clamping Area)</label>
        <select name="handlebar_diameter" class="form-select">
            <option value="">Select</option>
            <option value="22mm">22mm</option>
            <option value="25.4mm">25.4mm</option>
            <option value="28.6mm">28.6mm</option>
            <option value="Other / Custom">Other / Custom</option>
        </select>
    </div>

    <!-- GRIPS -->
    <div class="col-md-6">
        <label>Grip Type</label>
        <select name="grip_type" class="form-select">
            <option value="">Select</option>
            <option value="Rubber / Standard">Rubber / Standard</option>
            <option value="Foam / Sponge">Foam / Sponge</option>
            <option value="Gel / Cushion">Gel / Cushion</option>
            <option value="Leather / Vinyl">Leather / Vinyl</option>
            <option value="Heated Grip">Heated Grip</option>
            <option value="Racing Grip">Racing Grip</option>
            <option value="Bar-End Grip">Bar-End Grip</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Grip Diameter / Size (mm)</label>
        <input type="text" name="grip_diameter" class="form-control" placeholder="e.g. 22 or 25.4">
    </div>

    <!-- LEVERS -->
    <div class="col-md-6">
        <label>Brake / Clutch Lever Type</label>
        <select name="lever_type" class="form-select">
            <option value="">Select</option>
            <option value="Standard / OEM">Standard / OEM</option>
            <option value="Adjustable Span">Adjustable Span</option>
            <option value="Foldable / Shorty">Foldable / Shorty</option>
            <option value="CNC Alloy">CNC Alloy</option>
            <option value="Carbon Fiber / Titanium">Carbon Fiber / Titanium</option>
            <option value="Racing Alloy">Racing Alloy</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Lever Features / Adjustable</label>
        <input type="text" name="lever_features" class="form-control" placeholder="e.g. CNC Machined, Adjustable Reach, Racing Spec">
    </div>

    <!-- SWITCHES & ELECTRONICS -->
    <div class="col-md-6">
        <label>Switch Assembly Type</label>
        <select name="switch_type" class="form-select">
            <option value="">Select</option>
            <option value="OEM Standard">OEM Standard</option>
            <option value="Aftermarket Replacement">Aftermarket Replacement</option>
            <option value="Integrated Control Unit">Integrated Control Unit</option>
            <option value="Custom Racing Switch">Custom Racing Switch</option>
            <option value="Hazard Switch Addition">Hazard Switch Addition</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Control Mechanism / Type</label>
        <select name="control_type" class="form-select">
            <option value="">Select</option>
            <option value="Cable-Actuated">Cable-Actuated</option>
            <option value="Hydraulic Brake">Hydraulic Brake</option>
            <option value="Hydraulic Clutch">Hydraulic Clutch</option>
            <option value="Throttle-by-Wire">Throttle-by-Wire</option>
            <option value="Electronic / Integrated">Electronic / Integrated</option>
            <option value="Adjustable / Tunable">Adjustable / Tunable</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- MIRRORS -->
    <div class="col-md-6">
        <label>Mirror Mount Type</label>
        <select name="mirror_mount_type" class="form-select">
            <option value="">Select</option>
            <option value="Handlebar Clamp Mount">Handlebar Clamp Mount</option>
            <option value="Bar-End Mirror">Bar-End Mirror</option>
            <option value="Fairing / Integrated Mount">Fairing / Integrated Mount</option>
            <option value="Stem Mount">Stem Mount</option>
            <option value="Adjustable / Foldable">Adjustable / Foldable</option>
            <option value="Other">Other</option>
        </select>
    </div>

</div>
`;
