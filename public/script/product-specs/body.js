export const bodySpecs = `
<h5 class="mb-3">Body & Frame</h5>
<div class="row g-3 mb-3">

    <div class="col-md-6">
        <label class="form-label fw-bold">Frame Type / Material</label>
        <select name="frame_type" class="form-select">
            <option value="">Select</option>
            <option value="Underbone Frame">Underbone Frame</option>
            <option value="Backbone Frame">Backbone Frame</option>
            <option value="Double Cradle Frame">Double Cradle Frame</option>
            <option value="Diamond Frame">Diamond Frame</option>
            <option value="Trellis Frame">Trellis Frame</option>
            <option value="Perimeter / Twin Spar Frame">Perimeter / Twin Spar Frame</option>
            <option value="Monocoque / Cast Aluminum Frame">Monocoque / Cast Aluminum Frame</option>
            <option value="Tubular Steel Frame">Tubular Steel Frame</option>
            <option value="Pressed Steel Frame">Pressed Steel Frame</option>
            <option value="Custom Fabricated Frame">Custom Fabricated Frame</option>
            <option value="Carbon Fiber Frame">Carbon Fiber Frame</option>
            <option value="Electric Scooter Frame">Electric Scooter Frame</option>
            <option value="Modified Stock Frame">Modified Stock Frame</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Frame Coating / Finish</label>
        <select name="frame_finish" class="form-select">
            <option value="">Select</option>
            <option value="Powder Coated">Powder Coated</option>
            <option value="Painted (OEM)">Painted (OEM)</option>
            <option value="Anodized Aluminum">Anodized Aluminum</option>
            <option value="Chromed / Polished Metal">Chromed / Polished Metal</option>
            <option value="Bare Metal / Brushed Steel">Bare Metal / Brushed Steel</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Subframe Type</label>
        <select name="subframe_type" class="form-select">
            <option value="">Select</option>
            <option value="Fixed Subframe">Fixed Subframe</option>
            <option value="Bolt-On Subframe">Bolt-On Subframe</option>
            <option value="Aluminum Subframe">Aluminum Subframe</option>
            <option value="Steel Tube Subframe">Steel Tube Subframe</option>
            <option value="Carbon Composite Subframe">Carbon Composite Subframe</option>
            <option value="Removable Tail Section">Removable Tail Section</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Chassis Reinforcement / Mod</label>
        <select name="chassis_reinforcement" class="form-select">
            <option value="">Select</option>
            <option value="Stock / OEM">Stock / OEM</option>
            <option value="Reinforced Weld Points">Reinforced Weld Points</option>
            <option value="Additional Bracing / Gussets">Additional Bracing / Gussets</option>
            <option value="Custom Stiffener Kit">Custom Stiffener Kit</option>
            <option value="Lightweight Drilled Frame">Lightweight Drilled Frame</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Wet Weight (kg)</label>
        <input type="number" step="0.1" name="wet_weight" class="form-control" placeholder="e.g. 110">
        <small class="form-text text-muted">Weight with all fluids.</small>
    </div>

    <div class="col-md-6">
        <label>Ground Clearance (mm)</label>
        <input type="number" name="ground_clearance" class="form-control" placeholder="e.g. 160">
    </div>

    <div class="col-md-6">
        <label>Wheelbase (mm)</label>
        <input type="number" name="wheelbase" class="form-control" placeholder="e.g. 1350">
    </div>

    <div class="col-md-6">
        <label>Seat Height (mm)</label>
        <input type="number" name="seat_height" class="form-control" placeholder="e.g. 780">
    </div>

    <div class="col-md-6">
        <label>Maximum Load Capacity (kg)</label>
        <input type="number" name="weight_limit" class="form-control" placeholder="e.g. 150">
        <small class="form-text text-muted">Rider + Passenger + Cargo.</small>
    </div>

    <div class="col-md-6">
        <label>Overall Body Length (mm)</label>
        <input type="number" name="overall_length" class="form-control" placeholder="e.g. 1950">
    </div>

    <div class="col-md-6">
        <label>Overall Width (mm)</label>
        <input type="number" name="overall_width" class="form-control" placeholder="e.g. 720">
    </div>

    <div class="col-md-6">
        <label>Overall Height (mm)</label>
        <input type="number" name="overall_height" class="form-control" placeholder="e.g. 1100">
    </div>

    <div class="col-md-6">
        <label>Component Category</label>
        <select name="panel_type_category" class="form-select">
            <option value="">Select</option>
            <option value="Full Fairing Set">Full Fairing Set</option>
            <option value="Front Cowl / Headlight Assembly">Front Cowl / Headlight Assembly</option>
            <option value="Side Panels / Mid-Fairing">Side Panels / Mid-Fairing</option>
            <option value="Leg Shield / Floorboard Panel">Leg Shield / Floorboard Panel</option>
            <option value="Tail Section / Seat Cowl">Tail Section / Seat Cowl</option>
            <option value="Inner Panels / Dash Cover">Inner Panels / Dash Cover</option>
            <option value="Fender / Mudguard">Fender / Mudguard</option>
            <option value="Lower Belly Pan / Under Cowl">Lower Belly Pan / Under Cowl</option>
            <option value="Fuel Tank Cover / Tank Shroud">Fuel Tank Cover / Tank Shroud</option>
            <option value="Body Kit / Aero Kit">Body Kit / Aero Kit</option>
            <option value="Custom Panel">Custom Panel</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Panel Material</label>
        <select name="panel_material" class="form-select">
            <option value="">Select</option>
            <option value="ABS Plastic">ABS Plastic</option>
            <option value="Polypropylene (PP)">Polypropylene (PP)</option>
            <option value="Carbon Fiber">Carbon Fiber</option>
            <option value="Fiberglass (FRP)">Fiberglass (FRP)</option>
            <option value="Aluminum Sheet">Aluminum Sheet</option>
            <option value="Polycarbonate / Acrylic">Polycarbonate / Acrylic</option>
            <option value="Painted Finish">Painted Finish</option>
            <option value="Unpainted / Primer">Unpainted / Primer</option>
            <option value="Chrome-Plated">Chrome-Plated</option>
            <option value="Hydro-Dipped Finish">Hydro-Dipped Finish</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Aesthetic Finish</label>
        <select name="finish_type" class="form-select">
            <option value="">Select</option>
            <option value="Gloss Finish">Gloss Finish</option>
            <option value="Matte Finish">Matte Finish</option>
            <option value="Metallic Finish">Metallic Finish</option>
            <option value="Pearl Finish">Pearl Finish</option>
            <option value="Includes Decals / Graphics">Includes Decals / Graphics</option>
            <option value="Custom Airbrush">Custom Airbrush</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Mounting / Installation Type</label>
        <input type="text" name="mounting_type" class="form-control" placeholder="e.g. Bolt-on, Clip-on, Quick Release">
    </div>
    <div class="col-md-6">
        <label>Seat Configuration</label>
        <select name="seat_config" class="form-select">
            <option value="">Select</option>
            <option value="Bench Seat">Bench Seat</option>
            <option value="One-Piece Dual Seat">One-Piece Dual Seat</option>
            <option value="Split Seat">Split Seat</option>
            <option value="Single / Solo Seat">Single / Solo Seat</option>
            <option value="Race Seat Cowl Installed">Race Seat Cowl Installed</option>
            <option value="Detachable Pillion Seat">Detachable Pillion Seat</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Seat Material / Feature</label>
        <select name="seat_material_feature" class="form-select">
            <option value="">Select</option>
            <option value="Synthetic Leather / Vinyl">Synthetic Leather / Vinyl</option>
            <option value="Genuine Leather">Genuine Leather</option>
            <option value="Anti-Slip / Textured Cover">Anti-Slip / Textured Cover</option>
            <option value="Airflow Mesh / 3D Fabric">Airflow Mesh / 3D Fabric</option>
            <option value="Custom Stitching / Pattern">Custom Stitching / Pattern</option>
            <option value="Gel Pad or Memory Foam">Gel Pad or Memory Foam</option>
            <option value="Heated Seat">Heated Seat</option>
            <option value="Waterproof / UV Resistant">Waterproof / UV Resistant</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Seat Comfort / Style</label>
        <select name="seat_style" class="form-select">
            <option value="">Select</option>
            <option value="Standard Comfort">Standard Comfort</option>
            <option value="Slim / Low Profile Seat">Slim / Low Profile Seat</option>
            <option value="Touring / Extra Cushion">Touring / Extra Cushion</option>
            <option value="Racing Firm Foam">Racing Firm Foam</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Includes Seat Cover Accessory</label>
        <select name="includes_seat_cover_accessory" class="form-select">
            <option value="">Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            <option value="OEM Seat Cover">OEM Seat Cover</option>
            <option value="Rain Cover Included">Rain Cover Included</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Protection Accessory</label>
        <select name="protection_accessory" class="form-select">
            <option value="">Select</option>
            <option value="Crash Guard / Engine Bar">Crash Guard / Engine Bar</option>
            <option value="Frame Slider">Frame Slider</option>
            <option value="Axle Slider / Fork Slider">Axle Slider / Fork Slider</option>
            <option value="Skid Plate / Bash Guard">Skid Plate / Bash Guard</option>
            <option value="Radiator Guard">Radiator Guard</option>
            <option value="Exhaust Protector">Exhaust Protector</option>
            <option value="Lever Guard">Lever Guard</option>
            <option value="Hand Guards">Hand Guards</option>
            <option value="Tank Pad / Knee Grip">Tank Pad / Knee Grip</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Luggage / Utility Accessory</label>
        <select name="luggage_accessory" class="form-select">
            <option value="">Select</option>
            <option value="Grab Bar / Handle">Grab Bar / Handle</option>
            <option value="Top Box Bracket / Base Plate">Top Box Bracket / Base Plate</option>
            <option value="Side Saddle Stay / Pannier Rack">Side Saddle Stay / Pannier Rack</option>
            <option value="Luggage Rack / Rear Carrier">Luggage Rack / Rear Carrier</option>
            <option value="Center Stand">Center Stand</option>
            <option value="Side Stand Extender">Side Stand Extender</option>
            <option value="Phone / GPS Mount">Phone / GPS Mount</option>
            <option value="Cup / Bottle Holder">Cup / Bottle Holder</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fender & License Plate Setup</label>
        <select name="fender_management" class="form-select">
            <option value="">Select</option>
            <option value="Stock Fender">Stock Fender</option>
            <option value="Fender Eliminator Kit">Fender Eliminator Kit</option>
            <option value="Rear Hugger">Rear Hugger</option>
            <option value="Fender Extension / Mud Flap">Fender Extension / Mud Flap</option>
            <option value="High-Mount Fender">High-Mount Fender</option>
            <option value="Adjustable Plate Holder">Adjustable Plate Holder</option>
            <option value="Integrated Tail Light Fender">Integrated Tail Light Fender</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fender Material</label>
        <select name="fender_material" class="form-select">
            <option value="">Select</option>
            <option value="ABS Plastic">ABS Plastic</option>
            <option value="Fiberglass (FRP)">Fiberglass (FRP)</option>
            <option value="Carbon Fiber">Carbon Fiber</option>
            <option value="Aluminum Alloy">Aluminum Alloy</option>
            <option value="Steel / Chrome">Steel / Chrome</option>
            <option value="Rubber / Reinforced Polymer">Rubber / Reinforced Polymer</option>
        </select>
    </div>

</div>
`;
