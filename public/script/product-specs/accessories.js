export const accessoriesSpecs = `
 <h5>Accessories & Apparel</h5>
        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label>Accessory Type</label>
                <select name="accessory_type" class="form-select">
                    <option value="">Select</option>
                    <option value="Helmet">Helmet</option>
                    <option value="Gloves">Gloves</option>
                    <option value="Jacket">Jacket</option>
                    <option value="Boots">Boots</option>
                    <option value="Goggles">Goggles</option>
                    <option value="Motorcycle Cover">Motorcycle Cover</option>
                    <option value="Top Box / Luggage">Top Box / Luggage</option>
                    <option value="Phone Mount">Phone Mount</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Adjustable / Features</label>
                <input type="text" name="accessory_features" class="form-control" placeholder="e.g. Adjustable strap, reflective">
            </div>
            <div class="col-md-6">
                <label>Dimensions (L × W × H)</label>
                <input type="text" name="accessory_dimensions" class="form-control" placeholder="cm or inches">
            </div>
        </div>
`;
