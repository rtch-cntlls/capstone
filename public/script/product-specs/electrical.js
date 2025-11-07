export const electricalSpecs = `
<h5 class="fw-bold">Electrical & Lighting</h5>
<div class="row g-3 mb-2">

    <!-- ELECTRICAL SYSTEM -->
    <div class="col-md-6">
        <label>System Voltage (V)</label>
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
        <label>Charging System Type</label>
        <select name="charging_system" class="form-select">
            <option value="">Select</option>
            <option value="AC (Alternating Current)">AC (Alternating Current)</option>
            <option value="DC (Direct Current)">DC (Direct Current)</option>
            <option value="AC/DC Hybrid">AC/DC Hybrid</option>
            <option value="Smart Charging System">Smart Charging System</option>
            <option value="Aftermarket Charging Upgrade">Aftermarket Charging Upgrade</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Stator / Alternator Output (W)</label>
        <input type="number" name="stator_output" class="form-control" placeholder="e.g. 150">
    </div>

    <div class="col-md-6">
        <label>Starter Motor Output (W)</label>
        <input type="number" name="starter_output" class="form-control" placeholder="e.g. 350">
    </div>

    <div class="col-md-6">
        <label>Regulator/Rectifier Type</label>
        <select name="regulator_type" class="form-select">
            <option value="">Select</option>
            <option value="Shunt Type">Shunt Type</option>
            <option value="Series Type / MOSFET">Series Type / MOSFET</option>
            <option value="Single Phase RR">Single Phase RR</option>
            <option value="Three Phase RR">Three Phase RR</option>
            <option value="Aftermarket High-Output RR">Aftermarket High-Output RR</option>
            <option value="Digital / Smart RR">Digital / Smart RR</option>
        </select>
    </div>

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
        </select>
    </div>

    <div class="col-md-6">
        <label>Battery Capacity (Ah)</label>
        <input type="number" step="0.1" name="battery_capacity" class="form-control" placeholder="e.g. 5.0">
    </div>

    <div class="col-md-6">
        <label>Cold Cranking Amps (CCA)</label>
        <input type="number" name="cca_rating" class="form-control" placeholder="e.g. 120">
    </div>

    <div class="col-md-6">
        <label>Fuse / Circuit Protection Type</label>
        <select name="fuse_type" class="form-select">
            <option value="">Select</option>
            <option value="Standard Blade Fuse">Standard Blade Fuse</option>
            <option value="Mini Blade Fuse">Mini Blade Fuse</option>
            <option value="Smart Fuse / Auto Reset">Smart Fuse / Auto Reset</option>
            <option value="Breaker Type">Breaker Type</option>
            <option value="Inline Fuse Holder">Inline Fuse Holder</option>
            <option value="Fuse Box (OEM)">Fuse Box (OEM)</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Wiring System Status</label>
        <select name="wiring_type" class="form-select">
            <option value="">Select</option>
            <option value="Standard OEM Harness">Standard OEM Harness</option>
            <option value="Tidy / Minimalist Harness">Tidy / Minimalist Harness</option>
            <option value="Aftermarket Replacement">Aftermarket Replacement</option>
            <option value="Custom Built / Racing Loom">Custom Built / Racing Loom</option>
            <option value="Plug & Play Accessory Harness">Plug & Play Accessory Harness</option>
            <option value="Modified (Tapped for Accessories)">Modified (Tapped for Accessories)</option>
        </select>
    </div>

    <!-- LIGHTING SYSTEM -->
    <div class="col-md-6">
        <label>Headlight Type</label>
        <select name="headlight_type" class="form-select">
            <option value="">Select</option>
            <option value="Halogen Bulb">Halogen Bulb</option>
            <option value="OEM LED Reflector">OEM LED Reflector</option>
            <option value="OEM LED Projector">OEM LED Projector</option>
            <option value="Aftermarket LED Bulb">Aftermarket LED Bulb</option>
            <option value="HID (Xenon)">HID (Xenon)</option>
            <option value="Bi-LED / Tri-LED Projector">Bi-LED / Tri-LED Projector</option>
            <option value="Adaptive / Cornering Light">Adaptive / Cornering Light</option>
            <option value="Laser Headlight">Laser Headlight</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Headlight Output (W or Lumens)</label>
        <input type="text" name="headlight_output" class="form-control" placeholder="e.g. 35W or 3000 lumens">
    </div>

    <div class="col-md-6">
        <label>Tail / Brake Light Type</label>
        <select name="taillight_type" class="form-select">
            <option value="">Select</option>
            <option value="Bulb Type">Bulb Type</option>
            <option value="OEM LED Tail Light">OEM LED Tail Light</option>
            <option value="Aftermarket LED Tail Light">Aftermarket LED Tail Light</option>
            <option value="Integrated Tail/Signal Light">Integrated Tail/Signal Light</option>
            <option value="Sequential LED Tail Light">Sequential LED Tail Light</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Signal Light Type</label>
        <select name="indicator_type" class="form-select">
            <option value="">Select</option>
            <option value="Standard Bulb">Standard Bulb</option>
            <option value="OEM LED Indicator">OEM LED Indicator</option>
            <option value="Aftermarket Sequential LED">Aftermarket Sequential LED</option>
            <option value="Flush Mount">Flush Mount</option>
            <option value="Mini / Bar-End Indicators">Mini / Bar-End Indicators</option>
            <option value="Smoked / Tinted Lenses">Smoked / Tinted Lenses</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Auxiliary Lighting / Fog Lamps</label>
        <select name="aux_lighting_type" class="form-select">
            <option value="">Select</option>
            <option value="None">None</option>
            <option value="Standard Fog Lights">Standard Fog Lights</option>
            <option value="LED Driving Lights (Flood/Spot)">LED Driving Lights (Flood/Spot)</option>
            <option value="Aftermarket LED Bar">Aftermarket LED Bar</option>
            <option value="Strobe / Emergency Lights">Strobe / Emergency Lights</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Daytime Running Lights (DRL)</label>
        <select name="drl_type" class="form-select">
            <option value="">Select</option>
            <option value="None">None</option>
            <option value="OEM DRL">OEM DRL</option>
            <option value="Aftermarket DRL Strip">Aftermarket DRL Strip</option>
            <option value="Integrated with Headlight">Integrated with Headlight</option>
        </select>
    </div>

    <!-- CONTROLS & ACCESSORIES -->
    <div class="col-md-6">
        <label>Instrument Cluster Type</label>
        <select name="instrument_cluster" class="form-select">
            <option value="">Select</option>
            <option value="Analog">Analog</option>
            <option value="Digital (LCD)">Digital (LCD)</option>
            <option value="Full Digital (TFT)">Full Digital (TFT)</option>
            <option value="Hybrid (Analog + Digital)">Hybrid (Analog + Digital)</option>
            <option value="Aftermarket Cluster">Aftermarket Cluster</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Speedometer Type</label>
        <select name="speedometer_type" class="form-select">
            <option value="">Select</option>
            <option value="Mechanical (Cable)">Mechanical (Cable)</option>
            <option value="Electronic (Sensor)">Electronic (Sensor)</option>
            <option value="GPS / Smart Display">GPS / Smart Display</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Handlebar Switch Type</label>
        <select name="handlebar_switch" class="form-select">
            <option value="">Select</option>
            <option value="Standard OEM Switches">Standard OEM Switches</option>
            <option value="Aftermarket Multi-Function Switch">Aftermarket Multi-Function Switch</option>
            <option value="Backlit Switches">Backlit Switches</option>
            <option value="Smart Control Module (CANbus)">Smart Control Module (CANbus)</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Relay / Safety Cutoff System</label>
        <select name="relay_system" class="form-select">
            <option value="">Select</option>
            <option value="Standard Relay">Standard Relay</option>
            <option value="Smart Relay / PDM">Smart Relay / PDM</option>
            <option value="Side Stand Safety Cutoff">Side Stand Safety Cutoff</option>
            <option value="Clutch Safety Switch">Clutch Safety Switch</option>
            <option value="Engine Stop Relay / Kill Switch">Engine Stop Relay / Kill Switch</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Horn Type</label>
        <select name="horn_type" class="form-select">
            <option value="">Select</option>
            <option value="Stock">Stock</option>
            <option value="Aftermarket Disc Horn">Aftermarket Disc Horn</option>
            <option value="Air Horn / Compressor Horn">Air Horn / Compressor Horn</option>
            <option value="Dual Tone / Stebel Horn">Dual Tone / Stebel Horn</option>
            <option value="Custom / Electric Siren">Custom / Electric Siren</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Accessory Power / USB Port</label>
        <select name="usb_port" class="form-select">
            <option value="">Select</option>
            <option value="None">None</option>
            <option value="OEM USB Port">OEM USB Port</option>
            <option value="Aftermarket USB Charger">Aftermarket USB Charger</option>
            <option value="12V Cigarette Socket">12V Cigarette Socket</option>
            <option value="Power Hub / PDM Installed">Power Hub / PDM Installed</option>
        </select>
    </div>

</div>
`;
