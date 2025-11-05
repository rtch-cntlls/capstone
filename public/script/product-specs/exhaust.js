export const exhaustSpecs = `
 <h5>Exhaust & Muffler</h5>
        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label>Exhaust Material</label>
                <select name="exhaust_material" class="form-select">
                    <option value="">Select</option>
                    <option value="Steel">Steel</option>
                    <option value="Stainless Steel">Stainless Steel</option>
                    <option value="Titanium">Titanium</option>
                    <option value="Carbon Fiber">Carbon Fiber</option>
                    <option value="Aluminum">Aluminum</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Muffler Type</label>
                <select name="muffler_type" class="form-select">
                    <option value="">Select</option>
                    <option value="Standard">Standard</option>
                    <option value="Sport">Sport</option>
                    <option value="Aftermarket">Aftermarket</option>
                    <option value="Custom">Custom</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Sound Level (dB)</label>
                <input type="number" name="sound_level" class="form-control" placeholder="e.g. 85">
            </div>
        </div>
`;
