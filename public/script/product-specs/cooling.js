export const coolingSpecs = `
<h5 class="mb-3">Cooling System</h5>
<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label>Cooling Type</label>
        <select name="cooling_type" class="form-select">
            <option value="">Select</option>
            <option value="Air Cooled">Air Cooled</option>
            <option value="Liquid Cooled">Liquid Cooled</option>
            <option value="Oil Cooled">Oil Cooled</option>
            <option value="Air + Oil Cooled">Air + Oil Cooled</option>
            <option value="Fan Assisted Air Cooled">Fan Assisted Air Cooled</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Radiator Material</label>
        <select name="radiator_material" class="form-select">
            <option value="">Select</option>
            <option value="Aluminum">Aluminum</option>
            <option value="Copper">Copper</option>
            <option value="Plastic">Plastic</option>
            <option value="Brass">Brass</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Radiator Core Type</label>
        <select name="radiator_core_type" class="form-select">
            <option value="">Select</option>
            <option value="Single Core">Single Core</option>
            <option value="Double Core">Double Core</option>
            <option value="Triple Core">Triple Core</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Fan Type</label>
        <select name="fan_type" class="form-select">
            <option value="">Select</option>
            <option value="Electric">Electric</option>
            <option value="Mechanical">Mechanical</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Fan Motor Brand</label>
        <input type="text" name="fan_motor_brand" class="form-control" placeholder="e.g. Denso, Nissin, OEM">
    </div>
    <div class="col-md-6">
        <label>Includes Thermostat</label>
        <select name="includes_thermostat" class="form-select">
            <option value="">Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>

    <h6 class="fw-bold">Coolant System</h6>
    <div class="col-md-6">
        <label>Coolant Type</label>
        <select name="coolant_type" class="form-select">
            <option value="">Select</option>
            <option value="Ethylene Glycol">Ethylene Glycol</option>
            <option value="Propylene Glycol">Propylene Glycol</option>
            <option value="Pre-Mixed Coolant">Pre-Mixed Coolant</option>
            <option value="Water-Based">Water-Based</option>
            <option value="Other">Other</option>
        </select>
    </div>
     <div class="col-md-6">
        <label>Coolant Capacity (L)</label>
        <input type="number" name="coolant_capacity" class="form-control" placeholder="e.g. 1.2">
    </div>
    <div class="col-md-6">
        <label>Coolant Brand</label>
        <input type="text" name="coolant_brand" class="form-control" placeholder="e.g. Motul, Prestone, OEM">
    </div>
    <div class="col-md-6">
        <label>Reservoir Type</label>
        <select name="reservoir_type" class="form-select">
            <option value="">Select</option>
            <option value="Integrated">Integrated</option>
            <option value="External Tank">External Tank</option>
        </select>
    </div>

    <h6 class="fw-bold">Oil Cooling System</h6>
     <div class="col-md-6">
        <label>Oil Cooler Type</label>
        <select name="oil_cooler_type" class="form-select">
            <option value="">Select</option>
            <option value="Air to Oil Cooler">Air to Oil Cooler</option>
            <option value="Liquid to Oil Cooler">Liquid to Oil Cooler</option>
            <option value="Stacked Plate">Stacked Plate</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Oil Cooler Brand</label>
        <input type="text" name="oil_cooler_brand" class="form-control" placeholder="e.g. Koso, Uma, Earl's">
    </div>
    <div class="col-md-6">
        <label>Oil Line Material</label>
        <select name="oil_line_material" class="form-select">
            <option value="">Select</option>
            <option value="Rubber">Rubber</option>
            <option value="Steel Braided">Steel Braided</option>
            <option value="Kevlar Reinforced">Kevlar Reinforced</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Includes Oil Filter</label>
        <select name="includes_oil_filter" class="form-select">
            <option value="">Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>

    <h6 class="fw-bold">Cooling Performance</h6>
     <div class="col-md-6">
        <label>Operating Temperature (°C)</label>
        <input type="number" name="operating_temp" class="form-control" placeholder="e.g. 90">
    </div>

    <div class="col-md-6">
        <label>Maximum Temperature (°C)</label>
        <input type="number" name="max_temp" class="form-control" placeholder="e.g. 120">
    </div>

    <div class="col-md-6">
        <label>Cooling Efficiency Rating (%)</label>
        <input type="number" name="cooling_efficiency" class="form-control" placeholder="e.g. 85">
    </div>
</div>
`;
