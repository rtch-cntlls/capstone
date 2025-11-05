export const lubricantsSpecs = `
<h5>Lubricants & Fluids</h5>
        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label>Engine Oil Type</label>
                <select name="engine_oil_type" class="form-select">
                    <option value="">Select</option>
                    <option value="Mineral">Mineral</option>
                    <option value="Semi-Synthetic">Semi-Synthetic</option>
                    <option value="Fully Synthetic">Fully Synthetic</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Engine Oil Viscosity</label>
                <select name="engine_oil_viscosity" class="form-select">
                    <option value="">Select</option>
                    <option value="10W-30">10W-30</option>
                    <option value="10W-40">10W-40</option>
                    <option value="15W-40">15W-40</option>
                    <option value="20W-50">20W-50</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Brake Fluid Type</label>
                <select name="brake_fluid_type" class="form-select">
                    <option value="">Select</option>
                    <option value="DOT 3">DOT 3</option>
                    <option value="DOT 4">DOT 4</option>
                    <option value="DOT 5.1">DOT 5.1</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Coolant / Antifreeze Type</label>
                <select name="coolant_type" class="form-select">
                    <option value="">Select</option>
                    <option value="Ethylene Glycol">Ethylene Glycol</option>
                    <option value="Propylene Glycol">Propylene Glycol</option>
                    <option value="Premixed">Premixed</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Transmission / Gear Oil</label>
                <select name="transmission_oil_type" class="form-select">
                    <option value="">Select</option>
                    <option value="SAE 80W-90">SAE 80W-90</option>
                    <option value="SAE 75W-90">SAE 75W-90</option>
                    <option value="SAE 10W-40">SAE 10W-40</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Fork / Suspension Oil</label>
                <select name="fork_oil_type" class="form-select">
                    <option value="">Select</option>
                    <option value="10W">10W</option>
                    <option value="15W">15W</option>
                    <option value="20W">20W</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Chain Lubricant</label>
                <select name="chain_lube_type" class="form-select">
                    <option value="">Select</option>
                    <option value="Spray">Spray</option>
                    <option value="Wax">Wax</option>
                    <option value="Oil">Oil</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Other Fluids / Additives</label>
                <input type="text" name="other_fluids" class="form-control" placeholder="e.g. Fuel stabilizer, oil additives">
            </div>
            <div class="col-md-6">
                <label>Quantity / Capacity</label>
                <input type="text" name="fluids_capacity" class="form-control" placeholder="Liters or ml">
            </div>
        </div>
`;
