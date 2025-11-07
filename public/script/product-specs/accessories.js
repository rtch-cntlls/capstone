export const accessoriesSpecs = `
<h5>Accessories & Apparel</h5>
<div class="row g-3 mb-2">

    <h6 class="fw-bold">Motorcycle Accessories</h6>

    <div class="col-md-6">
        <label>Accessory Type</label>
        <select name="accessory_type" class="form-select">
            <option value="">Select</option>
            <option value="Top Box / Luggage">Top Box / Luggage</option>
            <option value="Saddlebags / Side Case">Saddlebags / Side Case</option>
            <option value="Tank Bag">Tank Bag</option>
            <option value="Handlebar Accessories">Handlebar Accessories</option>
            <option value="Phone Mount / GPS Holder">Phone Mount / GPS Holder</option>
            <option value="Action Camera Mount">Action Camera Mount</option>
            <option value="Crash Protection / Frame Sliders">Crash Protection / Frame Sliders</option>
            <option value="Engine Guard / Skid Plate">Engine Guard / Skid Plate</option>
            <option value="Foot Pegs / Rear Sets">Foot Pegs / Rear Sets</option>
            <option value="Windshield / Windscreen">Windshield / Windscreen</option>
            <option value="LED Lights / Indicators">LED Lights / Indicators</option>
            <option value="Auxiliary Lights / Fog Lamps">Auxiliary Lights / Fog Lamps</option>
            <option value="Mirrors">Mirrors</option>
            <option value="License Plate Holder / Bracket">License Plate Holder / Bracket</option>
            <option value="Aftermarket Fairings / Panels">Aftermarket Fairings / Panels</option>
            <option value="Seat Cover / Cushion">Seat Cover / Cushion</option>
            <option value="Key Holder / Alarm / Immobilizer">Key Holder / Alarm / Immobilizer</option>
            <option value="Motorcycle Cover">Motorcycle Cover</option>
            <option value="Exhaust / Muffler Upgrade">Exhaust / Muffler Upgrade</option>
            <option value="Performance Filter / Air Cleaner">Performance Filter / Air Cleaner</option>
            <option value="Handlebar Grips / Bar Ends">Handlebar Grips / Bar Ends</option>
            <option value="Charging Port / USB Socket">Charging Port / USB Socket</option>
            <option value="Side Stand Base / Enlarger">Side Stand Base / Enlarger</option>
            <option value="Decorative Stickers / Decals">Decorative Stickers / Decals</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Compatibility / Vehicle Fitment</label>
        <input type="text" name="accessory_compatibility" class="form-control" placeholder="e.g. Universal, Yamaha NMAX, Honda Click, Kawasaki Ninja 250">
    </div>

    <div class="col-md-6">
        <label>Brand / Manufacturer</label>
        <input type="text" name="accessory_brand" class="form-control" placeholder="e.g. GIVI, Koso, Rizoma, RCB, H2C, Yamaha Genuine, Honda Genuine">
    </div>

    <div class="col-md-6">
        <label>Material / Build</label>
        <input type="text" name="accessory_material" class="form-control" placeholder="e.g. ABS Plastic, Aluminum Alloy, Carbon Fiber, Stainless Steel">
    </div>

    <div class="col-md-6">
        <label>Dimensions (L × W × H)</label>
        <input type="text" name="accessory_dimensions" class="form-control" placeholder="e.g. 30 × 20 × 15 cm">
    </div>

    <div class="col-md-6">
        <label>Adjustable / Features</label>
        <input type="text" name="accessory_features" class="form-control" placeholder="e.g. Waterproof, Quick Release, Reflective, Adjustable, Shock Absorbing">
    </div>

    <h6 class="fw-bold mt-4">Apparel & Riding Gear</h6>

    <div class="col-md-6">
        <label>Apparel Type</label>
        <select name="apparel_type" class="form-select">
            <option value="">Select</option>
            <option value="Helmet">Helmet</option>
            <option value="Full-Face Helmet">Full-Face Helmet</option>
            <option value="Modular Helmet">Modular Helmet</option>
            <option value="Half Helmet">Half Helmet</option>
            <option value="Off-Road / Dual Sport Helmet">Off-Road / Dual Sport Helmet</option>
            <option value="Riding Jacket">Riding Jacket</option>
            <option value="Riding Armor / Chest Protector">Riding Armor / Chest Protector</option>
            <option value="Riding Gloves">Riding Gloves</option>
            <option value="Riding Pants / Jeans">Riding Pants / Jeans</option>
            <option value="Riding Boots / Shoes">Riding Boots / Shoes</option>
            <option value="Goggles / Eye Protection">Goggles / Eye Protection</option>
            <option value="Rain Suit / Waterproof Gear">Rain Suit / Waterproof Gear</option>
            <option value="Balaclava / Face Mask">Balaclava / Face Mask</option>
            <option value="Elbow / Knee Guards">Elbow / Knee Guards</option>
            <option value="Reflective Vest / Safety Vest">Reflective Vest / Safety Vest</option>
            <option value="Ear Protection / Plugs">Ear Protection / Plugs</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Size / Fit</label>
        <select name="apparel_size" class="form-select">
            <option value="">Select</option>
            <option value="Universal Fit">Universal Fit</option>
            <option value="Small">Small</option>
            <option value="Medium">Medium</option>
            <option value="Large">Large</option>
            <option value="Extra Large">Extra Large</option>
            <option value="Double Extra Large">Double Extra Large</option>
            <option value="Custom Fit">Custom Fit</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Apparel Material</label>
        <select name="apparel_material" class="form-select">
            <option value="">Select</option>
            <option value="Leather">Leather</option>
            <option value="Textile / Mesh">Textile / Mesh</option>
            <option value="Cordura / Kevlar Reinforced">Cordura / Kevlar Reinforced</option>
            <option value="Polycarbonate (Helmet)">Polycarbonate (Helmet)</option>
            <option value="Fiberglass / Composite (Helmet)">Fiberglass / Composite (Helmet)</option>
            <option value="Carbon Fiber (Helmet)">Carbon Fiber (Helmet)</option>
            <option value="Rubber / TPU (Boots)">Rubber / TPU (Boots)</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Certification / Rating</label>
        <select name="apparel_certification" class="form-select">
            <option value="">Select</option>
            <option value="DOT Certified">DOT Certified</option>
            <option value="ECE 22.05 / 22.06 Certified">ECE 22.05 / 22.06 Certified</option>
            <option value="SNELL Certified">SNELL Certified</option>
            <option value="CE Level 1 Protection">CE Level 1 Protection</option>
            <option value="CE Level 2 Protection">CE Level 2 Protection</option>
            <option value="None / Non-Rated">None / Non-Rated</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Brand / Manufacturer</label>
        <input type="text" name="apparel_brand" class="form-control" placeholder="e.g. KYT, LS2, Spyder, SMK, Alpinestars, Komine, Rakk Gear">
    </div>

</div>
`;
