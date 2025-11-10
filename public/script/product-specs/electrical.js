export const electricalSpecs = `
<div class="row g-3 mb-3">

    <!-- PRODUCT TYPE -->
    <div class="col-md-6">
        <label>Product Type</label>
        <select name="product_type" class="form-select">
            <option value="">Select</option>
            <option value="Battery">Battery</option>
            <option value="Headlight / Bulb">Headlight / Bulb</option>
            <option value="Tail / Brake Light">Tail / Brake Light</option>
            <option value="Turn Signal / Indicator">Turn Signal / Indicator</option>
            <option value="Auxiliary / Fog Light">Auxiliary / Fog Light</option>
            <option value="Wiring Harness / Cable">Wiring Harness / Cable</option>
            <option value="Switch / Control Module">Switch / Control Module</option>
            <option value="Fuse / Circuit Protection">Fuse / Circuit Protection</option>
            <option value="Relay / Safety Module">Relay / Safety Module</option>
            <option value="Charger / USB / Power Hub">Charger / USB / Power Hub</option>
            <option value="Horn / Siren">Horn / Siren</option>
            <option value="Complete Electrical Kit">Complete Electrical Kit</option>
            <option value="Other Electrical Accessory">Other Electrical Accessory</option>
        </select>
    </div>

    <!-- BRAND / MANUFACTURER -->
    <div class="col-md-6">
        <label>Brand / Manufacturer</label>
        <input type="text" name="brand" class="form-control" placeholder="e.g. Yuasa, Shorai, Spal, Koso, OEM">
    </div>

    <!-- VOLTAGE / POWER -->
    <div class="col-md-6">
        <label>Voltage (V)</label>
        <select name="voltage" class="form-select">
            <option value="">Select</option>
            <option value="6V">6V</option>
            <option value="12V">12V</option>
            <option value="24V">24V</option>
            <option value="36V">36V</option>
            <option value="48V">48V</option>
            <option value="72V+">72V+</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Power / Output</label>
        <input type="text" name="power_output" class="form-control" placeholder="e.g. 35W, 3000 lumens, 10A, 100W">
    </div>

    <!-- BATTERY SPECIFICATIONS -->
    <div class="col-md-6">
        <label>Battery Type</label>
        <select name="battery_type" class="form-select">
            <option value="">Select</option>
            <option value="Flooded Lead Acid">Flooded Lead Acid</option>
            <option value="Maintenance-Free (MF)">Maintenance-Free (MF)</option>
            <option value="AGM">AGM</option>
            <option value="Gel Cell">Gel Cell</option>
            <option value="Lithium Ion (Li-ion)">Lithium Ion (Li-ion)</option>
            <option value="Lithium Iron Phosphate (LiFePO4)">Lithium Iron Phosphate (LiFePO4)</option>
            <option value="EV Battery Pack">EV Battery Pack</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Battery Capacity / Ah</label>
        <input type="number" step="0.1" name="battery_capacity" class="form-control" placeholder="e.g. 5.0 Ah">
    </div>

    <div class="col-md-6">
        <label>Cold Cranking Amps (CCA)</label>
        <input type="number" name="cca_rating" class="form-control" placeholder="e.g. 120">
    </div>

    <!-- LIGHTING -->
    <div class="col-md-6">
        <label>Light Type</label>
        <select name="light_type" class="form-select">
            <option value="">Select</option>
            <option value="Halogen Bulb">Halogen Bulb</option>
            <option value="LED Bulb">LED Bulb</option>
            <option value="Projector LED">Projector LED</option>
            <option value="HID / Xenon">HID / Xenon</option>
            <option value="Laser Light">Laser Light</option>
            <option value="Fog / Driving Light">Fog / Driving Light</option>
            <option value="Integrated / Bar Light">Integrated / Bar Light</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Color Temperature / Lumens</label>
        <input type="text" name="light_output" class="form-control" placeholder="e.g. 6000K, 3000 lumens">
    </div>

    <div class="col-md-6">
        <label>Lens / Housing Material</label>
        <select name="housing_material" class="form-select">
            <option value="">Select</option>
            <option value="Plastic">Plastic</option>
            <option value="Polycarbonate">Polycarbonate</option>
            <option value="Aluminum">Aluminum</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- WIRING & HARNESS -->
    <div class="col-md-6">
        <label>Wiring Harness Type</label>
        <select name="wiring_type" class="form-select">
            <option value="">Select</option>
            <option value="OEM">OEM</option>
            <option value="Aftermarket Replacement">Aftermarket Replacement</option>
            <option value="Custom / Racing">Custom / Racing</option>
            <option value="Plug & Play">Plug & Play</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Fuse / Circuit Protection Type</label>
        <select name="fuse_type" class="form-select">
            <option value="">Select</option>
            <option value="Standard Blade Fuse">Standard Blade Fuse</option>
            <option value="Mini Blade Fuse">Mini Blade Fuse</option>
            <option value="Smart / Auto Reset">Smart / Auto Reset</option>
            <option value="Breaker">Breaker</option>
            <option value="Inline Fuse Holder">Inline Fuse Holder</option>
            <option value="Fuse Box / Panel">Fuse Box / Panel</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Relay / Safety Module</label>
        <select name="relay_type" class="form-select">
            <option value="">Select</option>
            <option value="Standard Relay">Standard Relay</option>
            <option value="Smart Relay / PDM">Smart Relay / PDM</option>
            <option value="Safety Cutoff / Kill Switch">Safety Cutoff / Kill Switch</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- SWITCHES & CONTROLS -->
    <div class="col-md-6">
        <label>Switch / Control Module Type</label>
        <select name="switch_type" class="form-select">
            <option value="">Select</option>
            <option value="Standard Switch">Standard Switch</option>
            <option value="Multi-Function Switch">Multi-Function Switch</option>
            <option value="Backlit Switch">Backlit Switch</option>
            <option value="CANbus / Smart Module">CANbus / Smart Module</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- ACCESSORY POWER -->
    <div class="col-md-6">
        <label>Accessory Power / USB / Charger</label>
        <select name="power_accessory" class="form-select">
            <option value="">Select</option>
            <option value="None">None</option>
            <option value="OEM USB / Charger">OEM USB / Charger</option>
            <option value="Aftermarket USB Charger">Aftermarket USB Charger</option>
            <option value="12V Socket">12V Socket</option>
            <option value="Power Hub / PDM">Power Hub / PDM</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- HORN / ALERTS -->
    <div class="col-md-6">
        <label>Horn / Siren Type</label>
        <select name="horn_type" class="form-select">
            <option value="">Select</option>
            <option value="Stock / OEM">Stock / OEM</option>
            <option value="Aftermarket Horn">Aftermarket Horn</option>
            <option value="Air / Compressor Horn">Air / Compressor Horn</option>
            <option value="Dual Tone / Stebel">Dual Tone / Stebel</option>
            <option value="Custom / Electric Siren">Custom / Electric Siren</option>
            <option value="Other">Other</option>
        </select>
    </div>

</div>
`;
