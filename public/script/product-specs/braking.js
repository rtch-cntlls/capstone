export const brakingSpecs = `
<h5 class="fw-bold">Braking System</h5>
<div class="row g-3 mb-3">

    <div class="col-md-6">
        <label>Front Brake System Type</label>
        <select name="front_brake_type" class="form-select">
            <option value="">Select</option>
            <option value="Drum Brake">Drum Brake</option>
            <option value="Hydraulic Single Disc">Hydraulic Single Disc</option>
            <option value="Hydraulic Dual Disc">Hydraulic Dual Disc</option>
            <option value="Drum and Disc Combination">Drum and Disc Combination</option>
            <option value="Aftermarket Big Rotor Kit">Aftermarket Big Rotor Kit</option>
            <option value="Radial Mount Caliper System">Radial Mount Caliper System</option>
            <option value="Linked Braking System">Linked Braking System</option>
            <option value="Regenerative Braking (EV)">Regenerative Braking (EV)</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Rear Brake System Type</label>
        <select name="rear_brake_type" class="form-select">
            <option value="">Select</option>
            <option value="Drum Brake">Drum Brake</option>
            <option value="Hydraulic Single Disc">Hydraulic Single Disc</option>
            <option value="Hydraulic Dual Disc">Hydraulic Dual Disc</option>
            <option value="Shaft-Driven Drum/Disc">Shaft-Driven Drum/Disc</option>
            <option value="Aftermarket Disc Conversion">Aftermarket Disc Conversion</option>
            <option value="Regenerative Braking (EV)">Regenerative Braking (EV)</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Brake Safety Feature</label>
        <select name="brake_safety_feature" class="form-select">
            <option value="">Select</option>
            <option value="None">None</option>
            <option value="Single-Channel ABS">Single-Channel ABS</option>
            <option value="Dual-Channel ABS">Dual-Channel ABS</option>
            <option value="Combi-Brake System (CBS)">Combi-Brake System (CBS)</option>
            <option value="CBS + Front ABS">CBS + Front ABS</option>
            <option value="Traction Control Integrated">Traction Control Integrated</option>
            <option value="Cornering ABS">Cornering ABS</option>
            <option value="EBS (Engine Braking System)">EBS (Engine Braking System)</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Primary Brake Caliper Brand</label>
        <input type="text" name="brake_caliper_brand" class="form-control" placeholder="e.g. Brembo, Nissin, Tokico, RCB, Faito, OEM">
    </div>

    <div class="col-md-6">
        <label>Front Rotor Design</label>
        <select name="front_rotor_design" class="form-select">
            <option value="">Select</option>
            <option value="Solid Disc">Solid Disc</option>
            <option value="Drilled / Vented">Drilled / Vented</option>
            <option value="Slotted / Grooved">Slotted / Grooved</option>
            <option value="Wave / Petal Disc">Wave / Petal Disc</option>
            <option value="Floating Disc / Semi-Floating">Floating Disc / Semi-Floating</option>
            <option value="Full Floating Disc">Full Floating Disc</option>
            <option value="Aftermarket Oversized">Aftermarket Oversized</option>
            <option value="Carbon Ceramic">Carbon Ceramic</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Front Rotor Diameter (mm)</label>
        <input type="number" step="1" name="front_rotor_diameter" class="form-control" placeholder="e.g. 260 to 300">
    </div>

    <div class="col-md-6">
        <label>Rear Rotor Design</label>
        <select name="rear_rotor_design" class="form-select">
            <option value="">Select</option>
            <option value="N/A (Drum Brake)">N/A (Drum Brake)</option>
            <option value="Solid Disc">Solid Disc</option>
            <option value="Drilled / Vented">Drilled / Vented</option>
            <option value="Wave / Petal Disc">Wave / Petal Disc</option>
            <option value="Floating Disc">Floating Disc</option>
            <option value="Aftermarket Oversized">Aftermarket Oversized</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Rear Rotor Diameter (mm)</label>
        <input type="number" step="1" name="rear_rotor_diameter" class="form-control" placeholder="e.g. 220 to 240">
    </div>

    <div class="col-md-6">
        <label>Front Caliper Mount / Piston Type</label>
        <select name="front_caliper_type" class="form-select">
            <option value="">Select</option>
            <option value="Axial Single Piston">Axial Single Piston</option>
            <option value="Axial Dual Piston">Axial Dual Piston</option>
            <option value="Axial Four Piston">Axial Four Piston</option>
            <option value="Radial Mount Dual Piston">Radial Mount Dual Piston</option>
            <option value="Radial Mount Four Piston">Radial Mount Four Piston</option>
            <option value="Radial Monoblock Caliper">Radial Monoblock Caliper</option>
            <option value="Six Piston Caliper">Six Piston Caliper</option>
            <option value="Floating Caliper">Floating Caliper</option>
            <option value="Fixed Caliper">Fixed Caliper</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Rear Caliper Mount / Piston Type</label>
        <select name="rear_caliper_type" class="form-select">
            <option value="">Select</option>
            <option value="N/A (Drum Brake)">N/A (Drum Brake)</option>
            <option value="Axial Single Piston">Axial Single Piston</option>
            <option value="Axial Dual Piston">Axial Dual Piston</option>
            <option value="Floating Caliper">Floating Caliper</option>
            <option value="Radial Mount Caliper">Radial Mount Caliper</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Brake Pad Material</label>
        <select name="brake_pad_material" class="form-select">
            <option value="">Select</option>
            <option value="Organic">Organic</option>
            <option value="Sintered Metal">Sintered Metal</option>
            <option value="Semi-Metallic">Semi-Metallic</option>
            <option value="Ceramic">Ceramic</option>
            <option value="Carbon Ceramic / Kevlar Hybrid">Carbon Ceramic / Kevlar Hybrid</option>
            <option value="Aftermarket High Friction">Aftermarket High Friction</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Brake Fluid Type</label>
        <select name="brake_fluid_type" class="form-select">
            <option value="">Select</option>
            <option value="DOT 3">DOT 3</option>
            <option value="DOT 4">DOT 4</option>
            <option value="Super DOT 4 / DOT 4 LV">Super DOT 4 / DOT 4 LV</option>
            <option value="DOT 5.1">DOT 5.1</option>
            <option value="DOT 5">DOT 5</option>
            <option value="Racing Fluid">Racing Fluid</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Master Cylinder Type</label>
        <select name="master_cylinder_type" class="form-select">
            <option value="">Select</option>
            <option value="Axial Master Cylinder">Axial Master Cylinder</option>
            <option value="Radial Master Cylinder">Radial Master Cylinder</option>
            <option value="Billet/CNC Master Cylinder">Billet/CNC Master Cylinder</option>
            <option value="Master Cylinder with Integrated Reservoir">Master Cylinder with Integrated Reservoir</option>
            <option value="Aftermarket Adjustable Ratio">Aftermarket Adjustable Ratio</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Brake Line Material</label>
        <select name="brake_line_material" class="form-select">
            <option value="">Select</option>
            <option value="OEM Rubber/Nylon">OEM Rubber/Nylon</option>
            <option value="Stainless Steel Braided">Stainless Steel Braided</option>
            <option value="PTFE/Teflon Lined Braided">PTFE/Teflon Lined Braided</option>
            <option value="Kevlar Reinforced">Kevlar Reinforced</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Brake Lever / Pedal Type</label>
        <select name="brake_lever_type" class="form-select">
            <option value="">Select</option>
            <option value="Fixed Lever">Fixed Lever</option>
            <option value="Adjustable Lever">Adjustable Lever</option>
            <option value="Folding Lever">Folding Lever</option>
            <option value="Aftermarket CNC Lever">Aftermarket CNC Lever</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Brake Switch Type</label>
        <select name="brake_switch_type" class="form-select">
            <option value="">Select</option>
            <option value="Mechanical Switch">Mechanical Switch</option>
            <option value="Hydraulic Pressure Switch">Hydraulic Pressure Switch</option>
            <option value="Integrated Sensor (ABS/CBS)">Integrated Sensor (ABS/CBS)</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Parking Brake (Scooter/EV)</label>
        <select name="parking_brake" class="form-select">
            <option value="">Select</option>
            <option value="None">None</option>
            <option value="Mechanical Lock Lever">Mechanical Lock Lever</option>
            <option value="Foot Parking Brake">Foot Parking Brake</option>
            <option value="Electronic Parking Brake">Electronic Parking Brake</option>
        </select>
    </div>

</div>
`;
