export const coolingSpecs = `
<div class="row g-3 mb-3">

    <div class="col-md-6">
        <label>Product Type</label>
        <select name="product_type" class="form-select">
            <option value="">Select</option>
            <option value="Radiator">Radiator</option>
            <option value="Cooling Fan">Cooling Fan</option>
            <option value="Oil Cooler">Oil Cooler</option>
            <option value="Hose / Line Kit">Hose / Line Kit</option>
            <option value="Coolant / Additives">Coolant / Additives</option>
            <option value="Thermostat">Thermostat</option>
            <option value="Complete Cooling Kit">Complete Cooling Kit</option>
            <option value="Other Cooling Accessory">Other Cooling Accessory</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Brand / Manufacturer</label>
        <input type="text" name="brand" class="form-control" placeholder="e.g. Koso, Mocal, Spal, Takegawa, OEM">
    </div>

    <div class="col-md-6">
        <label>Cooling Method / Type</label>
        <select name="cooling_method" class="form-select">
            <option value="">Select</option>
            <option value="Air Cooled">Air Cooled</option>
            <option value="Fan Assisted Air Cooled">Fan Assisted Air Cooled</option>
            <option value="Liquid Cooled">Liquid Cooled</option>
            <option value="Oil Cooled">Oil Cooled</option>
            <option value="Electric Motor Cooling">Electric Motor Cooling</option>
            <option value="Aftermarket High Performance">Aftermarket High Performance</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Dimensions / Size</label>
        <input type="text" name="dimensions" class="form-control" placeholder="e.g. 300x200x50 mm, 1.5 L capacity">
    </div>

    <div class="col-md-6">
        <label>Fluid Capacity (L)</label>
        <input type="number" step="0.1" name="fluid_capacity" class="form-control" placeholder="e.g. 0.5 to 5.0 L">
    </div>

    <div class="col-md-6">
        <label>Fan Type</label>
        <select name="fan_type" class="form-select">
            <option value="">Select</option>
            <option value="Electric Fan">Electric Fan</option>
            <option value="Mechanical Fan">Mechanical Fan</option>
            <option value="Dual Fan">Dual Fan</option>
            <option value="High CFM Performance Fan">High CFM Performance Fan</option>
            <option value="No Fan">No Fan</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fan Motor Brand</label>
        <input type="text" name="fan_motor_brand" class="form-control" placeholder="e.g. Spal, Denso, Koso">
    </div>

    <div class="col-md-6">
        <label>Includes Thermostat</label>
        <select name="includes_thermostat" class="form-select">
            <option value="">Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            <option value="Adjustable Thermostat">Adjustable Thermostat</option>
            <option value="High Performance / Low Temp">High Performance / Low Temp</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Cap Pressure (psi / bar)</label>
        <input type="text" name="cap_pressure" class="form-control" placeholder="e.g. 1.1 bar / 16 psi">
    </div>

    <div class="col-md-6">
        <label>Coolant Type</label>
        <select name="coolant_type" class="form-select">
            <option value="">Select</option>
            <option value="Ethylene Glycol">Ethylene Glycol</option>
            <option value="Propylene Glycol">Propylene Glycol</option>
            <option value="OAT">Organic Acid Technology (OAT)</option>
            <option value="HOAT">Hybrid OAT (HOAT)</option>
            <option value="Water Wetter / Additive">Water Wetter / Additive</option>
            <option value="Water Only">Water Only</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Coolant Concentration / Mix</label>
        <select name="coolant_concentration" class="form-select">
            <option value="">Select</option>
            <option value="Pre-Mixed 50/50">Pre-Mixed 50/50</option>
            <option value="Concentrate">Concentrate</option>
            <option value="High Concentration">High Concentration</option>
            <option value="Custom Mix / Racing">Custom Mix / Racing</option>
        </select>
    </div>


    <div class="col-md-6">
        <label>Hose / Line Material</label>
        <select name="hose_material" class="form-select">
            <option value="">Select</option>
            <option value="Rubber / OEM">Rubber / OEM</option>
            <option value="Silicone">Silicone</option>
            <option value="Braided Stainless Steel">Braided Stainless Steel</option>
            <option value="Aluminum Hard Line">Aluminum Hard Line</option>
            <option value="PTFE / Teflon Lined">PTFE / Teflon Lined</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Oil Cooler Type</label>
        <select name="oil_cooler_type" class="form-select">
            <option value="">Select</option>
            <option value="Air to Oil">Air to Oil</option>
            <option value="Liquid to Oil">Liquid to Oil</option>
            <option value="Tubular / Fin">Tubular / Fin</option>
            <option value="Stacked Plate">Stacked Plate</option>
            <option value="External High-Volume">External High-Volume</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Oil Cooler Brand</label>
        <input type="text" name="oil_cooler_brand" class="form-control" placeholder="e.g. Mocal, Koso, Takegawa">
    </div>

</div>
`;
