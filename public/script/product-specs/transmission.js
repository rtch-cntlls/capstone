export const transmissionSpecs = `
<div class="row g-3 mb-3">

    <!-- TRANSMISSION TYPE -->
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
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Number of Gears</label>
        <input type="text" name="gear_count" class="form-control" placeholder="e.g. 4, 5, 6-Speed, Automatic">
    </div>

    <div class="col-md-6">
        <label>Gear Shift Pattern / Operation</label>
        <input type="text" name="shift_pattern" class="form-control" placeholder="e.g. 1-N-2-3-4-5-6, Sequential">
    </div>

    <div class="col-md-6">
        <label>Quick Shifter / Auto-Blip Support</label>
        <select name="quick_shifter" class="form-select">
            <option value="">Select</option>
            <option value="None">None</option>
            <option value="Factory Quick Shifter">Factory Quick Shifter</option>
            <option value="Aftermarket Quick Shifter">Aftermarket Quick Shifter</option>
            <option value="Auto-Blip Only">Auto-Blip Only</option>
        </select>
    </div>

    <!-- CLUTCH -->
    <div class="col-md-6">
        <label>Clutch Type</label>
        <select name="clutch_type" class="form-select">
            <option value="">Select</option>
            <option value="Wet Multi-Plate">Wet Multi-Plate</option>
            <option value="Dry Multi-Plate">Dry Multi-Plate</option>
            <option value="Automatic Centrifugal">Automatic Centrifugal</option>
            <option value="Assist & Slipper Clutch">Assist & Slipper Clutch</option>
            <option value="Hydraulic">Hydraulic</option>
            <option value="Cable-Actuated">Cable-Actuated</option>
            <option value="Performance / Racing Clutch">Performance / Racing Clutch</option>
            <option value="Other">Other</option>
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
            <option value="Composite / Performance">Composite / Performance</option>
            <option value="Other">Other</option>
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
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Sprocket / Drive Component Material</label>
        <select name="sprocket_material" class="form-select">
            <option value="">Select</option>
            <option value="Steel">Steel</option>
            <option value="Stainless Steel">Stainless Steel</option>
            <option value="Aluminum">Aluminum</option>
            <option value="CNC Alloy">CNC Alloy</option>
            <option value="Hardened Steel">Hardened Steel</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Chain / Belt Size & Type</label>
        <input type="text" name="chain_belt_size" class="form-control" placeholder="e.g. 520 O-Ring, 530 X-Ring, Kevlar Belt">
    </div>

    <div class="col-md-6">
        <label>Drive Component Brand / Series</label>
        <input type="text" name="drive_brand" class="form-control" placeholder="e.g. DID, RK, Enuma">
    </div>

    <!-- LUBRICATION & CAPACITY -->
    <div class="col-md-6">
        <label>Lubrication Type</label>
        <select name="lubrication_type" class="form-select">
            <option value="">Select</option>
            <option value="Shared Engine Oil">Shared Engine Oil</option>
            <option value="Separate Gear Oil">Separate Gear Oil</option>
            <option value="Scooter Gear Oil">Scooter Gear Oil</option>
            <option value="Dry">Dry</option>
            <option value="Synthetic Gear Oil">Synthetic Gear Oil</option>
            <option value="Mineral Gear Oil">Mineral Gear Oil</option>
            <option value="High Performance / Racing">High Performance / Racing</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Oil / Lubricant Capacity</label>
        <input type="text" name="lubricant_capacity" class="form-control" placeholder="e.g. 0.8L, 1.2L">
    </div>

    <!-- CVT COMPONENTS -->
    <div class="col-md-6">
        <label>Variator Type / Drive Face</label>
        <input type="text" name="variator_drive_face" class="form-control" placeholder="e.g. OEM, Performance, Torque Drive">
    </div>

    <div class="col-md-6">
        <label>CVT Belt / Drive Component Type</label>
        <input type="text" name="cvt_belt_type" class="form-control" placeholder="e.g. OEM Rubber, Kevlar Reinforced, Aramid Fiber">
    </div>

    <!-- GENERAL PRODUCT INFO -->
    <div class="col-md-6">
        <label>Manufacturer / Brand</label>
        <input type="text" name="brand" class="form-control" placeholder="e.g. Honda, Yamaha, DID, RK, Enuma">
    </div>

</div>
`;
