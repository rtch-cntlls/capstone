export const fuelSpecs = `
  <h5>Fuel System</h5>
        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label>Fuel Delivery</label>
                <select name="fuel_delivery" class="form-select">
                    <option value="">Select</option>
                    <option value="Carburetor">Carburetor</option>
                    <option value="Fuel Injection">Fuel Injection</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Fuel Tank Capacity (L)</label>
                <input type="number" name="fuel_tank_capacity" class="form-control" placeholder="L">
            </div>
            <div class="col-md-6">
                <label>Fuel Filter</label>
                <select name="fuel_filter" class="form-select">
                    <option value="">Select</option>
                    <option value="Paper">Paper</option>
                    <option value="Mesh">Mesh</option>
                    <option value="Inline">Inline</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Fuel Pump</label>
                <select name="fuel_pump" class="form-select">
                    <option value="">Select</option>
                    <option value="Mechanical">Mechanical</option>
                    <option value="Electric">Electric</option>
                </select>
            </div>
        </div>
`;
