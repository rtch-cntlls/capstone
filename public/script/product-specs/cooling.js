export const coolingSpecs = `
<h5 class="fw-bold">Cooling System</h5>
<div class="row g-3 mb-3">

    <!-- Cooling Type -->
    <div class="col-md-6">
        <label>Cooling Type</label>
        <select name="cooling_type" class="form-select">
            <option value="">Select</option>
            <option value="Air Cooled">Air Cooled</option>
            <option value="Fan Assisted Air Cooled">Fan Assisted Air Cooled</option>
            <option value="Oil Cooled">Oil Cooled</option>
            <option value="Liquid Cooled">Liquid Cooled</option>
            <option value="Air + Oil Cooled">Air + Oil Cooled</option>
            <option value="Liquid + Oil Cooled">Liquid + Oil Cooled</option>
            <option value="Electric Motor Cooling">Electric Motor Cooling</option>
            <option value="Aftermarket Performance Cooling">Aftermarket Performance Cooling</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- System Condition -->
    <div class="col-md-6">
        <label>Cooling System Condition</label>
        <select name="system_condition" class="form-select">
            <option value="">Select</option>
            <option value="Stock / OEM">Stock / OEM</option>
            <option value="Modified / Upgraded">Modified / Upgraded</option>
            <option value="Radiator Guard Installed">Radiator Guard Installed</option>
            <option value="Thermostat Deleted">Thermostat Deleted</option>
            <option value="Custom Electric Pump Installed">Custom Electric Pump Installed</option>
            <option value="Needs Maintenance / Leaking">Needs Maintenance / Leaking</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Radiator Material</label>
        <select name="radiator_material" class="form-select">
            <option value="">Select</option>
            <option value="Aluminum">Aluminum</option>
            <option value="Copper / Brass">Copper / Brass</option>
            <option value="Plastic / Aluminum Hybrid">Plastic / Aluminum Hybrid</option>
            <option value="Aftermarket Full Aluminum">Aftermarket Full Aluminum</option>
            <option value="High Capacity Radiator">High Capacity Radiator</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Radiator Core Type</label>
        <select name="radiator_core_type" class="form-select">
            <option value="">Select</option>
            <option value="Single Row Core">Single Row Core</option>
            <option value="Dual Row Core">Dual Row Core</option>
            <option value="Triple Row Core">Triple Row Core</option>
            <option value="High Density Fin">High Density Fin</option>
            <option value="Cross-Flow Design">Cross-Flow Design</option>
            <option value="Down-Flow Design">Down-Flow Design</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Cooling Fan Type</label>
        <select name="fan_type" class="form-select">
            <option value="">Select</option>
            <option value="Electric Fan">Electric Fan</option>
            <option value="Mechanical Fan">Mechanical Fan</option>
            <option value="Dual Fan System">Dual Fan System</option>
            <option value="No Fan (Air Cooled)">No Fan (Air Cooled)</option>
            <option value="Aftermarket High CFM Fan">Aftermarket High CFM Fan</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fan Motor Brand</label>
        <input type="text" name="fan_motor_brand" class="form-control" placeholder="e.g. Denso, Spal, Koso">
    </div>

    <div class="col-md-6">
        <label>Includes Thermostat</label>
        <select name="includes_thermostat" class="form-select">
            <option value="">Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            <option value="Lower Temp Thermostat">Lower Temp Thermostat</option>
            <option value="Adjustable Thermostat">Adjustable Thermostat</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Radiator Cap Pressure (psi/bar)</label>
        <input type="text" name="cap_pressure" class="form-control" placeholder="e.g. 1.1 bar or 1.6 bar">
        <small class="form-text text-muted">Higher pressure increases boiling point.</small>
    </div>

    <div class="col-md-6">
        <label>Coolant Type</label>
        <select name="coolant_type" class="form-select">
            <option value="">Select</option>
            <option value="Ethylene Glycol">Ethylene Glycol</option>
            <option value="Propylene Glycol">Propylene Glycol</option>
            <option value="Organic Acid Technology (OAT)">Organic Acid Technology (OAT)</option>
            <option value="Hybrid Organic Acid Technology (HOAT)">Hybrid Organic Acid Technology (HOAT)</option>
            <option value="Water Wetter Additive">Water Wetter Additive</option>
            <option value="Water Only (Racing)">Water Only (Racing)</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Coolant Concentration</label>
        <select name="coolant_concentration" class="form-select">
            <option value="">Select</option>
            <option value="Pre-Mixed 50/50">Pre-Mixed 50/50</option>
            <option value="Concentrate">Concentrate</option>
            <option value="High Concentration">High Concentration</option>
            <option value="Water Wetter Mix">Water Wetter Mix</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Coolant Capacity (L)</label>
        <input type="number" step="0.1" name="coolant_capacity" class="form-control" placeholder="e.g. 1.2 to 4.0">
    </div>

    <div class="col-md-6">
        <label>Hose Material</label>
        <select name="hose_material" class="form-select">
            <option value="">Select</option>
            <option value="OEM Rubber">OEM Rubber</option>
            <option value="Silicone">Silicone</option>
            <option value="Braided Stainless Steel">Braided Stainless Steel</option>
            <option value="Aluminum Hard Line">Aluminum Hard Line</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Oil Cooler Type</label>
        <select name="oil_cooler_type" class="form-select">
            <option value="">Select</option>
            <option value="Air to Oil Cooler">Air to Oil Cooler</option>
            <option value="Liquid to Oil Cooler">Liquid to Oil Cooler</option>
            <option value="Stacked Plate Cooler">Stacked Plate Cooler</option>
            <option value="Tubular / Fin Type">Tubular / Fin Type</option>
            <option value="External High-Volume Cooler">External High-Volume Cooler</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Oil Cooler Brand</label>
        <input type="text" name="oil_cooler_brand" class="form-control" placeholder="e.g. Uma Racing, Koso, Takegawa, Mocal">
    </div>

    <div class="col-md-6">
        <label>Oil Line Material</label>
        <select name="oil_line_material" class="form-select">
            <option value="">Select</option>
            <option value="OEM Rubber / Plastic">OEM Rubber / Plastic</option>
            <option value="Stainless Steel Braided">Stainless Steel Braided</option>
            <option value="PTFE / Teflon Lined">PTFE / Teflon Lined</option>
            <option value="Aftermarket Racing Line">Aftermarket Racing Line</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Oil Filter Type</label>
        <select name="includes_oil_filter" class="form-select">
            <option value="">Select</option>
            <option value="Internal Oil Screen">Internal Oil Screen</option>
            <option value="Cartridge Filter">Cartridge Filter</option>
            <option value="External Oil Filter Relocation">External Oil Filter Relocation</option>
            <option value="High Flow Filter">High Flow Filter</option>
        </select>
    </div>

</div>
`;
