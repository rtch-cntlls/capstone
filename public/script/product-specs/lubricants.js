export const lubricantsSpecs = `
<div class="row g-3 mb-3">

    <!-- GENERAL FLUID INFO -->
    <div class="col-md-6">
        <label>Fluid / Lubricant Type</label>
        <select name="fluid_type" class="form-select">
            <option value="">Select</option>
            <option value="Engine Oil">Engine Oil</option>
            <option value="Transmission / Gear Oil">Transmission / Gear Oil</option>
            <option value="Fork / Suspension Oil">Fork / Suspension Oil</option>
            <option value="Brake Fluid">Brake Fluid</option>
            <option value="Clutch Fluid">Clutch Fluid</option>
            <option value="Coolant / Antifreeze">Coolant / Antifreeze</option>
            <option value="Grease / Bearing Lubricant">Grease / Bearing Lubricant</option>
            <option value="Chain Lubricant">Chain Lubricant</option>
            <option value="Fuel System Additive">Fuel System Additive</option>
            <option value="Radiator Additive / Enhancer">Radiator Additive / Enhancer</option>
            <option value="Other Specialty Fluids">Other Specialty Fluids</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Base / Composition</label>
        <select name="fluid_composition" class="form-select">
            <option value="">Select</option>
            <option value="Mineral">Mineral</option>
            <option value="Semi-Synthetic">Semi-Synthetic</option>
            <option value="Fully Synthetic">Fully Synthetic</option>
            <option value="Ester-Based / Racing">Ester-Based / Racing</option>
            <option value="Silicate-Free / OAT / HOAT">Silicate-Free / OAT / HOAT</option>
            <option value="Petroleum-Based">Petroleum-Based</option>
            <option value="Synthetic Blend">Synthetic Blend</option>
            <option value="Water-Based">Water-Based</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Viscosity / Weight</label>
        <input type="text" name="viscosity" class="form-control" placeholder="e.g. 5W-30, 80W-90, 10W">
    </div>

    <div class="col-md-6">
        <label>Industry Standard / Certification</label>
        <select name="standard" class="form-select">
            <option value="">Select</option>
            <option value="API SL/SM/SN/SP">API SL/SM/SN/SP</option>
            <option value="JASO MA / MA2 / MB / FC / FD">JASO MA / MA2 / MB / FC / FD</option>
            <option value="DOT 3/4/5/5.1">DOT 3/4/5/5.1</option>
            <option value="ACEA">ACEA</option>
            <option value="OEM Specific / Manufacturer Spec">OEM Specific / Manufacturer Spec</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Primary Application / Use</label>
        <select name="application" class="form-select">
            <option value="">Select</option>
            <option value="Motorcycle Engine">Motorcycle Engine</option>
            <option value="Transmission / Gearbox">Transmission / Gearbox</option>
            <option value="Suspension / Forks">Suspension / Forks</option>
            <option value="Brakes / Hydraulic">Brakes / Hydraulic</option>
            <option value="Clutch System">Clutch System</option>
            <option value="Cooling System / Radiator">Cooling System / Radiator</option>
            <option value="Chain / Drivetrain">Chain / Drivetrain</option>
            <option value="Fuel System">Fuel System</option>
            <option value="Multi-Purpose / General Lubrication">Multi-Purpose / General Lubrication</option>
            <option value="Other Specialty Use">Other Specialty Use</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Additives / Features</label>
        <input type="text" name="additives" class="form-control" placeholder="e.g. Anti-Wear, Anti-Foam, Rust Inhibitor, High-Temperature">
    </div>

    <div class="col-md-6">
        <label>Packaging / Quantity</label>
        <input type="text" name="packaging" class="form-control" placeholder="e.g. 1L Bottle, 500ml Can, 150ml Tube">
    </div>

    <div class="col-md-6">
        <label>Color / Appearance</label>
        <input type="text" name="color" class="form-control" placeholder="e.g. Amber, Green, Transparent, Blue">
    </div>

    <div class="col-md-6">
        <label>Odor / Scent</label>
        <input type="text" name="odor" class="form-control" placeholder="e.g. Neutral, Mineral, Chemical, Fragrant">
    </div>

    <div class="col-md-6">
        <label>Manufacturer / Brand</label>
        <input type="text" name="brand" class="form-control" placeholder="e.g. Motul, Castrol, Liqui Moly, Yamalube">
    </div>

</div>
`;
