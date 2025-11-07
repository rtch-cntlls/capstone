export const fuelSpecs = `
<h5 class="fw-bold">Fuel System</h5>
<div class="row g-3 mb-2">

    <div class="col-md-6">
        <label>Fuel Delivery Type</label>
        <select name="fuel_delivery" class="form-select">
            <option value="">Select</option>
            <option value="Carburetor">Carburetor</option>
            <option value="Fuel Injection (Throttle Body)">Fuel Injection (Throttle Body)</option>
            <option value="Fuel Injection (Port Injection)">Fuel Injection (Port Injection)</option>
            <option value="Direct Injection">Direct Injection</option>
            <option value="Aftermarket Racing Carburetor">Aftermarket Racing Carburetor</option>
            <option value="Standalone ECU/EFI">Standalone ECU/EFI</option>
            <option value="Piggyback Tuning Module">Piggyback Tuning Module</option>
            <option value="None (Electric Vehicle)">None (Electric Vehicle)</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fuel System Control Unit</label>
        <select name="fuel_control_unit" class="form-select">
            <option value="">Select</option>
            <option value="OEM ECU">OEM ECU</option>
            <option value="Aftermarket ECU">Aftermarket ECU</option>
            <option value="Carburetor Jet System">Carburetor Jet System</option>
            <option value="Custom Tuned ECU">Custom Tuned ECU</option>
            <option value="Piggyback Controller">Piggyback Controller</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fuel Tank Capacity (L)</label>
        <input type="number" step="0.1" name="fuel_tank_capacity" class="form-control" placeholder="e.g. 4.2">
    </div>

    <div class="col-md-6">
        <label>Reserve Fuel Capacity (L)</label>
        <input type="number" step="0.1" name="reserve_capacity" class="form-control" placeholder="e.g. 1.0">
    </div>

    <div class="col-md-6">
        <label>Fuel Pump Type</label>
        <select name="fuel_pump" class="form-select">
            <option value="">Select</option>
            <option value="Gravity Feed">Gravity Feed</option>
            <option value="Vacuum Pump">Vacuum Pump</option>
            <option value="Mechanical Diaphragm">Mechanical Diaphragm</option>
            <option value="In-Tank Electric (Low Pressure)">In-Tank Electric (Low Pressure)</option>
            <option value="In-Tank Electric (High Pressure)">In-Tank Electric (High Pressure)</option>
            <option value="External Inline Pump">External Inline Pump</option>
            <option value="High Volume Racing Pump">High Volume Racing Pump</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fuel Filter Type</label>
        <select name="fuel_filter" class="form-select">
            <option value="">Select</option>
            <option value="In-Tank Strainer / Mesh">In-Tank Strainer / Mesh</option>
            <option value="Inline Paper Cartridge">Inline Paper Cartridge</option>
            <option value="Integrated Pump Filter">Integrated Pump Filter</option>
            <option value="Aftermarket High Flow">Aftermarket High Flow</option>
            <option value="Reusable / Cleanable">Reusable / Cleanable</option>
            <option value="External Custom Filter">External Custom Filter</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fuel Line Type</label>
        <select name="fuel_line_type" class="form-select">
            <option value="">Select</option>
            <option value="Rubber (OEM)">Rubber (OEM)</option>
            <option value="Braided Steel Line">Braided Steel Line</option>
            <option value="Transparent Polyurethane">Transparent Polyurethane</option>
            <option value="High-Pressure Fuel Hose">High-Pressure Fuel Hose</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fuel Pressure Regulator</label>
        <select name="fuel_pressure_regulator" class="form-select">
            <option value="">Select</option>
            <option value="None">None</option>
            <option value="OEM Built-In">OEM Built-In</option>
            <option value="Aftermarket Adjustable">Aftermarket Adjustable</option>
            <option value="External Inline Type">External Inline Type</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fuel Type</label>
        <select name="fuel_type" class="form-select">
            <option value="">Select</option>
            <option value="Unleaded Gasoline">Unleaded Gasoline</option>
            <option value="Ethanol Blend (E10/E20)">Ethanol Blend (E10/E20)</option>
            <option value="Leaded Gasoline">Leaded Gasoline</option>
            <option value="Diesel">Diesel</option>
            <option value="Race Fuel">Race Fuel</option>
            <option value="Methanol / Alcohol">Methanol / Alcohol</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fuel Octane Rating</label>
        <select name="octane_rating" class="form-select">
            <option value="">Select</option>
            <option value="91 RON">91 RON</option>
            <option value="95 RON">95 RON</option>
            <option value="97+ RON">97+ RON</option>
            <option value="100+ RON">100+ RON</option>
            <option value="Owner Specified">Owner Specified</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Injector Count</label>
        <select name="injector_count" class="form-select">
            <option value="">Select</option>
            <option value="Single Injector">Single Injector</option>
            <option value="Dual Injector">Dual Injector</option>
            <option value="Four Injector">Four Injector</option>
            <option value="Custom / Tuned Setup">Custom / Tuned Setup</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Injector Flow Rate (cc/min)</label>
        <input type="number" step="0.1" name="injector_flow_rate" class="form-control" placeholder="e.g. 120">
    </div>

    <div class="col-md-6">
        <label>Carburetor / Throttle Body Diameter (mm)</label>
        <input type="number" step="0.1" name="throttle_body_diameter" class="form-control" placeholder="e.g. 28 or 32">
    </div>

    <div class="col-md-6">
        <label>Air Filter Type</label>
        <select name="air_filter_type" class="form-select">
            <option value="">Select</option>
            <option value="Paper Element">Paper Element</option>
            <option value="Foam Element">Foam Element</option>
            <option value="Oiled Cotton Gauze">Oiled Cotton Gauze</option>
            <option value="Stainless Steel Mesh">Stainless Steel Mesh</option>
            <option value="Cone / Pod Filter">Cone / Pod Filter</option>
            <option value="Custom Air Box">Custom Air Box</option>
            <option value="Velocity Stack">Velocity Stack</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Air Intake Duct / Snorkel Type</label>
        <select name="air_intake_duct" class="form-select">
            <option value="">Select</option>
            <option value="Standard OEM Duct">Standard OEM Duct</option>
            <option value="Short Ram Intake">Short Ram Intake</option>
            <option value="Ram-Air Duct">Ram-Air Duct</option>
            <option value="Removed / Custom Open Intake">Removed / Custom Open Intake</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fuel Gauge Type</label>
        <select name="fuel_gauge_type" class="form-select">
            <option value="">Select</option>
            <option value="Analog Needle">Analog Needle</option>
            <option value="Digital Display">Digital Display</option>
            <option value="Warning Light Only">Warning Light Only</option>
            <option value="Smart / Connected Display">Smart / Connected Display</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fuel Cap Type</label>
        <select name="fuel_cap_type" class="form-select">
            <option value="">Select</option>
            <option value="Key Lock">Key Lock</option>
            <option value="Flip-Up / Race Type">Flip-Up / Race Type</option>
            <option value="Ventilated / Vented">Ventilated / Vented</option>
            <option value="Aviation Style Flush Mount">Aviation Style Flush Mount</option>
            <option value="Aftermarket Custom">Aftermarket Custom</option>
        </select>
    </div>

</div>
`;
