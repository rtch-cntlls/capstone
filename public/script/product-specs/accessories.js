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
            <option value="Pants">Pants</option>
            <option value="Boots">Boots</option>
            <option value="Goggles">Goggles</option>
            <option value="Riding Armor / Pads">Riding Armor / Pads</option>
            <option value="Motorcycle Cover">Motorcycle Cover</option>
            <option value="Top Box / Luggage">Top Box / Luggage</option>
            <option value="Saddlebags / Side Case">Saddlebags / Side Case</option>
            <option value="Phone Mount">Phone Mount</option>
            <option value="Action Camera Mount">Action Camera Mount</option>
            <option value="Tank Bag">Tank Bag</option>
            <option value="Handlebar Accessories">Handlebar Accessories</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Size / Fit</label>
        <input type="text" name="accessory_size" class="form-control" placeholder="e.g. M, L, XL or Universal Fit">
    </div>
    <div class="col-md-6">
        <label>Adjustable / Features</label>
        <input type="text" name="accessory_features" class="form-control" placeholder="e.g. Adjustable strap, reflective, waterproof">
    </div>
    <div class="col-md-6">
        <label>Dimensions (L × W × H)</label>
        <input type="text" name="accessory_dimensions" class="form-control" placeholder="e.g. 30 × 20 × 15 cm">
    </div>
    <div class="col-md-6">
        <label>Compatibility</label>
        <input type="text" name="accessory_compatibility" class="form-control" placeholder="e.g. Universal, Yamaha NMAX, Honda Click">
    </div>
</div>
`;
