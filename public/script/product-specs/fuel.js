export const fuelSpecs = `
<div class="row g-3 mb-3">

    <!-- PRODUCT TYPE -->
    <div class="col-md-6">
        <label>Product Type</label>
        <select name="product_type" class="form-select">
            <option value="">Select</option>
            <option value="Fuel Pump">Fuel Pump</option>
            <option value="Fuel Injector">Fuel Injector</option>
            <option value="Carburetor">Carburetor</option>
            <option value="Throttle Body / EFI Unit">Throttle Body / EFI Unit</option>
            <option value="Fuel Pressure Regulator">Fuel Pressure Regulator</option>
            <option value="Fuel Filter">Fuel Filter</option>
            <option value="Fuel Line / Hose">Fuel Line / Hose</option>
            <option value="Fuel Tank / Cell">Fuel Tank / Cell</option>
            <option value="Fuel Cap / Accessories">Fuel Cap / Accessories</option>
            <option value="Air Intake / Filter Kit">Air Intake / Filter Kit</option>
            <option value="Other Fuel System Component">Other Fuel System Component</option>
        </select>
    </div>

    <!-- BRAND / MANUFACTURER -->
    <div class="col-md-6">
        <label>Brand / Manufacturer</label>
        <input type="text" name="brand" class="form-control" placeholder="e.g. Keihin, Mikuni, Bosch, Faito">
    </div>

    <!-- FLOW / CAPACITY -->
    <div class="col-md-6">
        <label>Flow Rate / Capacity</label>
        <input type="text" name="flow_capacity" class="form-control" placeholder="e.g. 120 LPH, 100 cc/min">
    </div>

    <div class="col-md-6">
        <label>Pressure Rating</label>
        <input type="text" name="pressure_rating" class="form-control" placeholder="e.g. 3 bar, 43 PSI">
    </div>

    <div class="col-md-6">
        <label>Fuel Type Compatibility</label>
        <select name="fuel_type" class="form-select">
            <option value="">Select</option>
            <option value="Gasoline">Gasoline</option>
            <option value="Diesel">Diesel</option>
            <option value="Ethanol Blend (E10/E20)">Ethanol Blend (E10/E20)</option>
            <option value="Methanol / Alcohol">Methanol / Alcohol</option>
            <option value="Race Fuel">Race Fuel</option>
            <option value="Electric / Not Applicable">Electric / Not Applicable</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- FITMENT / CONNECTION -->
    <div class="col-md-6">
        <label>Connection / Fitment Type</label>
        <select name="fitment_type" class="form-select">
            <option value="">Select</option>
            <option value="In-Line">In-Line</option>
            <option value="Flanged / Bolt-On">Flanged / Bolt-On</option>
            <option value="Threaded / Screw-On">Threaded / Screw-On</option>
            <option value="Universal / Adjustable">Universal / Adjustable</option>
            <option value="Custom / Specific Fit">Custom / Specific Fit</option>
        </select>
    </div>

    <!-- FILTER / MESH / AIR -->
    <div class="col-md-6">
        <label>Filter Type</label>
        <select name="filter_type" class="form-select">
            <option value="">Select</option>
            <option value="Paper / Cartridge">Paper / Cartridge</option>
            <option value="Foam Element">Foam Element</option>
            <option value="Cotton Gauze / Oiled">Cotton Gauze / Oiled</option>
            <option value="Stainless Steel Mesh">Stainless Steel Mesh</option>
            <option value="Pod / Cone Filter">Pod / Cone Filter</option>
            <option value="Custom / High Flow">Custom / High Flow</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Air Intake / Duct Type</label>
        <select name="air_intake_type" class="form-select">
            <option value="">Select</option>
            <option value="Standard OEM">Standard OEM</option>
            <option value="Short Ram Intake">Short Ram Intake</option>
            <option value="Ram-Air Duct">Ram-Air Duct</option>
            <option value="Velocity Stack">Velocity Stack</option>
            <option value="Open / Custom Intake">Open / Custom Intake</option>
        </select>
    </div>

    <!-- CONTROL / ECU -->
    <div class="col-md-6">
        <label>Control Unit / Tuning</label>
        <select name="control_unit" class="form-select">
            <option value="">Select</option>
            <option value="OEM ECU / Controller">OEM ECU / Controller</option>
            <option value="Aftermarket ECU">Aftermarket ECU</option>
            <option value="Standalone Controller / Module">Standalone Controller / Module</option>
            <option value="Piggyback Module">Piggyback Module</option>
            <option value="Manual Jet / Tuning System">Manual Jet / Tuning System</option>
            <option value="None">None</option>
        </select>
    </div>

    <!-- FUEL TANK / CAP -->
    <div class="col-md-6">
        <label>Tank Capacity / Size</label>
        <input type="text" name="tank_capacity" class="form-control" placeholder="e.g. 5L, 10L, 20L">
    </div>

    <div class="col-md-6">
        <label>Fuel Cap Type / Style</label>
        <select name="fuel_cap" class="form-select">
            <option value="">Select</option>
            <option value="Key Lock">Key Lock</option>
            <option value="Flip-Up / Race Type">Flip-Up / Race Type</option>
            <option value="Vented / Pressure Release">Vented / Pressure Release</option>
            <option value="Flush Mount / Aviation Style">Flush Mount / Aviation Style</option>
            <option value="Aftermarket / Custom">Aftermarket / Custom</option>
        </select>
    </div>

</div>
`;
