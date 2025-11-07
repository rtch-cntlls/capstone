export const transmissionSpecs = `
<h5 class="fw-bold">Transmission & Drivetrain</h5>
<div class="row g-3 mb-2">

    <!-- TRANSMISSION -->
    <div class="col-md-6">
        <label>Transmission Type</label>
        <select name="transmission_type" class="form-select">
            <option value="">Select</option>
            <option value="Manual">Manual</option>
            <option value="Semi-Automatic">Semi-Automatic</option>
            <option value="Automatic CVT">Automatic CVT</option>
            <option value="Automatic Torque Converter">Automatic Torque Converter</option>
            <option value="Dual Clutch Transmission">Dual Clutch Transmission</option>
            <option value="Electric Single Reduction">Electric Single Reduction</option>
            <option value="Racing Sequential">Racing Sequential</option>
            <option value="Manual with Quick Shifter">Manual with Quick Shifter</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Gear Count</label>
        <select name="gear_count" class="form-select">
            <option value="">Select</option>
            <option value="1-Speed">1-Speed</option>
            <option value="2-Speed">2-Speed</option>
            <option value="3-Speed">3-Speed</option>
            <option value="4-Speed">4-Speed</option>
            <option value="5-Speed">5-Speed</option>
            <option value="6-Speed">6-Speed</option>
            <option value="7-Speed">7-Speed</option>
            <option value="Automatic">Automatic</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Gear Shift Pattern</label>
        <select name="shift_pattern" class="form-select">
            <option value="">Select</option>
            <option value="1-N-2-3-4-5-6">1-N-2-3-4-5-6</option>
            <option value="N-1-2-3-4">N-1-2-3-4</option>
            <option value="N-1-2-3-4-5">N-1-2-3-4-5</option>
            <option value="Reverse Shift">Reverse Shift</option>
            <option value="Automatic">Automatic</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Quick Shifter / Auto-Blip</label>
        <select name="quick_shifter" class="form-select">
            <option value="">Select</option>
            <option value="None">None</option>
            <option value="Factory Quick Shifter">Factory Quick Shifter</option>
            <option value="Aftermarket Quick Shifter Up">Aftermarket Quick Shifter Up</option>
            <option value="Aftermarket Quick Shifter Up & Down">Aftermarket Quick Shifter Up & Down</option>
            <option value="Auto-Blip Only">Auto-Blip Only</option>
        </select>
    </div>

    <!-- CLUTCH SYSTEM -->
    <div class="col-md-6">
        <label>Clutch Type</label>
        <select name="clutch_type" class="form-select">
            <option value="">Select</option>
            <option value="Wet Multi-Plate">Wet Multi-Plate</option>
            <option value="Dry Multi-Plate">Dry Multi-Plate</option>
            <option value="Automatic Centrifugal">Automatic Centrifugal</option>
            <option value="Assist & Slipper Clutch">Assist & Slipper Clutch</option>
            <option value="Rekluse Auto Clutch">Rekluse Auto Clutch</option>
            <option value="Hydraulic Clutch">Hydraulic Clutch</option>
            <option value="Cable-Actuated Clutch">Cable-Actuated Clutch</option>
            <option value="Performance / Racing Clutch">Performance / Racing Clutch</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Clutch Plate Material</label>
        <select name="clutch_plate_material" class="form-select">
            <option value="">Select</option>
            <option value="Organic Fiber">Organic Fiber</option>
            <option value="Kevlar">Kevlar</option>
            <option value="Carbon">Carbon</option>
            <option value="Sintered Metal">Sintered Metal</option>
            <option value="Performance Composite">Performance Composite</option>
        </select>
    </div>

    <!-- DRIVE TYPE -->
    <div class="col-md-6">
        <label>Drive Type</label>
        <select name="drive_type" class="form-select">
            <option value="">Select</option>
            <option value="Chain Drive">Chain Drive</option>
            <option value="Belt Drive">Belt Drive</option>
            <option value="Shaft Drive">Shaft Drive</option>
            <option value="Gear Drive">Gear Drive</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Driveshaft Type</label>
        <select name="driveshaft_type" class="form-select">
            <option value="">Select</option>
            <option value="Standard Shaft">Standard Shaft</option>
            <option value="Cardan Joint">Cardan Joint</option>
            <option value="Universal Joint">Universal Joint</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Final Drive Housing Type</label>
        <select name="final_drive_housing" class="form-select">
            <option value="">Select</option>
            <option value="Standard Gear Housing">Standard Gear Housing</option>
            <option value="High-Performance Gear Housing">High-Performance Gear Housing</option>
            <option value="Reinforced Housing">Reinforced Housing</option>
        </select>
    </div>

    <!-- SPROCKET & CHAIN -->
    <div class="col-md-6">
        <label>Front Sprocket Teeth</label>
        <input type="number" name="front_sprocket_teeth" class="form-control" placeholder="e.g. 14">
    </div>

    <div class="col-md-6">
        <label>Rear Sprocket Teeth</label>
        <input type="number" name="rear_sprocket_teeth" class="form-control" placeholder="e.g. 42">
    </div>

    <div class="col-md-6">
        <label>Final Drive Ratio</label>
        <input type="text" name="final_drive_ratio" class="form-control" placeholder="e.g. 2.73">
    </div>

    <div class="col-md-6">
        <label>Sprocket Material</label>
        <select name="sprocket_material" class="form-select">
            <option value="">Select</option>
            <option value="Steel">Steel</option>
            <option value="Stainless Steel">Stainless Steel</option>
            <option value="Aluminum">Aluminum</option>
            <option value="CNC Alloy">CNC Alloy</option>
            <option value="Hardened Steel">Hardened Steel</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Chain Size & Type</label>
        <select name="chain_size" class="form-select">
            <option value="">Select</option>
            <option value="415">415</option>
            <option value="420">420</option>
            <option value="428">428</option>
            <option value="520">520</option>
            <option value="525">525</option>
            <option value="530">530</option>
            <option value="Non-O-Ring">Non-O-Ring</option>
            <option value="O-Ring">O-Ring</option>
            <option value="X-Ring">X-Ring</option>
            <option value="Z-Ring">Z-Ring</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Chain Brand / Series</label>
        <input type="text" name="chain_brand" class="form-control" placeholder="e.g. DID 428HD, RK Takasago, Enuma">
    </div>

    <!-- LUBRICATION -->
    <div class="col-md-6">
        <label>Lubrication Type</label>
        <select name="transmission_lubrication" class="form-select">
            <option value="">Select</option>
            <option value="Shared Engine Oil">Shared Engine Oil</option>
            <option value="Separate Gear Oil">Separate Gear Oil</option>
            <option value="Scooter Gear Oil">Scooter Gear Oil</option>
            <option value="Dry">Dry</option>
            <option value="Synthetic Gear Oil">Synthetic Gear Oil</option>
            <option value="Mineral Gear Oil">Mineral Gear Oil</option>
            <option value="Racing / High Performance">Racing / High Performance</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Transmission Oil Capacity (L)</label>
        <input type="number" step="0.1" name="transmission_oil_capacity" class="form-control" placeholder="e.g. 0.8">
    </div>

    <!-- CVT COMPONENTS -->
    <div class="col-md-6">
        <label>Variator Type</label>
        <select name="variator_type" class="form-select">
            <option value="">Select</option>
            <option value="OEM">OEM</option>
            <option value="Performance Variator">Performance Variator</option>
            <option value="Torque Drive Variator">Torque Drive Variator</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>CVT Drive Face Type</label>
        <select name="cvt_drive_face" class="form-select">
            <option value="">Select</option>
            <option value="Standard">Standard</option>
            <option value="Lightweight Racing">Lightweight Racing</option>
            <option value="High-Flow / Ventilated">High-Flow / Ventilated</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Roller Weight (grams)</label>
        <input type="number" step="0.1" name="roller_weight" class="form-control" placeholder="e.g. 10">
    </div>

    <div class="col-md-6">
        <label>Clutch Bell Type</label>
        <select name="clutch_bell_type" class="form-select">
            <option value="">Select</option>
            <option value="OEM Steel">OEM Steel</option>
            <option value="Lightweight CNC">Lightweight CNC</option>
            <option value="Ventilated / Wave Type">Ventilated / Wave Type</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Center Spring Rate</label>
        <input type="text" name="center_spring_rate" class="form-control" placeholder="e.g. 1000rpm">
    </div>

    <div class="col-md-6">
        <label>CVT Belt Type</label>
        <select name="cvt_belt_type" class="form-select">
            <option value="">Select</option>
            <option value="OEM Rubber">OEM Rubber</option>
            <option value="Kevlar Reinforced">Kevlar Reinforced</option>
            <option value="Aramid Fiber">Aramid Fiber</option>
            <option value="Heavy Duty">Heavy Duty</option>
        </select>
    </div>

</div>
`;
