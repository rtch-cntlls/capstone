export const bodySpecs = `
<h5 class="mb-3">Body & Frame Specifications</h5>
<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label>Frame Type</label>
        <select name="frame_type" class="form-select">
            <option value="">Select</option>
            <option value="Diamond">Diamond</option>
            <option value="Trellis">Trellis</option>
            <option value="Perimeter">Perimeter</option>
            <option value="Backbone">Backbone</option>
            <option value="Underbone">Underbone</option>
            <option value="Cradle">Cradle</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Seat Height (mm)</label>
        <input type="number" name="seat_height" class="form-control" placeholder="e.g. 780">
    </div>
    <div class="col-md-6">
        <label>Weight Limit (kg)</label>
        <input type="number" name="weight_limit" class="form-control" placeholder="e.g. 150">
    </div>
    
    <h6 class="fw-bold">Body Panels & Fairings</h6>
        <div class="col-md-6 m-0 mt-0">
            <label>Panel Type</label>
            <select name="panel_type" class="form-select">
                <option value="">Select</option>
                <option value="Front Fairing">Front Fairing</option>
                <option value="Side Fairing">Side Fairing</option>
                <option value="Rear Fairing">Rear Fairing</option>
                <option value="Under Cowl">Under Cowl</option>
                <option value="Leg Shield">Leg Shield</option>
            </select>
        </div>
        <div class="col-md-6 m-0">
            <label>Panel Material</label>
            <select name="panel_material" class="form-select">
                <option value="">Select</option>
                <option value="ABS Plastic">ABS Plastic</option>
                <option value="Polypropylene">Polypropylene</option>
                <option value="Carbon Fiber">Carbon Fiber</option>
                <option value="Fiberglass">Fiberglass</option>
                <option value="Metal">Metal</option>
            </select>
        </div>
        <div class="col-md-6">
            <label>Includes Decals</label>
            <select name="includes_decals" class="form-select">
                <option value="">Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="col-md-6">
            <label>Mounting Type</label>
            <input type="text" name="mounting_type" class="form-control" placeholder="e.g. Bolt-on, Clip-on">
        </div>

    <h6 class="fw-bold">Seat & Cover</h6>
        <div class="col-md-6 m-0">
            <label>Seat Type</label>
            <select name="seat_type" class="form-select">
                <option value="">Select</option>
                <option value="Single Seat">Single Seat</option>
                <option value="Dual Seat">Dual Seat</option>
                <option value="Split Seat">Split Seat</option>
                <option value="Racing Seat">Racing Seat</option>
            </select>
        </div>
        <div class="col-md-6 m-0">
            <label>Seat Material</label>
            <select name="seat_material" class="form-select">
                <option value="">Select</option>
                <option value="Leather">Leather</option>
                <option value="Synthetic Leather">Synthetic Leather</option>
                <option value="Vinyl">Vinyl</option>
                <option value="PU Leather">PU Leather</option>
            </select>
        </div>
        <div class="col-md-6">
            <label>Includes Seat Cover</label>
            <select name="includes_seat_cover" class="form-select">
                <option value="">Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

    <h6 class="fw-bold">Fenders, Guards & Accessories</h6>
        <div class="col-md-6">
            <label>Fender Type</label>
            <select name="fender_type" class="form-select">
                <option value="">Select</option>
                <option value="Front Fender">Front Fender</option>
                <option value="Rear Fender">Rear Fender</option>
                <option value="Hugger Fender">Hugger Fender</option>
                <option value="Mud Guard">Mud Guard</option>
            </select>
        </div>
        <div class="col-md-6">
            <label>Fender Material</label>
            <select name="fender_material" class="form-select">
                <option value="">Select</option>
                <option value="Plastic">Plastic</option>
                <option value="Metal">Metal</option>
                <option value="Carbon Fiber">Carbon Fiber</option>
                <option value="Fiberglass">Fiberglass</option>
            </select>
        </div>
        <div class="col-md-6">
            <label>Includes Mounting Bolts</label>
            <select name="includes_mounting_bolts" class="form-select">
                <option value="">Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="col-md-6">
            <label>Body Accessory Type</label>
            <select name="body_accessory_type" class="form-select">
                <option value="">Select</option>
                <option value="Crash Guard">Crash Guard</option>
                <option value="Frame Slider">Frame Slider</option>
                <option value="Skid Plate">Skid Plate</option>
                <option value="Grab Bar">Grab Bar</option>
                <option value="Belly Pan">Belly Pan</option>
                <option value="Tank Cover">Tank Cover</option>
                <option value="Side Cover">Side Cover</option>
                <option value="Chain Cover">Chain Cover</option>
            </select>
        </div>
</div>

`;
