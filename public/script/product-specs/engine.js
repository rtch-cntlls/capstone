export const engineSpecs = `
 <h5>Engine Specs</h5>
        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label>Engine Type</label>
                <select name="engine_type" class="form-select">
                    <option value="">Select</option>
                    <option value="Single Cylinder">Single Cylinder</option>
                    <option value="Parallel Twin">Parallel Twin</option>
                    <option value="V-Twin">V-Twin</option>
                    <option value="Inline 3">Inline 3</option>
                    <option value="Inline 4">Inline 4</option>
                    <option value="Boxer">Boxer</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Power / Output (hp)</label>
                <input type="number" name="power_output" class="form-control" placeholder="hp or kW">
            </div>
            <div class="col-md-6">
                <label>Cooling Type</label>
                <select name="engine_cooling" class="form-select">
                    <option value="">Select</option>
                    <option value="Air Cooled">Air Cooled</option>
                    <option value="Liquid Cooled">Liquid Cooled</option>
                    <option value="Oil Cooled">Oil Cooled</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Displacement (cc)</label>
                <input type="number" name="displacement" class="form-control" placeholder="cc">
            </div>
            <div class="col-md-6">
                <label>Fuel Type</label>
                <select name="fuel_type" class="form-select">
                    <option value="">Select</option>
                    <option value="Gasoline">Gasoline</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Ethanol">Ethanol</option>
                    <option value="Hybrid">Hybrid</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Starter Type</label>
                <select name="starter_type" class="form-select">
                    <option value="">Select</option>
                    <option value="Electric">Electric</option>
                    <option value="Kick">Kick</option>
                    <option value="Both">Both</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Compression Ratio</label>
                <input type="text" name="compression_ratio" class="form-control" placeholder="e.g. 10.5:1">
            </div>
        </div>
`;
