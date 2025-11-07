export const exhaustSpecs = `
<h5 class="fw-bold">Exhaust System</h5>
<div class="row g-3 mb-2">

    <div class="col-md-6">
        <label>Exhaust Material</label>
        <select name="exhaust_material" class="form-select">
            <option value="">Select</option>
            <option value="Mild Steel">Mild Steel</option>
            <option value="304 Stainless Steel">304 Stainless Steel</option>
            <option value="316 Stainless Steel">316 Stainless Steel</option>
            <option value="Titanium">Titanium</option>
            <option value="Carbon Fiber">Carbon Fiber</option>
            <option value="Aluminum">Aluminum</option>
            <option value="Chromed Steel">Chromed Steel</option>
            <option value="Ceramic Coated">Ceramic Coated</option>
            <option value="Exhaust Wrapped">Exhaust Wrapped</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Header Configuration</label>
        <select name="header_configuration" class="form-select">
            <option value="">Select</option>
            <option value="1-into-1">1-into-1</option>
            <option value="2-into-1">2-into-1</option>
            <option value="2-into-2">2-into-2</option>
            <option value="3-into-1">3-into-1</option>
            <option value="4-into-1">4-into-1</option>
            <option value="4-into-2-into-1">4-into-2-into-1</option>
            <option value="Crossover Pipe / H-Pipe">Crossover Pipe / H-Pipe</option>
            <option value="Custom Length / Stepped">Custom Length / Stepped</option>
            <option value="Stock with Cat Converter">Stock with Cat Converter</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>System Type</label>
        <select name="muffler_type" class="form-select">
            <option value="">Select</option>
            <option value="Standard / OEM">Standard / OEM</option>
            <option value="Slip-On Muffler Only">Slip-On Muffler Only</option>
            <option value="Full System">Full System</option>
            <option value="Header Only">Header Only</option>
            <option value="Shorty / Underbelly">Shorty / Underbelly</option>
            <option value="High-Mount / Scrambler">High-Mount / Scrambler</option>
            <option value="Aftermarket Sport Tuned">Aftermarket Sport Tuned</option>
            <option value="Open Pipe">Open Pipe</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Pipe Diameter (mm)</label>
        <input type="text" name="pipe_diameter" class="form-control" placeholder="e.g. 28 or 45">
    </div>

    <div class="col-md-6">
        <label>Sound Management / Baffle</label>
        <select name="sound_management" class="form-select">
            <option value="">Select</option>
            <option value="Fixed Baffle">Fixed Baffle</option>
            <option value="Removable dB Killer / Baffle">Removable dB Killer / Baffle</option>
            <option value="No Baffle">No Baffle</option>
            <option value="Exhaust Valve System">Exhaust Valve System</option>
            <option value="Adjustable / Tunable">Adjustable / Tunable</option>
            <option value="Custom Packing / Fiberglass">Custom Packing / Fiberglass</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Exhaust Tip Style</label>
        <select name="exhaust_tip_style" class="form-select">
            <option value="">Select</option>
            <option value="Round">Round</option>
            <option value="Slash Cut">Slash Cut</option>
            <option value="Turn Down">Turn Down</option>
            <option value="Dual Outlet">Dual Outlet</option>
            <option value="Underbelly">Underbelly</option>
            <option value="Upswept">Upswept</option>
            <option value="Side Exit">Side Exit</option>
            <option value="Custom Shape">Custom Shape</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Mounting Position</label>
        <select name="mounting_position" class="form-select">
            <option value="">Select</option>
            <option value="Side Mount">Side Mount</option>
            <option value="Underbelly Mount">Underbelly Mount</option>
            <option value="High Mount">High Mount</option>
            <option value="Low Mount">Low Mount</option>
            <option value="Dual Side">Dual Side</option>
            <option value="Single Exit">Single Exit</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Emission Control Device</label>
        <select name="emission_control" class="form-select">
            <option value="">Select</option>
            <option value="Catalytic Converter">Catalytic Converter</option>
            <option value="O2 Sensor Bung">O2 Sensor Bung</option>
            <option value="Exhaust Gas Recirculation (EGR)">Exhaust Gas Recirculation (EGR)</option>
            <option value="Secondary Air Injection (PAIR)">Secondary Air Injection (PAIR)</option>
            <option value="None / Cat Deleted">None / Cat Deleted</option>
            <option value="Lambda Sensor Delete">Lambda Sensor Delete</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Heat Shield Type</label>
        <select name="heat_shield_type" class="form-select">
            <option value="">Select</option>
            <option value="OEM Metal Shield">OEM Metal Shield</option>
            <option value="Carbon Fiber Shield">Carbon Fiber Shield</option>
            <option value="Stainless Mesh Guard">Stainless Mesh Guard</option>
            <option value="Ceramic Coated">Ceramic Coated</option>
            <option value="Custom Wrap">Custom Wrap</option>
            <option value="None">None</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Regulatory Compliance (PH)</label>
        <select name="emission_compliance" class="form-select">
            <option value="">Select</option>
            <option value="LTO Compliant">LTO Compliant</option>
            <option value="LTO Non-Compliant">LTO Non-Compliant</option>
            <option value="Euro 3 Standard">Euro 3 Standard</option>
            <option value="Euro 4 Standard">Euro 4 Standard</option>
            <option value="Euro 5 Standard">Euro 5 Standard</option>
            <option value="SAE J2825 Compliant">SAE J2825 Compliant</option>
            <option value="Race Use Only">Race Use Only</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Sound Level (dB)</label>
        <input type="text" name="sound_level" class="form-control" placeholder="e.g. 85 or 100+">
    </div>

    <div class="col-md-6">
        <label>Exhaust Brand / Manufacturer</label>
        <input type="text" name="exhaust_brand" class="form-control" placeholder="e.g. Yoshimura, Akrapovic, Faito, DBS">
    </div>

</div>
`;
