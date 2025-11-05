export const transmissionSpecs = `
<h5>Transmission & Drivetrain</h5>
<div class="row g-3 mb-2">
    <div class="col-md-6">
        <label>Transmission Type</label>
        <select name="transmission_type" class="form-select">
            <option value="">Select</option>
            <option value="Manual">Manual</option>
            <option value="Automatic">Automatic</option>
            <option value="Semi-Automatic">Semi-Automatic</option>
            <option value="CVT (Continuously Variable Transmission)">CVT (Continuously Variable Transmission)</option>
            <option value="Dual Clutch Transmission (DCT)">Dual Clutch Transmission (DCT)</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Gear Count</label>
        <select name="gear_count" class="form-select">
            <option value="">Select</option>
            <option value="3-Speed">3-Speed</option>
            <option value="4-Speed">4-Speed</option>
            <option value="5-Speed">5-Speed</option>
            <option value="6-Speed">6-Speed</option>
            <option value="Automatic (No Gears)">Automatic (No Gears)</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Drive Type</label>
        <select name="drive_type" class="form-select">
            <option value="">Select</option>
            <option value="Chain Drive">Chain Drive</option>
            <option value="Belt Drive">Belt Drive</option>
            <option value="Shaft Drive">Shaft Drive</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Clutch Type</label>
        <select name="clutch_type" class="form-select">
            <option value="">Select</option>
            <option value="Wet Multi-Plate">Wet Multi-Plate</option>
            <option value="Dry Multi-Plate">Dry Multi-Plate</option>
            <option value="Centrifugal">Centrifugal</option>
            <option value="Automatic Centrifugal">Automatic Centrifugal</option>
            <option value="Slipper Clutch">Slipper Clutch</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Final Drive Ratio</label>
        <input type="text" name="final_drive_ratio" class="form-control" placeholder="e.g. 2.73">
    </div>
    <div class="col-md-6">
        <label>Front Sprocket Teeth</label>
        <input type="number" name="front_sprocket_teeth" class="form-control" placeholder="e.g. 14">
    </div>
    <div class="col-md-6">
        <label>Rear Sprocket Teeth</label>
        <input type="number" name="rear_sprocket_teeth" class="form-control" placeholder="e.g. 42">
    </div>
    <div class="col-md-6">
        <label>Chain Size</label>
        <select name="chain_size" class="form-select">
            <option value="">Select</option>
            <option value="420">420</option>
            <option value="428">428</option>
            <option value="520">520</option>
            <option value="525">525</option>
            <option value="530">530</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Gear Shift Pattern</label>
        <select name="shift_pattern" class="form-select">
            <option value="">Select</option>
            <option value="1-N-2-3-4-5-6">1-N-2-3-4-5-6</option>
            <option value="N-1-2-3-4">N-1-2-3-4</option>
            <option value="Automatic (No Shifting)">Automatic (No Shifting)</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Lubrication Type</label>
        <select name="transmission_lubrication" class="form-select">
            <option value="">Select</option>
            <option value="Oil Bath">Oil Bath</option>
            <option value="Grease">Grease</option>
            <option value="Dry (No Oil)">Dry (No Oil)</option>
        </select>
    </div>
</div>
`;
