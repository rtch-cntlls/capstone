export const engineSpecs = `
<h5 class="fw-bold">Engine Components</h5>
<div class="row g-3 mb-2">

    <div class="col-md-6">
        <label>Engine Layout</label>
        <select name="engine_layout" class="form-select">
            <option value="">Select</option>
            <option value="Single Cylinder">Single Cylinder</option>
            <option value="Parallel Twin 180°">Parallel Twin 180°</option>
            <option value="Parallel Twin 270°">Parallel Twin 270°</option>
            <option value="V-Twin">V-Twin</option>
            <option value="Inline 3">Inline 3</option>
            <option value="Inline 4">Inline 4</option>
            <option value="Boxer">Boxer</option>
            <option value="V4">V4</option>
            <option value="Rotary">Rotary</option>
            <option value="Electric Motor">Electric Motor</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Engine Cycle / Type</label>
        <select name="engine_type_cycle" class="form-select">
            <option value="">Select</option>
            <option value="4-Stroke">4-Stroke</option>
            <option value="2-Stroke">2-Stroke</option>
            <option value="4-Stroke (Forced Induction)">4-Stroke (Forced Induction)</option>
            <option value="Hybrid">Hybrid</option>
            <option value="Electric">Electric</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Displacement (cc)</label>
        <input type="number" name="displacement" class="form-control" placeholder="e.g. 155">
    </div>

    <div class="col-md-6">
        <label>Bore x Stroke (mm)</label>
        <input type="text" name="bore_stroke" class="form-control" placeholder="e.g. 58.0 x 58.7">
    </div>

    <div class="col-md-6">
        <label>Compression Ratio</label>
        <input type="text" name="compression_ratio" class="form-control" placeholder="e.g. 10.5:1">
    </div>

    <div class="col-md-6">
        <label>Valves Per Cylinder (VPC)</label>
        <select name="valves" class="form-select">
            <option value="">Select</option>
            <option value="2 VPC">2 VPC</option>
            <option value="3 VPC">3 VPC</option>
            <option value="4 VPC">4 VPC</option>
            <option value="5 VPC">5 VPC</option>
            <option value="Aftermarket Big Valve Kit">Aftermarket Big Valve Kit</option>
            <option value="N/A (2-Stroke)">N/A (2-Stroke)</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Valve Train System</label>
        <select name="valve_system" class="form-select">
            <option value="">Select</option>
            <option value="SOHC">SOHC</option>
            <option value="DOHC">DOHC</option>
            <option value="OHV">OHV</option>
            <option value="Desmodromic">Desmodromic</option>
            <option value="Variable Valve Timing">Variable Valve Timing</option>
            <option value="Aftermarket Camshafts">Aftermarket Camshafts</option>
            <option value="N/A (2-Stroke)">N/A (2-Stroke)</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Camshaft Drive Type</label>
        <select name="camshaft_drive" class="form-select">
            <option value="">Select</option>
            <option value="Timing Chain">Timing Chain</option>
            <option value="Timing Belt">Timing Belt</option>
            <option value="Gear Driven">Gear Driven</option>
            <option value="Pushrod">Pushrod</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fuel Delivery System</label>
        <select name="fuel_system" class="form-select">
            <option value="">Select</option>
            <option value="Carburetor">Carburetor</option>
            <option value="Fuel Injection (FI)">Fuel Injection (FI)</option>
            <option value="EFI with O2 Sensor">EFI with O2 Sensor</option>
            <option value="EFI with MAP Sensor">EFI with MAP Sensor</option>
            <option value="EFI with Throttle-by-Wire">EFI with Throttle-by-Wire</option>
            <option value="Electric (Battery Controlled)">Electric (Battery Controlled)</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>ECU / Engine Control Unit Type</label>
        <select name="ecu_type" class="form-select">
            <option value="">Select</option>
            <option value="Stock ECU">Stock ECU</option>
            <option value="Reflashed ECU">Reflashed ECU</option>
            <option value="Piggyback ECU">Piggyback ECU</option>
            <option value="Standalone ECU">Standalone ECU</option>
            <option value="Aftermarket Programmable ECU">Aftermarket Programmable ECU</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Cooling Type</label>
        <select name="engine_cooling" class="form-select">
            <option value="">Select</option>
            <option value="Air Cooled">Air Cooled</option>
            <option value="Oil Cooled">Oil Cooled</option>
            <option value="Air + Oil Cooled">Air + Oil Cooled</option>
            <option value="Liquid Cooled">Liquid Cooled</option>
            <option value="Liquid + Oil Cooled">Liquid + Oil Cooled</option>
            <option value="Aftermarket High Capacity Radiator">Aftermarket High Capacity Radiator</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Starter Type</label>
        <select name="starter_type" class="form-select">
            <option value="">Select</option>
            <option value="Electric Start Only">Electric Start Only</option>
            <option value="Kick Start Only">Kick Start Only</option>
            <option value="Electric & Kick">Electric & Kick</option>
            <option value="Integrated ACG Starter">Integrated ACG Starter</option>
            <option value="Push Start">Push Start</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Ignition System</label>
        <select name="ignition_type" class="form-select">
            <option value="">Select</option>
            <option value="CDI">CDI</option>
            <option value="TCI">TCI</option>
            <option value="ECU Controlled">ECU Controlled</option>
            <option value="Magneto Ignition">Magneto Ignition</option>
            <option value="Aftermarket Performance CDI/ECU">Aftermarket Performance CDI/ECU</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Cylinder / Piston Type</label>
        <select name="piston_type" class="form-select">
            <option value="">Select</option>
            <option value="Stock Piston">Stock Piston</option>
            <option value="High Compression Piston">High Compression Piston</option>
            <option value="Forged Piston">Forged Piston</option>
            <option value="Ceramic Liner">Ceramic Liner</option>
            <option value="Nikasil Plated Cylinder">Nikasil Plated Cylinder</option>
            <option value="Big Bore Kit Installed">Big Bore Kit Installed</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Crankcase Type</label>
        <select name="crankcase_type" class="form-select">
            <option value="">Select</option>
            <option value="Stock">Stock</option>
            <option value="Reinforced">Reinforced</option>
            <option value="Aftermarket">Aftermarket</option>
            <option value="Race Spec">Race Spec</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Engine Mounting Type</label>
        <select name="engine_mounting" class="form-select">
            <option value="">Select</option>
            <option value="Cradle Mounted">Cradle Mounted</option>
            <option value="Underbone Mounted">Underbone Mounted</option>
            <option value="Rubber Mounted">Rubber Mounted</option>
            <option value="Solid Mounted">Solid Mounted</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Clutch Type (Engine Side)</label>
        <select name="clutch_type_engine" class="form-select">
            <option value="">Select</option>
            <option value="Wet Multi-Plate">Wet Multi-Plate</option>
            <option value="Dry Multi-Plate">Dry Multi-Plate</option>
            <option value="Automatic Centrifugal">Automatic Centrifugal</option>
            <option value="Slipper / Assist Clutch">Slipper / Assist Clutch</option>
            <option value="Semi-Automatic">Semi-Automatic</option>
            <option value="DCT (Dual Clutch Transmission)">DCT (Dual Clutch Transmission)</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Engine Oil Capacity (L)</label>
        <input type="number" step="0.1" name="oil_capacity" class="form-control" placeholder="e.g. 1.0">
    </div>

    <div class="col-md-6">
        <label>Peak Power / Output (HP or PS)</label>
        <input type="text" name="power_output" class="form-control" placeholder="e.g. 15 HP @ 8500 rpm">
    </div>

    <div class="col-md-6">
        <label>Peak Torque (Nm)</label>
        <input type="text" name="torque" class="form-control" placeholder="e.g. 13 Nm @ 7000 rpm">
    </div>

    <div class="col-md-6">
        <label>Redline / Max RPM</label>
        <input type="text" name="redline" class="form-control" placeholder="e.g. 9500 RPM">
    </div>

    <div class="col-md-6">
        <label>Idle Speed (RPM)</label>
        <input type="text" name="idle_speed" class="form-control" placeholder="e.g. 1300 RPM">
    </div>

    <div class="col-md-6">
        <label>Engine Condition / Modification Level</label>
        <select name="modification_level" class="form-select">
            <option value="">Select</option>
            <option value="Stock / OEM">Stock / OEM</option>
            <option value="Stage 1 Tuned">Stage 1 Tuned</option>
            <option value="Stage 2 Tuned">Stage 2 Tuned</option>
            <option value="Big Bore Kit / Oversized Piston">Big Bore Kit / Oversized Piston</option>
            <option value="Racing / Fully Built Engine">Racing / Fully Built Engine</option>
            <option value="Rebuilt / Modified Stock">Rebuilt / Modified Stock</option>
            <option value="Other">Other</option>
        </select>
    </div>

</div>
`;
